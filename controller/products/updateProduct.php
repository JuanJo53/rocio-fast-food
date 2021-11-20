<?php
    include '../../model/Product.php';

    function updateProductData(){ 

        $id=$_POST['prod_idE'];
        $name=$_POST['prod_nameE'];
        $desc=$_POST['prod_descE'];
        $idCat=$_POST['prod_idCatE'];
        $idProv=$_POST['prod_idProvE'];
        $price=$_POST['prod_priceE'];
        $stock=$_POST['prod_stockE'];

        $product = new Product;
        if(!empty($_FILES["imageE"]["name"])) { 
            // Get file info 
            $fileName = basename($_FILES["imageE"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
             
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['imageE']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                return $result = $product->updateProduct($id,$name,$desc,$idCat,$idProv,$price,$stock,$imgContent);
            }else{
                return $result = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        }else{
            $file = '';
            return $result = $product->updateProduct($id,$name,$desc,$idCat,$idProv,$price,$stock,$file);
        }
    }
    echo updateProductData();
    
    header('Location: ../../view/products.php');

?>