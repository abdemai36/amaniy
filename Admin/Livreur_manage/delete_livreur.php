<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_livreur=$myData['id_livreur'];

    if(!empty($id_livreur))
    {
        $query="DELETE FROM livreurs WHERE ID_livreur=$id_livreur";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:livreur.php");
        exit();
    }
?>