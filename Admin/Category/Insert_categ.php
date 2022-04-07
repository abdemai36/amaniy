<?php

    include_once("../Includes/db.inc.php");

    $id_categ=$_POST['id_categ'];
    $categorie=str_replace("'", "\\'",$_POST['categorie']);
    
    $logo_category_Name = $_FILES['logo_category']['name'];
    $logo_category_Size = $_FILES['logo_category']['size'];
    $logo_category_tmpN = $_FILES['logo_category']['tmp_name'];
    $image='';
    $dataImg='';
    $logo_category_type = $_FILES['logo_category']['type'];
    $logo_category_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

    //image 
    $image_category_Name = $_FILES['image_category']['name'];
    $image_category_Size = $_FILES['image_category']['size'];
    $image_category_tmpN = $_FILES['image_category']['tmp_name'];
    $image_image='';
    $dataImg_image='';
    $image_category_type = $_FILES['image_category']['type'];
    $image_category_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

    if (is_array($_FILES['logo_category']['name']) || is_object($_FILES['logo_category']['name']) && is_array($_FILES['image_category']['name']) || is_object($_FILES['image_category']['name']))
    {
        foreach($_FILES['logo_category']['name'] as $key=>$val)
        {
            $image=$_FILES['logo_category']['name'][$key];
            $logo_category_tmpN=$_FILES['logo_category']['tmp_name'][$key];
            $logo_category_Extansion =pathinfo($image,PATHINFO_EXTENSION);
            $image=rand(0,1000) . '_' .$image;
            move_uploaded_file($logo_category_tmpN,'../avatar/'.$image);
            $dataImg .=$image." ";
        }
        foreach($_FILES['image_category']['name'] as $key=>$val)
        {
            $image_image=$_FILES['image_category']['name'][$key];
            $image_category_tmpN=$_FILES['image_category']['tmp_name'][$key];
            $image_category_Extansion =pathinfo($image_image,PATHINFO_EXTENSION);
            $image_image=rand(0,1000) . '_' .$image_image;
            move_uploaded_file($image_category_tmpN,'../avatar/'.$image_image);
            $dataImg_image .=$image_image." ";
        }

        if(!in_array($logo_category_Extansion,$logo_category_Allow_Extansion) && !in_array($image_category_Extansion,$image_category_Allow_Extansion) )
        {
            echo "S'il vous plait saisir seulement des images (png | jpg | jpeg | gif)";
        }
        else
        {
            $query="INSERT INTO category(`ID_category`,`name`,`logo`,`image`) 
            VALUES('$id_categ','$categorie','$dataImg','$dataImg_image') ON DUPLICATE KEY UPDATE 
            `name`='$categorie',`logo`='$dataImg',`image`='$dataImg_image'";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "Ajouté avec success";
            }else{
                echo "L'ajoute de categorie a échoué !";
            }
        }
    }
