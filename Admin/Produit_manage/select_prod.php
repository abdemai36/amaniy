<?php
    include_once("../Includes/db.inc.php");

    $query="SELECT *,c.name as category_name FROM produit p inner join category c on p.ID_category=c.ID_category ";
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