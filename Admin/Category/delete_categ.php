<?php
    include_once("../Includes/db.inc.php");

    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_categ=$myData['id_categ'];

    if(!empty($id_categ))
    {
        $query="DELETE FROM category WHERE ID_category =$id_categ";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:categories.php");
        exit();
    }
?>