<?php
    include_once("../Admin/Includes/db.inc.php");
    if(isset($_POST["livre"])){
        $id_order=$_POST["id_order"];
        $query="UPDATE `tb_order` SET etat='livré' WHERE ID_order=$id_order";
        $result=mysqli_query($conx,$query);
        if($result){
            header("location:orders");
            exit();
        }
    }else{
        header("location:orders");
        exit();
    }