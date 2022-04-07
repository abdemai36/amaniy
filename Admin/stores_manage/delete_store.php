<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_store=$myData['id_store'];

    if(!empty($id_store))
    {
        $query="DELETE FROM owner_store WHERE ID_owStore=$id_store";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:stores.php");
        exit();
    }
?>