<?php
    session_start();    
    if(!isset($_SESSION['LOGIN_STATUS'])){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocio Fast Food | Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#newSaleModal').on('hidden.bs.modal', function (e) {
            var productsHtml;
            $.ajax({ 
                url: '../controller/sales/getProducts.php',
                success: function (response) {
                    productsHtml=response;
                    $( "div.productsList" ).replaceWith("<div class='productsList' id='productsList'><label for='saleProdIdE' class='col-form-label'>Articulo:</label><select class='form-select' aria-label='Products select' id='saleProdIdE' name='saleProdIdE' required><option selected disabled>Ninguna</option>"+productsHtml+"</select><div class='row'><div class='mb-3'><label for='saleQuant' class='col-form-label'>Cantidad:</label><input type='number' min='1' class='form-control' id='saleQuant' name='saleQuant' placeholder='100' required></div></div></div>");
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".openDetailModal", function () {
            var id = $(this).data('id');
            $.ajax({
                url:'../controller/sales/getSaleProducts.php',
                method:'post',
                data:{'saleDetId':id},
                success: function( data ) {
                    $( "#productsTable" ).append(data);
                }
            });            
            $(".idInput #saleIdDet").val( id );
        });
    </script>
    <script>
        $(document).on("click", ".openDeleteModal", function () {
            var id = $(this).data('id');
            $(".idDelInput #saleIdDel").val( id );
        });
    </script>

</head>
<body data-spy="scroll" data-target="#navbar" data-offset="56">
	<!--Header-->
    <?php
        include '../view/header.php';
    ?>	
    <!--header-->
    <div class="container">
		<div class="row">
			<div class="col text-center text-uppercase">
                <div class="home-title">
                    <h5>Gestiona las</h5>
                    <h1>Ventas</h1>
                </div>
			</div>
		</div>
        <div  class="m-3"style="text-align: right;">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newSaleModal" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                Nueva Venta
            </button>
        </div>
        <div class="dateFilter">
            <div class="row">
                <div class="col-md-2 date">
                    <label for="startDate" class="col-form-label">Desde:</label>
                    <input class="form-control" type="text" id="startDate" name='startDate'>
                </div>
              
                <div class="col-md-2">
                    <label for="endDate" class="col-form-label">Hasta:</label>
                    <input class="form-control" type="text" id="endDate" name='endDate'>            
                </div>
                <div class="col-md-1">
                    <label for="startDate" class="col-form-label">Buscar</label>
                    <button class="btn btn-primary" type='button' role="button" id='searchByDate' name='searchByDate'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="col-md-3">
                    <?php
                        if($_SESSION['TIPO']==1){
                            echo "
                            <button class='btn btn-success' type='button' role='button' id='downloadReport' name='downloadReport'>
                                Descargar Reporte Excel
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
                                <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                                <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                                </svg>
                            </button>";
                        }
                    ?>
                </div>
                <div class="col-md-3">
                    <?php
                        if($_SESSION['TIPO']==1){
                            echo "
                            <button class='btn btn-primary' type='button' role='button' id='downloadReportDetails' name='downloadReportDetails'>
                                Descargar Reporte Detallado Excel
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
                                <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                                <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                                </svg>
                            </button>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="m-3 card body">
            <div class="col" id="saleTableData">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">EMPLEADO</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">NIT CLIENTE</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">FECHA</th>
                            <th scope='col'>Detalle</th>
                            <?php
                                if($_SESSION['TIPO']==1){
                                    echo "<th scope='col'>Eliminar</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody id='salesTable'>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

    <!-- New Sale Modal -->
    <div class="modal fade newSaleModal" id="newSaleModal" name='newSaleModal' tabindex="-1" aria-labelledby="newSaleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" id='newSaleForm' novalidate>
                    <div class="modal-body newSaleBody">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="client_nit_search" class="col-form-label">NIT Cliente:</label>
                                    <input type="number" min="1" class="form-control" id="client_nit_search" name="client_nit_search" placeholder="0000000" required>
                                    <label for="cli_name" class="col-form-label">Nombre Cliente:</label>
                                    <div class="clientSearchResponse" id="clientSearchResponse" name="clientSearchResponse">                                        
                                    </div>
                                    <!-- <input type="text" class="form-control" id="cli_name" name="cli_name" placeholder="Apellido Generico" disabled required> -->
                                </div>
                                <div class="col-md-1">
                                    <label for="startDate" class="col-form-label">Buscar</label>
                                    <button class="btn btn-primary" type='button' role="button" id='searchClient' name='searchClient'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>                              
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="saleProdIdE" class="col-form-label">Productos a Comprar:</label>
                            </div>
                            <hr>
                            <div class="row ps-5 pe-5">
                                <div class="productsList" id="productsList">                                    
                                    <label for="saleProdIdE1" class="col-form-label">Productos:</label>
                                    <select class="form-select" aria-label="Products select" id="saleProdIdE1" name="saleProdIdE1" required>
                                        <option value="" selected disabled>Ninguna</option>
                                        <?php                                        
                                            include_once '../controller/sales/getProdsAndClis.php';
                                            echo showProducts();
                                        ?>
                                    </select>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="saleQuant1" class="col-form-label">Cantidad:</label>
                                            <input type="number" min="1" class="form-control" id="saleQuant1" name="saleQuant1" placeholder="100" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-outline-dark addProductBtn" >Agregar Articulo</button>
                                </div>                 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">                        
                        <span class='badge bg-warning text-dark'>¡AL REGISTRAR LA VENTA SE DESCARGARÁ UN PDF CON LA FACTURA!</span>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success submitNewSale" id="submitNewSale" name="submitNewSale">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- New Sale Modal -->

    <!-- Sale Products Modal -->
    <div class="modal fade" id="prodDetailModal" tabindex="-1" aria-labelledby="prodDetailModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Productos Incluidos en la Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body newSaleBody">
                    <div class="mb-3 idInput">        
                        <label for="prod_idE" class="col-form-label">ID de la venta:</label>
                        <input type="text" class="form-control" id="saleIdDet" name="saleIdDet" readonly>
                    </div>
                    <div class="row g-4">
                        <div class="col">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ARTICULO</th>
                                        <th scope="col">PRECIO</th>
                                        <th scope="col">CANTIDAD</th>
                                        <th scope="col">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id='productsTable'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        if($_SESSION['TIPO']==1){
                            echo "
                            <button class='btn btn-success' type='button' role='button' id='downloadSingleSaleReportDetails' name='downloadSingleSaleReportDetails'>
                                Descargar Detalle Excel
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
                                <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                                <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                                </svg>
                            </button>";
                        }
                    ?>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Atras</button>
                </div>
            </div>
        </div>
    </div>    
    <!-- Sale Products Modal -->

    <!-- Delete Sale Modal -->
    <div class="modal fade" id="delSaleModal" tabindex="-1" aria-labelledby="delSaleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title message_error" id="exampleModalLabel">¡Al eliminar esta venta podria afectar algunos registros!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/sales/deleteSale.php">                
                    <div class="modal-body">
                        <div class="mb-3 idDelInput">        
                            <label for="saleIdDel" class="col-form-label">ID de la venta por eliminar:</label>
                            <input type="text" class="form-control" id="saleIdDel" name="saleIdDel" readonly>
                        </div>
                        <h5>¿Esta seguro que desea eliminar esta venta?</h5>
                        <h1 class='badge bg-warning text-dark'>¡Esta accion no se puede deshacer!</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Si</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Sale Modal -->

    <!-- Download Sale Invoice Modal -->
    <div class="modal fade downloadSaleInvoiceModal" id="downloadSaleInvoiceModal" name="downloadSaleInvoiceModal" data-bs-backdrop="static"data-bs-keyboard="false" tabindex="-1" aria-labelledby="downloadSaleInvoiceModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">¡Exito al realizar la venta!</h4>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title message_success" id="exampleModalLabel">Descargue la factura y el ticket para imprimirlos</h4>
                    <button type="button" class="btn btn-info" role='button' id='downloadSaleInvoice' name='downloadSaleInvoice'>Descargar Factura</button>
                    <button type="button" class="btn btn-primary" role='button' id='downloadSaleTicket' name='downloadSaleTicket'>Descargar Ticket</button>
                    <button type="button" class="btn btn-secondary" role='button' data-bs-dismiss="modal" id='closeSale' name='closeSale'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Download Sale Invoice Modal -->
    

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <script language="javascript">        
		$(document).ready(function () {
            var c=1;
            $(document).on("click", ".addProductBtn", function () {
                var productsHtml;
                c++;
                $.ajax({ 
                    url: '../controller/sales/getProducts.php',
                    success: function (response) {
                        productsHtml=response;
                        $( "div.productsList" ).append("<label for='saleProdIdE' class='col-form-label'>Articulo:</label><select class='form-select' aria-label='Products select' id='saleProdIdE"+c+"' name='saleProdIdE"+c+"' required><option value='' selected disabled>Ninguna</option>"+productsHtml+"</select><div class='row'><div class='mb-3'><label for='saleQuant' class='col-form-label'>Cantidad:</label><input type='number' class='form-control' id='saleQuant"+c+"' name='saleQuant"+c+"' placeholder='100' required></div></div>");
                    }
                });
            });
            $(".submitNewSale").click(function () {
                var prodsList = [];
                var prodId;
                var clientId;
                var quantity;
                for(i=1 ; i<=c ; i++){
                    prodId=$('#saleProdIdE'+i).val();
                    quantity=$('#saleQuant'+i).val();
                    newProd={"prodId":prodId, "quantity":quantity};
                    prodsList.push(newProd);
                }
                clientId=$('#client_nit_search').val();
                clientName=$('#cli_name').val();
                
                var forms = document.querySelectorAll('.needs-validation');

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated')
                    })
                });

                if($("#newSaleForm").valid()){
                    if($("#cli_name").attr('disabled') || $("#cli_name").prop('disabled')){
                        $.ajax({                
                            url:"../controller/sales/newSale.php", 
                            type: "POST",
                            data: { saleCliId: clientId, prodsList: JSON.stringify(prodsList)},               
                            success: function(response){
                                if(response=='false'){
                                    
                                    swal('Uno de los productos excede el limite de stock!');
                                }else{
                                    $(".newSaleModal").modal('hide');
                                    $(".downloadSaleInvoiceModal").modal('show');
                                    setTimeout(
                                        function(){
                                            $.ajax({                
                                                url:"../controller/products/checkStock.php", 
                                                type: "GET",
                                                success: function(response){                                
                                                    if(response!='false'){
                                                        alert(response);
                                                    }
                                                }
                                            });
                                        }, 4000
                                    );
                                }
                            }
                        });
                    }else{
                        $.ajax({                
                            url:"../controller/sales/newSale.php", 
                            type: "POST",
                            data: { saleCliId: clientId, saleCliName: clientName,prodsList: JSON.stringify(prodsList)},
                            success: function(response){                                
                                if(response=='false'){
                                    alert('Uno de los productos excede el limite de stock!');
                                }else{
                                    $(".newSaleModal").modal('hide');
                                    $(".downloadSaleInvoiceModal").modal('show');
                                    setTimeout(
                                        function(){
                                            $.ajax({                
                                                url:"../controller/products/checkStock.php", 
                                                type: "GET",
                                                success: function(response){                                
                                                    console.log(response);
                                                    if(response!='false'){
                                                        alert(response);
                                                    }
                                                }
                                            });
                                        }, 4000
                                    );
                                }
                            }
                        });
                    }
                    
                }else{
                    console.log('Formulario no valido!');
                }
            });		
        });
    </script>
    <script>
        $('#prodDetailModal').on('hidden.bs.modal', function (e) {            
            $( "#productsTable" ).html('');
        });
    </script>
    <script>        
		$(document).ready(function () {
            
            $('#startDate').datepicker('setDate', new Date('2021-1-1'));
            $('#endDate').datepicker('setDate', new Date());
            var startDate=$('#startDate').val();
            var endDate=$('#endDate').val();
            $.ajax({
                url:  '../controller/sales/getSales.php',
                type: "POST",
                data: {function: 'showSales', startDate: startDate, endDate: endDate },
                success: function(response){
                    $( "#salesTable" ).html('');
                    $( "#salesTable" ).append(response);
                }
            });
            $('#searchByDate').click(function(){
                var startDate=$('#startDate').val();
                var endDate=$('#endDate').val();
                $.ajax({
                    url:  '../controller/sales/getSales.php',
                    type: "POST",
                    data: {startDate: startDate, endDate: endDate },
                    success: function(response){
                        $( "#salesTable" ).html('');
                        $( "#salesTable" ).append(response);
                    }
                });
            });

            $('#searchClient').click(function(){
                var clientNit=$('#client_nit_search').val();
                
                if(clientNit){
                    $.ajax({
                        url:  '../controller/clients/searchClient.php',
                        type: "POST",
                        data: {clientNit: clientNit},
                        success: function(response){
                            console.log(response);
                            if(response!=''){
                                $( "#clientSearchResponse" ).html('');
                                $( "#clientSearchResponse" ).append("<input type='text' class='form-control cli_name' id='cli_name' name='cli_name' placeholder='Apellido Generico' value='"+response+"' disabled required>");
                            }else{
                                $( "#clientSearchResponse" ).html('');
                                $( "#clientSearchResponse" ).append("<input type='text' class='form-control cli_name' id='cli_name' name='cli_name' placeholder='Apellido Generico' required>");
                            }
                        }
                    });
                }
            });

            $('#downloadReport').click(function(){
                var startDate=$('#startDate').val();
                var endDate=$('#endDate').val();
                var page = encodeURI("../controller/sales/salesReport.php?startDate="+startDate+"&endDate="+endDate);
                window.location = page;
            });
            $('#downloadReportDetails').click(function(){
                var startDate=$('#startDate').val();
                var endDate=$('#endDate').val();
                var page = encodeURI("../controller/sales/salesDetailsReport.php?startDate="+startDate+"&endDate="+endDate);
                window.location = page;
            });
            $('#downloadSingleSaleReportDetails').click(function(){
                var saleId=$('#saleIdDet').val();
                var page = encodeURI("../controller/sales/singleSaleDetailReport.php?saleId="+saleId);
                window.location = page;
            });
            $('#downloadSaleInvoice').click(function(){
                var page = encodeURI("../controller/sales/saleInvoice.php");
                window.open(page);
                setTimeout(
                    function(){
                        alert('¡Factura Descargada!')
                    }, 2000
                );
            });
            $('#downloadSaleTicket').click(function(){
                var page = encodeURI("../controller/sales/saleTicketReport.php");
                window.open(page);
                setTimeout(
                    function(){
                        alert('¡Ticket Descargado!')
                    }, 2000
                );
            });
            $('#closeSale').click(function(){
                setTimeout(
                    function(){
                        location.reload();
                    }, 1000
                );
            });
        });
    </script>
</body>
</html>