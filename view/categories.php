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
    <title>Rocio Fast Food | Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script>
        $(document).on("click", ".openEditModal", function () {
            var id = $(this).data('id');
            $(".idInput #cat_idEdit").val( id );
            $.getJSON('../controller/categories/getCategoryDetails.php',{'cat_id':id} ,function( data ) {
                console.log(data);
                $(".nameInput #cat_nameEdit").val( data.cat_categoria );
            });
        });
    </script>
    <script>
        $(document).on("click", ".openDeleteModal", function () {
            var id = $(this).data('id');
            $(".idDelInput #cat_idD").val( id );
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
                    <h1>Categorias</h1>
                </div>
			</div>
		</div>
        <div class="m-3"style="text-align: right;">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#newCatModal" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
                Nueva Categoria
            </button>
        </div>
        <div class="card body">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE DE LA CATEGORIA</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../controller/categories/getCategories.php';
                            echo showCategories();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

    <!-- New Category Modal -->
    <div class="modal fade" id="newCatModal" tabindex="-1" aria-labelledby="newCatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/categories/newCategory.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cat_name" class="col-form-label">Nombre de la Categoria:</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Nombre" required>
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
    <!-- New Category Modal -->

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="editCatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de la Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/categories/updateCategory.php">
                    <div class="modal-body">
                        <div class="mb-3 idInput">        
                            <label for="cat_idEdit" class="col-form-label">ID:</label>
                            <input type="text" class="form-control" id="cat_idEdit" name="cat_idEdit" readonly>
                        </div>
                        <div class="mb-3 nameInput">
                            <label for="cat_nameEdit" class="col-form-label">Nombre de la Categoria:</label>
                            <input type="text" class="form-control" id="cat_nameEdit" name="cat_nameEdit" placeholder="Nombre" required>
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
    <!-- Edit Category Modal -->

    <!-- Delete Category Modal -->
    <div class="modal fade" id="delCatModal" tabindex="-1" aria-labelledby="delCatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title message_error" id="exampleModalLabel">¡Al eliminar esta categoria podria afectar algunos articulos en el inventario!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method='post' action="../controller/categories/deleteCategory.php">                
                    <div class="modal-body">
                        <div class="mb-3 idDelInput">        
                            <label for="cat_idD" class="col-form-label">ID de la categoria por eliminar:</label>
                            <input type="text" class="form-control" id="cat_idD" name="cat_idD" readonly>
                        </div>
                        <h5>¿Esta seguro que desea eliminar esta categoria?</h5>
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
    <!-- Delete Category Modal -->

</body>
</html>