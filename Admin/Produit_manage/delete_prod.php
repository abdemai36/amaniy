<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_prod=$myData['id_prod'];

    if(!empty($id_prod))
    {
        $query="DELETE FROM produit WHERE ID_produit=$id_prod";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:Produits.php");
        exit();
    }
?>