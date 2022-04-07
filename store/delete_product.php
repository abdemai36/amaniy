<?php
    session_start();
    if(isset($_SESSION["idstore"]))
    {
        $id_owner_store=$_SESSION["idstore"];
    }
    $_SESSION["error"]="";
    $_SESSION["success"]="";
    include_once("../Admin/Includes/db.inc.php");
    if(isset($_POST["ID_product"])){
        $ID_product=$_POST["ID_product"];
        $query="DELETE FROM produit WHERE ID_produit=$ID_product";
        $result=mysqli_query($conx,$query);
        if($result){
            $_SESSION["success"]="La suppression avec succès";
            header("location:product");
        }
    }