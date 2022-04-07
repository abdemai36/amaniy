<?php

    include_once("../Includes/db.inc.php");

    $id_prod=$_POST['id_prod'];
    $produit=str_replace("'", "\\'",$_POST['produit']);
    $QNT=$_POST['QNT'];
    $price=$_POST['price'];
    $description=str_replace("'", "\\'",$_POST['description']);
    $categorie=$_POST['categorie'];

    $etat=$_POST['etat'];
    $promo=$_POST['promo'];

    
    $img_prod_Name = $_FILES['img_prod']['name'];
    $img_prod_Size = $_FILES['img_prod']['size'];
    $img_prod_tmpN = $_FILES['img_prod']['tmp_name'];
    $image='';
    $dataImg='';
    $img_prod_type = $_FILES['img_prod']['type'];
    $img_prod_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");

    if (is_array($_FILES['img_prod']['name']) || is_object($_FILES['img_prod']['name']))
    {
        foreach($_FILES['img_prod']['name'] as $key=>$val)
        {
            $image=$_FILES['img_prod']['name'][$key];
            $img_prod_tmpN=$_FILES['img_prod']['tmp_name'][$key];
            $img_prod_Extansion =pathinfo($image,PATHINFO_EXTENSION);
            move_uploaded_file($img_prod_tmpN,'../avatar/'.$image);
            $dataImg .=$image." ";
        }
        if(!in_array($img_prod_Extansion,$img_prod_Allow_Extansion))
        {
            echo "S'il vous plait saisir seulement des image (png | jpg | jpeg | gif)";
        }
        else
        {
            $query="INSERT INTO produit(`ID_produit`,`name_product`,`description`,`etat`,`qnt`,`promotion`,`ID_category`,`price`,`images`) 
            VALUES('$id_prod','$produit','$description','$etat','$QNT','$promo',$categorie,$price,'$dataImg') ON DUPLICATE KEY UPDATE 
            `name_product`='$produit',`description`='$description',`etat`='$etat',`qnt`='$QNT',`promotion`='$promo',`ID_category`='$categorie',`price`=$price,`images`='$dataImg'";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "Ajouté avec success";
                
            }else{
                echo "L'ajoute de produit a échoué !";
                //echo mysqli_error($conx);
            }
        }
    }
