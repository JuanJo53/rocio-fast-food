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
    <title>Rocio Fast Food | Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".openEditModal", function () {
            var id = $(this).data('id');
            $(".idInput #cli_idE").val( id );
            $.getJSON('../controller/clients/getClientDetails.php',{'cli_id':id} ,function( data ) {
                console.log(data);
                $(".nameInput #client_nameE").val( data.cl_cliente );
                $(".nitInput #client_nitE").val( data.cl_documento );
            });
        });
    </script>
    <script>
        $(document).on("click", ".openDeleteModal", function () {
            var id = $(this).data('id');
            $(".idDelInput #cli_idD").val( id );
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
                    <h5>Gestiona a los</h5>
                    <h1>Clientes</h1>
                </div>
			</div>
		</div>
        
        <div class="card body m-3">
            <div class="col">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">NIT</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../controller/clients/getClients.php';
                            echo showClients();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

    <!-- New Client Modal -->
    <div class="modal fade" id="newClientModal" tabindex="-1" aria-labelledby="newClientModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="client_name" class="col-form-label">Nombre del Cliente:</label>
                            <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Nuevo Cliente" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_nit" class="col-form-label">NIT del Cliente:</label>
                            <input type="number" min="1" class="form-control" id="client_nit" name="client_nit" placeholder="0000000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="addClient" name="addClient" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- New Client Modal -->

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/clients/updateClient.php">
                    <div class="modal-body">
                        <div class="mb-3 idInput">        
                            <label for="cli_idE" class="col-form-label">ID:</label>
                            <input type="text" class="form-control" id="cli_idE" name="cli_idE" readonly>
                        </div>
                        <div class="mb-3 nameInput">
                            <label for="client_nameE" class="col-form-label">Nombre del Cliente:</label>
                            <input type="text" class="form-control" id="client_nameE" name="client_nameE" placeholder="Cliente Nombre" required>
                        </div>
                        <div class="mb-3 nitInput">
                            <label for="client_nitE" class="col-form-label">NIT del Cliente:</label>
                            <input type="number" min="1" class="form-control" id="client_nitE" name="client_nitE" placeholder="000000000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- Edit Client Modal -->

    <!-- Delete Client Modal -->
    <div class="modal fade" id="delClientModal" tabindex="-1" aria-labelledby="delClientModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title message_error" id="exampleModalLabel">¡Al eliminar este cliente podria afectar algunas ventas registradas!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/clients/deleteClient.php">                
                    <div class="modal-body">
                        <div class="mb-3 idDelInput">        
                            <label for="cli_idD" class="col-form-label">ID del cliente por eliminar:</label>
                            <input type="text" class="form-control" id="cli_idD" name="cli_idD" readonly>
                        </div>
                        <h5>¿Esta seguro que desea eliminar este cliente?</h5>
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
    <!-- Delete Client Modal -->

    <script>
        $(document).ready(function () {
            $('#addClient').click(function(){
                var newClientNit=$('#client_nit').val();
                var newClientName=$('#client_name').val();
                $.ajax({
                    url:  '../controller/clients/newClient.php',
                    type: "POST",
                    data: {client_name: newClientName, client_nit: newClientNit},
                    success: function(response){
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>