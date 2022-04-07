<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_slider_ads=$myData['id_slider_ads'];
    //$img_ads=$myData['img_ads'];

    if(!empty($id_slider_ads))
    {
        $query="DELETE FROM slider_ads WHERE ID_slider_ads =$id_slider_ads";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:slider_ads.php");
        exit();
    }
?>