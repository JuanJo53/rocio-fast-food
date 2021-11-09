<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocio Fast Food | Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".openEditModal", function () {
            var id = $(this).data('id');
            $(".idInput #prov_idEdit").val( id );
            $.getJSON('../controller/providers/getProviderDetails.php',{'prov_id':id} ,function( data ) {
                console.log(data);
                $(".nameInput #prov_nameEdit").val( data.prov_proveedor );
                $(".emailInput #prov_emailEdit").val( data.prov_correo );
                $(".phoneInput #prov_phoneEdit").val( data.prov_contacto );
                $(".directionInput #prov_directEdit").val( data.prov_direccion );
            });
        });
    </script>
    <script>
        $(document).on("click", ".openDeleteModal", function () {
            var id = $(this).data('id');
            $(".idDelInput #prov_idDel").val( id );
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
                    <h1>Proveedores</h1>
                </div>
			</div>
		</div>
        <div class="row m-3">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newProvModal" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                Nuevo Proveedor
            </button>
        </div>
        <div class="row g-4">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE DEL PROVEEDOR</th>
                            <th scope="col">CORREO ELECTRONICO</th>
                            <th scope="col">TELEFONO</th>
                            <th scope="col">DIRECCION</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../controller/providers/getProviders.php';
                            echo showProviders();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

    <!-- New Provider Modal -->
    <div class="modal fade" id="newProvModal" tabindex="-1" aria-labelledby="newProvModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action='../controller/providers/newProvider.php'>
                    <div class="modal-body">
                            <div class="mb-3">
                                <label for="prov_name" class="col-form-label">Nombre del Proveedor:</label>
                                <input type="text" class="form-control" id="prov_name" name="prov_name" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="prov_email" class="col-form-label">Correo Electronico:</label>
                                <input type="email" class="form-control" id="prov_email" name="prov_email" placeholder="prov@prov.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="prov_phone" class="col-form-label">Telefono:</label>
                                <input type="number" class="form-control" id="prov_phone" name="prov_phone" placeholder="222222222" required>
                            </div>
                            <div class="mb-3">
                                <label for="prov_direct" class="col-form-label">Direccion:</label>
                                <input type="text" class="form-control" id="prov_direct" name="prov_direct" placeholder="Ciudad Maravilla c/London Nro. 140" required>
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
    <!-- New Provider Modal -->

    <!-- Edit Provider Modal -->
    <div class="modal fade" id="editProvModal" tabindex="-1" aria-labelledby="editProvModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='post' action="../controller/providers/updateProvider.php">
            <div class="modal-body">                   
                    <div class="mb-3 idInput">        
                        <label for="prov_idEdit" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="prov_idEdit" name="prov_idEdit" readonly>
                    </div>
                    <div class="mb-3 nameInput">
                        <label for="prov_nameEdit" class="col-form-label">Nombre del Proveedor:</label>
                        <input type="text" class="form-control" id="prov_nameEdit" name="prov_nameEdit" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3 emailInput">
                        <label for="prov_emailEdit" class="col-form-label">Correo Electronico:</label>
                        <input type="email" class="form-control" id="prov_emailEdit" name="prov_emailEdit" placeholder="prov@prov.com" required>
                    </div>
                    <div class="mb-3 phoneInput">
                        <label for="prov_phoneEdit" class="col-form-label">Telefono:</label>
                        <input type="number" class="form-control" id="prov_phoneEdit" name="prov_phoneEdit" placeholder="222222222" required>
                    </div>
                    <div class="mb-3 directionInput">
                        <label for="prov_directE" class="col-form-label">Direccion:</label>
                        <input type="text" class="form-control" id="prov_directEdit" name="prov_directEdit" placeholder="Ciudad Maravilla c/London Nro. 140" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
            </div>
        </div>
    </div>    
    <!-- Edit Provider Modal -->

    <!-- Delete Provider Modal -->
    <div class="modal fade" id="delProvModal" tabindex="-1" aria-labelledby="delProvModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title message_error" id="exampleModalLabel">¡Al eliminar este proveedor podria afectar algunos articulos en el inventario!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/providers/deleteProvider.php">                
                    <div class="modal-body">
                        <div class="mb-3 idDelInput">        
                            <label for="prov_idDel" class="col-form-label">ID de proveedor por eliminar:</label>
                            <input type="text" class="form-control" id="prov_idDel" name="prov_idDel" readonly>
                        </div>
                        <h5>¿Esta seguro que desea eliminar este proveedor?</h5>
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
    <!-- Delete Provider Modal -->
    
</body>
</html>