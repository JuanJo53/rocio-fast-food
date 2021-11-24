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
                    <h5>Analiza el Estado del Negocio</h5>
                    <h1>Graficos y Analisis</h1>
                </div>
			</div>
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
                <div class="avgSalesSec col-md-3">
                    <label for='avgSales' class='col-form-label'>Ventas Promedio</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sales col-8 me-5">
                <div class="col text-center text-uppercase">
                    <div class="home-title" >
                        <h1>Numero de Ventas por Fecha</h1>
                    </div>
                </div>
                <canvas id="salesChart" width="400" height="250"></canvas>
            </div>
            <div class="salesProd col-3 ms-5">
                <div class="col text-center text-uppercase">
                    <div class="home-title" >
                        <h1>Porcentaje de Ventas por Producto</h1>
                    </div>
                </div>
                <canvas id="salesProdChart" width="400" height="190"></canvas>
            </div>
        </div>
        <div class="products">
            <div class="row">
                <div class="col text-center text-uppercase">
                    <div class="home-title" >
                        <h1>Cantidad Disponible de los Productos</h1>
                    </div>
                </div>
            </div>
            <canvas class="m-5" id="productsChart" width="400" height="200"></canvas>
        </div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>        
		$(document).ready(function () {
            //Sales Line Chart
            $('#startDate').datepicker('setDate', new Date('2021-1-1'));
            $('#endDate').datepicker('setDate', new Date());
            var startDate=$('#startDate').val();
            var endDate=$('#endDate').val();

            let salesChart;
            $.ajax({
                url:  '../controller/sales/getSalesCount.php',
                type: "POST",
                data: {startDate: startDate, endDate: endDate },
            }).done(
                function(response){
                    var salesData = JSON.parse(response);
                    var salesLabels = [];
                    var salesCount = [];
                    var sum=0;
                    for(var i=0;i<salesData.length;i++){
                        sum+=salesData[i][1];
                        salesLabels.push(salesData[i][0]);
                        salesCount.push(salesData[i][1]);
                    }
                    var avg=sum/salesData.length;
                    avg=avg.toFixed(2);
                    $( ".avgSalesSec" ).append("<h2 class='avgData'>"+avg+"</h2>");

                    const salesChartElem= document.getElementById('salesChart').getContext('2d');
                    salesChart = new Chart(salesChartElem, {
                        type: 'line',
                        data: {
                            labels: salesLabels,
                            datasets: [{
                                label: 'Ventas Totales',
                                data: salesCount,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                    });
                }
            );

            $('#searchByDate').click(function(){
                var startDate=$('#startDate').val();
                var endDate=$('#endDate').val();
                
                const salesChartElem= document.getElementById('salesChart').getContext('2d');
                salesChart.destroy();
                $.ajax({
                    url:  '../controller/sales/getSalesCount.php',
                    type: "POST",
                    data: {startDate: startDate, endDate: endDate },
                }).done(
                    function(response){
                        var salesData = JSON.parse(response);
                        var salesLabels = [];
                        var salesCount = [];
                        var sum=0;
                        for(var i=0;i<salesData.length;i++){
                            sum+=salesData[i][1];
                            salesLabels.push(salesData[i][0]);
                            salesCount.push(salesData[i][1]);
                        }
                        var avg=sum/salesData.length;
                        avg=avg.toFixed(2);
                        $( ".avgData" ).remove();
                        $( ".avgSalesSec" ).append("<h2 class='avgData'>"+avg+"</h2>");
                        salesChart = new Chart(salesChartElem, {
                            type: 'line',
                            data: {
                                labels: salesLabels,
                                datasets: [{
                                    label: 'Ventas Totales',
                                    data: salesCount,
                                    fill: false,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
                                }]
                            },
                        });
                    }
                );
            });

            //Sales By Product Sum
            $.ajax({
                url:  '../controller/sales/getSalesSumByProduct.php',
                type: "GET",
            }).done(
                function(response){
                    console.log(JSON.parse(response));
                    var salesProdsData = JSON.parse(response);
                    var salesProductsLabels = [];
                    var salesProductsSums = [];
                    for(var i=0;i<salesProdsData.length;i++){
                        salesProductsLabels.push(salesProdsData[i][1]+" (%)");
                        salesProductsSums.push(salesProdsData[i][3]);
                    }
                    const saleProdsChartElem= document.getElementById('salesProdChart').getContext('2d');
                    const salesProdsChart = new Chart(saleProdsChartElem, {
                        type: 'pie',
                        data: {
                            labels: salesProductsLabels,
                            datasets: [{
                                label: 'Ventas por Producto',
                                data: salesProductsSums,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            }
                        },
                    });
                }
            );

            //Products Stocks
            $.ajax({
                url:  '../controller/products/getProductStocks.php',
                type: "GET",
            }).done(
                function(response){
                    var prodsData = JSON.parse(response);
                    var prodsLabels = [];
                    var prodsStocks = [];
                    for(var i=0;i<prodsData.length;i++){
                        prodsLabels.push(prodsData[i][1]);
                        prodsStocks.push(prodsData[i][2]);
                    }
                    const prodChartElem= document.getElementById('productsChart').getContext('2d');
                    const prodsChart = new Chart(prodChartElem, {
                        type: 'bar',
                        data: {
                            labels: prodsLabels,
                            datasets: [{
                                label: 'Cantidad disponible',
                                data: prodsStocks,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            );
        });
    </script>
</body>
</html>