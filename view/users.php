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
    <title>Rocio Fast Food | Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".openEditModal", function () {
            var id = $(this).data('id');
            
            $(".idInput #usr_idE").val( id );
            $.getJSON('../controller/users/getUserDetails.php',{'usr_idEdit':id} ,function( data ) {
                
                console.log(data);
                $(".nameInput #usr_namee").val( data.usr_nombre_completo );
                $(".phoneInput #usr_phonee").val( data.usr_contacto );
                $(".emailInput #usr_emaile").val( data.usr_correo );
                $(".directionInput #usr_directe").val( data.usr_direccion );
                $(".usernameInput #usr_usernamee").val( data.usr_usuario );
                $(".typeInput #usr_typee").val( data.rol_id );
                $(".passInput #usr_passworde").val( data.usr_password );
                
            });
        });
    </script>
    <script>
        $(document).on("click", ".openDeleteModal", function () {
            var id = $(this).data('id');
            $(".idDelInput #usr_idD").val( id );
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
                    <h1>Usuarios</h1>
                </div>
			</div>
		</div>
        <div  class="m-3" style="text-align: right;">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newUserModal" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                Nuevo Usuario
            </button>
        </div>
        <div class="card body">
            <div class="col">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">TELEFONO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">DIRECCION</th>
                            <th scope="col">NOMBRE DE USUARIO</th>
                            <th scope="col">ROL</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../controller/users/getUsers.php';
                            echo showUsers();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

    <!-- New User Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='post' action="../controller/users/newUser.php">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="usr_name" class="col-form-label">Nombre Completo:</label>
                        <input type="text" class="form-control" id="usr_name" name="usr_name" placeholder="Nuevo Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_phone" class="col-form-label">Telefono del Usuario:</label>
                        <input type="number" class="form-control" id="usr_phone" name="usr_phone" placeholder="22222222" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_email" class="col-form-label">Correo del Usuario:</label>
                        <input type="email" class="form-control" id="usr_email" name="usr_email" placeholder="cliente@cliente.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_direct" class="col-form-label">Direccion:</label>
                        <input type="text" class="form-control" id="usr_direct" name="usr_direct" placeholder="c/ Montalgo Nro.123" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_username" class="col-form-label">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="usr_username" name="usr_username" placeholder="cliene123" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_password" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="usr_password" name="usr_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="usr_type" class="col-form-label">Tipo:</label>
                        <select class="form-select" aria-label="Category select" id="usr_type" name="usr_type" required> 
                            <option value="" selected disabled>Ninguna</option>
                            <?php
                                echo showRoles();
                            ?>
                        </select>
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
    <!-- New User Modal -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='post' action="../controller/users/updateUser.php">
            <div class="modal-body">
                    <div class="mb-3 idInput">                        
                        <label for="usr_idE" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="usr_idE" name="usr_idE" readonly>
                    </div>
                    <div class="mb-3 nameInput">
                        <label for="usr_namee" class="col-form-label">Nombre Completo:</label>
                        <input type="text" class="form-control" id="usr_namee" name="usr_namee" placeholder="Nuevo Usuario" required>
                    </div>
                    <div class="mb-3 phoneInput">
                        <label for="usr_phonee" class="col-form-label">Telefono del Usuario:</label>
                        <input type="number" class="form-control" id="usr_phonee" name="usr_phonee" placeholder="22222222" required>
                    </div>
                    <div class="mb-3 emailInput">
                        <label for="usr_emaile" class="col-form-label">Correo del Usuario:</label>
                        <input type="email" class="form-control" id="usr_emaile" name="usr_emaile" placeholder="cliente@cliente.com" required>
                    </div>
                    <div class="mb-3 directionInput">
                        <label for="usr_directe" class="col-form-label">Direccion:</label>
                        <input type="text" class="form-control" id="usr_directe" name="usr_directe" placeholder="c/ Montalgo Nro.123" required>
                    </div>
                    <div class="mb-3 usernameInput">
                        <label for="usr_usernamee" class="col-form-label">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="usr_usernamee" name="usr_usernamee" placeholder="algunusuario" required>
                    </div>
                    <div class="mb-3 passInput">
                        <label for="usr_passworde" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="usr_passworde" name="usr_passworde" required>
                    </div>
                    <div class="mb-3 typeInput">
                        <label for="usr_typee" class="col-form-label">Tipo:</label>
                        <select class="form-select" aria-label="Category select" id="usr_typee" name="usr_typee" required> 
                            <option value="" selected disabled>Ninguna</option>
                            <?php
                                echo showRoles();
                            ?>
                        </select>
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
    <!-- Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal fade" id="delUserModal" tabindex="-1" aria-labelledby="delUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title message_error" id="exampleModalLabel">¡Al eliminar este usuario podria afectar algunas ventas registradas!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/users/deleteUser.php">
                    <div class="modal-body">
                        <div class="mb-3 idDelInput">                        
                            <label for="usr_idD" class="col-form-label">ID del usuario por eliminar:</label>
                            <input type="text" class="form-control" id="usr_idD" name="usr_idD" readonly>
                        </div>
                        <h5>¿Esta seguro que desea eliminar a este usuario?</h5>
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
    <!-- Delete User Modal -->

</body>
</html>