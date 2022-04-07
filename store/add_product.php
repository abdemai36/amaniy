<?php
    session_start();
    if(isset($_SESSION["idstore"]))
    {
        $id_owner_store=$_SESSION["idstore"];
    }
    $_SESSION["error"]="";
    $_SESSION["success"]="";
    include_once("../Admin/Includes/db.inc.php");
    if(isset($_POST["add_product"])){
        $name_product=$_POST["name_product"];
        $description=$_POST["description"];
        $prix=$_POST["prix"];
        $promotion=$_POST["promotion"];
        $qnt=$_POST["qnt"];
        $etat=$_POST["etat"];
        $categoriy=$_POST["categoriy"];
        

        if(empty($name_product)){
            $_SESSION["error"]="Veuillez saisir le nom du produit";
            header("location:product");
        }
        if(empty($description)){
            $_SESSION["error"]="Veuillez saisir la description du produit";
            header("location:product");
        }
        if(empty($prix)){
            $_SESSION["error"]="Veuillez saisir le prix du produit";
            header("location:product");
        }
        if(empty($etat)){
            $_SESSION["error"]="Veuillez saisir état du produit";
            header("location:product");
        }
        if(empty($categoriy)){
            $_SESSION["error"]="Veuillez saisir catégorie du produit";
            header("location:product");
        }

        $image_product_Name = $_FILES['image_product']['name'];
        $image_product_Size = $_FILES['image_product']['size'];
        $image_product_tmpN = $_FILES['image_product']['tmp_name'];
        $image='';
        $dataImg='';
        $image_product_type = $_FILES['image_product']['type'];
        $image_product_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

        if (is_array($_FILES['image_product']['name']) || is_object($_FILES['image_product']['name']))
        {
            foreach($_FILES['image_product']['name'] as $key=>$val)
            {
                $image=$_FILES['image_product']['name'][$key];
                $image_product_tmpN=$_FILES['image_product']['tmp_name'][$key];
                $image_product_Extansion =pathinfo($image,PATHINFO_EXTENSION);
                move_uploaded_file($image_product_tmpN,'../Admin/avatar/'.$image);
                $dataImg .=$image." ";
            }
            if(!in_array($image_product_Extansion,$image_product_Allow_Extansion))
            {
                $_SESSION["error"]="S'il vous plait saisir seulement des image (png | jpg | jpeg | gif)";
                header("location:product");
            }
            else
            {
                $query="INSERT INTO produit(`name_product`,`description`,`etat`,`qnt`,`promotion`,`ID_category`,`price`,`images`,`ID_user`) 
                VALUES('$name_product','$description','$etat','$qnt','$promotion','$categoriy','$prix','$dataImg','$id_owner_store')";
                $result=mysqli_query($conx,$query);
                if($result){
                    $_SESSION["success"]="Ajouté avec success";
                    header("location:product");
                }else{
                    
                    $_SESSION["error"]="L'ajoute de produit a échoué !";
                    header("location:product");
                    $_SESSION["error"]=mysqli_error($conx);
                }
            }
        }

    }else{
        header("location:product");
        exit();
    }