<?php
    include '../../model/Product.php';

    $name=$_POST['prod_name'];
    $desc=$_POST['prod_desc'];
    $idCat=$_POST['prod_idCat'];
    $idProv=$_POST['prod_idProv'];
    $price=$_POST['prod_price'];
    $stock=$_POST['prod_stock'];

    $product = new Product;
    $result = $product->newProduct($name,$desc,$idCat,$idProv,$price,$stock);
    echo $result;
    header('Location: ../../view/products.php');

?>