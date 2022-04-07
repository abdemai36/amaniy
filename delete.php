<?php
    session_start();
    include_once("Admin/Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    
    $id_prod=$myData['id_prod'];
    if(!empty($id_prod))
    {
        foreach($_SESSION['card'] as $key=>$value){
            if($value["product_id"]==$id_prod){
                unset($_SESSION['card'][$key]);
                echo "تم الحذف بنجاح";
            }
        }
    }else
    {
        header("location:index");
        exit();
    }
?>
