<?php
    include '../../model/Product.php';

    $name=$_POST['prod_name'];
    $desc=$_POST['prod_desc'];
    $idCat=$_POST['prod_idCat'];
    $idProv=$_POST['prod_idProv'];
    $price=$_POST['prod_price'];
    $stock=$_POST['prod_stock'];
    
    $product = new Product;
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));
            $result = $product->newProduct($name,$desc,$idCat,$idProv,$price,$stock,$imgContent);
        }else{
            $result = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    }else{
        $file = '';
        $result = $product->newProduct($name,$desc,$idCat,$idProv,$price,$stock,$file);
    }
    echo $result;
    header('Location: ../../view/products.php');

?>