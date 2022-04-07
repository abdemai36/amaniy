<?php
    include_once("Includes/db.inc.php");
    if(isset($_POST["update_order"])){
        $code_livreur=$_POST["code_livreur"];
        $id_order=$_POST["id_order"];

        $query="UPDATE tb_order SET code_livreur='$code_livreur',direction=1 WHERE ID_order=$id_order";
        $result=mysqli_query($conx,$query);
        if($result){
            header("location:Orders?message=success");
            exit();
            
        }else{
            echo mysqli_error($conx);
        }
    }else{
        header("location:Orders");
        exit();
    }