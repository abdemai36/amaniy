<?php

    include_once("../Includes/db.inc.php");

    $id_ads=$_POST['id_ads'];
    $titre_ads=$_POST['titre_ads'];
    $page=$_POST['page'];
    $url_ads=$_POST['url_ads'];
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $position_ads=$_POST['position_ads'];


    //image 
    $image_ads_Name = $_FILES['image_ads']['name'];
    $image_ads_Size = $_FILES['image_ads']['size'];
    $image_ads_tmpN = $_FILES['image_ads']['tmp_name'];
    $image_image='';
    $dataImg_image='';
    $image_ads_type = $_FILES['image_ads']['type'];
    $image_ads_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

    if (is_array($_FILES['image_ads']['name']) || is_object($_FILES['image_ads']['name']))
    {
        foreach($_FILES['image_ads']['name'] as $key=>$val)
        {
            $image_image=$_FILES['image_ads']['name'][$key];
            $image_ads_tmpN=$_FILES['image_ads']['tmp_name'][$key];
            $image_ads_Extansion =pathinfo($image_image,PATHINFO_EXTENSION);
            $image_image=rand(0,10000) . '_' .$image_image;
            move_uploaded_file($image_ads_tmpN,'../avatar/'.$image_image);
            $dataImg_image .=$image_image." ";
        }

        if(!in_array($image_ads_Extansion,$image_ads_Allow_Extansion) )
        {
            echo "S'il vous plait saisir seulement des images (png | jpg | jpeg | gif)";
        }
        else
        {
            $query="INSERT INTO ads(`ID_ads`,`titre_ads`,`image_ads`,`url_ads`,`position_ads`,`page`,`date_debut`,`date_fin`) 
            VALUES('$id_ads','$titre_ads','$dataImg_image','$url_ads','$position_ads','$page','$date_debut','$date_fin') ON DUPLICATE KEY UPDATE 
            `titre_ads`='$titre_ads',`image_ads`='$dataImg_image',`url_ads`='$url_ads',`position_ads`='$position_ads',`page`='$page',`date_debut`='$date_debut',`date_fin`='$date_fin'";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "Ajouté avec success";
            }else{
                echo "L'ajoute de ads a échoué !";
                echo mysqli_error($conx);
            }
        }
    }
