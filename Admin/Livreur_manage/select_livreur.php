<?php
    include_once("../Includes/db.inc.php");
   // $limit=2;
    $query="SELECT * FROM livreurs";
    $result=mysqli_query($conx,$query);
    if($result)
    {
        $data=array();
        while($row=mysqli_fetch_array($result))
        {
            $data[]=$row;
        }
    }
    echo json_encode($data);

?>