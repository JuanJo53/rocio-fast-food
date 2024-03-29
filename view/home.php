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
    <title>Rocio Fast Food | Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                <div class="home-title" >
                    <h5>Inicio</h5>
                    <h1>¡Comienza a Gestionar!</h1>
                </div>
			</div>
		</div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                </svg>
                <div class="card-body">
                    <h5 ><a class='card-title'href="products.php">Productos</a></h5>
                    <p class="card-text">Podrás gestionar tus productos de tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar Productos, además de poder visualizar todos tus productos con un detalle particular.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>
                <div class="card-body">
                    <h5 ><a  class="card-title" href="clients.php">Clientes</a></h5>
                    <p class="card-text">Podrás gestionar los clientes registrados en tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar clientes, además de poder visualizar a todos tus clientes a detalle.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <svg class="card-img-top" xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                </svg>
                <div class="card-body">
                    <h5 ><a class="card-title"href="sales.php">Ventas</a></h5>
                    <p class="card-text">Podrás administrar las ventas de tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar ventas, además de poder visualizar a todas tus ventas a detalle.</p>
                </div>
                </div>
            </div>
            <?php
                if($_SESSION['TIPO']=='1'){
                    echo "<div class='col'>
                            <div class='card'>
                            <svg class='card-img-top' xmlns='http://www.w3.org/2000/svg' width='150' height='150' fill='currentColor' class='bi bi-truck' viewBox='0 0 16 16'>
                            <path d='M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'/>
                            </svg>
                            <div class='card-body'>
                                <h5 ><a class='card-title' href='providers.php'>Proveedores</a></h5>
                                <span class='badge bg-warning text-dark'>¡FUNCIONALIDAD SOLO PARA ADMINISTRADORES! </span>
                                <p class='card-text'>Podrás gestionar los proveedores registrados en tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar proveedores, además de poder visualizar a todos tus proveedores a detalle.</p>
                            </div>
                            </div>
                        </div>";
                    echo "<div class='col'>
                            <div class='card'>
                            <svg class='card-img-top' xmlns='http://www.w3.org/2000/svg' width='150' height='150' fill='currentColor' class='bi bi-card-checklist' viewBox='0 0 16 16'>
                            <path d='M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z'/>
                            <path d='M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z'/>
                            </svg>
                            <div class='card-body'>
                                <h5 ><a class='card-title' href='categories.php'>Categorias</a></h5>
                                <span class='badge bg-warning text-dark'>¡FUNCIONALIDAD SOLO PARA ADMINISTRADORES! </span>
                                <p class='card-text'>Podrás gestionar las categorias registrados en tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar categorias, además de poder visualizar a todos tus categorias a detalle.</p>
                            </div>
                            </div>
                        </div>";
                    echo "<div class='col'>
                            <div class='card'>
                            <svg class='card-img-top' xmlns='http://www.w3.org/2000/svg' width='150' height='150' fill='currentColor' class='bi bi-person-badge' viewBox='0 0 16 16'>
                            <path d='M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z'/>
                            <path d='M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z'/>
                            </svg>
                            <div class='card-body'>
                                <h5 class='card-title'><a class='card-title' href='usaers.php'>Usuarios</a></h5>                                
                                <span class='badge bg-warning text-dark'>¡FUNCIONALIDAD SOLO PARA ADMINISTRADORES! </span>
                                <p class='card-text'>Podrás gestionar los otros usuarios registrados en tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar usuarios, además de poder visualizar a todos tus usuarios a detalle.</p>
                            </div>
                            </div>
                        </div>";

                    echo "<div class='col'>
                            <div class='card'>
                            <svg class='card-img-top' xmlns='http://www.w3.org/2000/svg' width='150' height='150' fill='currentColor' class='bi bi-card-checklist' viewBox='0 0 16 16'>
                            <path d='M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z'/>
                            <path d='M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z'/>
                            </svg>
                            <div class='card-body'>
                                <h5 ><a class='card-title' href='rols.php'>Roles</a></h5>
                                <span class='badge bg-warning text-dark'>¡FUNCIONALIDAD SOLO PARA ADMINISTRADORES! </span>
                                <p class='card-text'>Podrás gestionar los roles  registrados en tu restaurante de la mejor forma. Aqui podrás agregar, editar, eliminar roles.</p>
                            </div>
                            </div>
                        </div>";
                }                            
            ?>
        </div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>