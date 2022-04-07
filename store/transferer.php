<?php

    session_start();
    ob_start();
    include_once("../Admin/Includes/db.inc.php");
    if(!isset($_SESSION['type_user']) || $_SESSION["type_user"]!="STR")
    {
        header("location:create-store");
        exit();
    }

    if(isset($_GET["id"]) && !empty($_GET["id"]))
    {
        $id_order=$_GET["id"];
    }else{
        header("location:orders");
        exit();
    }

    $query="SELECT * FROM tb_order ORDER BY ID_order DESC";
    $result=mysqli_query($conx,$query);
    if($result)
    {
        if(mysqli_num_rows($result)!=0)
        {
            while($row=mysqli_fetch_array($result))
            {
                $ID_owner_store=explode("<br>",$row["ID_owner_store"]);              
                if(!in_array("0",$ID_owner_store))
                { 
                    array_push($ID_owner_store,'0');
                    $ID_owner_store=implode("<br>",$ID_owner_store);
                    $query_update="UPDATE `tb_order` SET `ID_owner_store` = '".$ID_owner_store."' where `ID_order` = '$id_order'";
                    $result_update=mysqli_query($conx,$query_update);
                    if($result_update)
                    {
                        header("location:orders");
                        exit();   
                    }
                }else
                {
                    echo "<script>alert('ce poduit deja trans')</script>";
                    header("location:orders");
                    exit(); 
                }
            }
        }
    }

?>