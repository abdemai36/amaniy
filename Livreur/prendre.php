<?php
    include_once("../Admin/Includes/db.inc.php");
    if(isset($_POST["prendre"])){
        $id_order=$_POST["id_order"];
        $query="UPDATE `tb_order` SET etat='En cours Liv.' WHERE ID_order=$id_order ";
        $result=mysqli_query($conx,$query);
        if($result){
            header("location:orders");
            exit();
        }
    }else{
        header("location:orders");
        exit();
    }