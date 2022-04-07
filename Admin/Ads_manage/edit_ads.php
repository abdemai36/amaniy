<?php
    include_once("../Includes/db.inc.php");
    $data=stripslashes(file_get_contents("php://input"));
    $myData=json_decode($data,true);
    $ID_ads=$myData['ID_ads'];

    $query="SELECT * FROM ads WHERE ID_ads =$ID_ads";
    $result=mysqli_query($conx,$query);
    if($result)
    {
        $row=mysqli_fetch_array($result);
    }
    echo json_encode($row);

?>