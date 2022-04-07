<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $id_ads=$myData['id_ads'];
    //$img_ads=$myData['img_ads'];

    if(!empty($id_ads))
    {
        $query_ads="SELECT * FROM ads WHERE ID_ads=$id_ads";
        $result_ads=mysqli_query($conx,$query_ads);
        if($result_ads){
            while($row=mysqli_fetch_array($result_ads)){
                $image=$row["image_ads"];
                //if($image == $img_ads){
                    $image=$row['images'];
                    
                    unlink($image);
                    
                //}
            }
        }
        $query="DELETE FROM ads WHERE ID_ads=$id_ads";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "La supprission avec success";
        }else{
            echo "échec la supprission";
        }
    }else
    {
        header("location:ads.php");
        exit();
    }
?>