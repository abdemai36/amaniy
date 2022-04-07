<?php
    include_once("../Includes/db.inc.php");

    $query="SELECT * FROM category ORDER BY ID_category  asc";
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