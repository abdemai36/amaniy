<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $ID_sliderads=$myData['ID_slider_ads'];

    $query="SELECT * FROM slider_ads WHERE ID_slider_ads  =$ID_sliderads";
    $result=mysqli_query($conx,$query);
    if($result)
    {
        $row=mysqli_fetch_array($result);
    }
    echo json_encode($row);

?>