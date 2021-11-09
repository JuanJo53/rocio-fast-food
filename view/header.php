<!--Header-->
<nav id="header" class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd;">

        <div class="container">
        <img src="../assets/img/logoR.jpg" width="150" height="50"   alt="Logo"> 


            <?php
                session_start();    
                echo "<h4 style='color:orange;'>¡Bienvenido ". $_SESSION['USUARIO']."!</h4>";
            ?>
			
			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbar"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav ml-auto ms-5">
					<li class="nav-item">
						<a class="nav-link" href="home.php">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="products.php">Productos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="clients.php">Clientes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="sales.php">Ventas</a>
					</li>
                    <?php
                        if($_SESSION['TIPO']=='1'){
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='providers.php'>Proveedores</a>
                                </li>";
                            echo "<li class='nav-item'>
                                    <a class='nav-link ' href='categories.php'>Categorias</a>
                                </li>";
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='users.php'>Usuarios</a>
                                </li>";
							echo "<li class='nav-item'>
								<a class='nav-link' href='rols.php'>Roles</a>
							</li>";
                        }
                    ?>
					<!-- <li class="nav-item dropdown">
						<a
							class="nav-link dropdown-toggle"
							href="#"
							id="navbarDropdown"
							role="button"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
						>
							Nuestro Credo
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="staticPages/finalidadFe.html">Finalidad de la Fe</a>
							<a class="dropdown-item" href="staticPages/proyeccionFe.html">Proyeccion de la Fe</a>
						</div>
					</li> -->
				</ul>
                <form method="post" action="../controller/logout.php">
                    <button class="btn btn-outline-danger text-md- ms-5" type="submit">Cerrar Sesion</button>
                </form>
			</div>
		</div>
	</nav>
	<!--header-->