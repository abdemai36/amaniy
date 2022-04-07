<?php

    include_once("../Includes/db.inc.php");

    $id_slider_ads=$_POST['id_slider_ads'];
    $titre_slider_ads=$_POST['titre_slider_ads'];
    $url_slider_ads=$_POST['url_slider_ads'];
    $date_slider_debut=$_POST['date_slider_debut'];
    $date_slider_fin=$_POST['date_slider_fin'];


    //image 
    $image_slider_ads_Name = $_FILES['image_slider_ads']['name'];
    $image_slider_ads_Size = $_FILES['image_slider_ads']['size'];
    $image_slider_ads_tmpN = $_FILES['image_slider_ads']['tmp_name'];
    $image_image='';
    $dataImg_image='';
    $image_slider_ads_type = $_FILES['image_slider_ads']['type'];
    $image_slider_ads_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

    if (is_array($_FILES['image_slider_ads']['name']) || is_object($_FILES['image_slider_ads']['name']))
    {
        foreach($_FILES['image_slider_ads']['name'] as $key=>$val)
        {
            $image_image=$_FILES['image_slider_ads']['name'][$key];
            $image_slider_ads_tmpN=$_FILES['image_slider_ads']['tmp_name'][$key];
            $image_slider_ads_Extansion =pathinfo($image_image,PATHINFO_EXTENSION);
            move_uploaded_file($image_slider_ads_tmpN,'../avatar/'.$image_image);
            $dataImg_image .=$image_image." ";
        }

        if(!in_array($image_slider_ads_Extansion,$image_slider_ads_Allow_Extansion) )
        {
            echo "S'il vous plait saisir seulement des images (png | jpg | jpeg | gif)";
        }
        else
        {
            $query="INSERT INTO slider_ads(`ID_slider_ads`,`title_slider_ads`,`image_slider_ads`,`url_slider_ads`,`date_debut_slider_ads`,`date_fin_slider_ads`) 
            VALUES('$id_slider_ads','$titre_slider_ads','$dataImg_image','$url_slider_ads','$date_slider_debut','$date_slider_fin') ON DUPLICATE KEY UPDATE 
            `title_slider_ads`='$titre_slider_ads',`image_slider_ads`='$dataImg_image',`url_slider_ads`='$url_slider_ads',`date_debut_slider_ads`='$date_slider_debut',`date_fin_slider_ads`='$date_slider_fin'";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "Ajouté avec success";
            }else{
                echo "L'ajoute de image slider a échoué !";
                //echo mysqli_error($conx);
            }
        }
    }
