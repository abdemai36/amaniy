<?php
    include_once("../Includes/db.inc.php");

    // $data=stripslashes(file_get_contents("php://input"));
    // $_POST=json_decode($data,true);
    $id_livreur=$_POST['id_livreur'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];
    $addresse=$_POST['addresse'];
    $ville=$_POST['ville'];
    $code=$_POST['code'];
  
    //update or insert data
    $query_select="SELECT * FROM livreurs where `email`='".$email."' OR code_livreur='".$code."'";
    $result_select=mysqli_query($conx,$query_select);
    $date=date("Y-m-d");
    if($result_select){
        if(mysqli_num_rows($result_select) !=0 ){
             echo "Email ou le code que vous sais déjà existe ! ";
        }else{
            $query="INSERT INTO livreurs(ID_livreur,`name`,email,`password`,phone,addresse,ville,code_livreur,date) 
            VALUES('$id_livreur','$name','$email','$password','$phone','$addresse','$ville','$code','$date') ON DUPLICATE 
            KEY UPDATE `name`='$name',email='$email',`password`='$password',phone='$phone',addresse='$addresse',ville='$ville',code_livreur ='$code',date='$date'";
            $result=mysqli_query($conx,$query);
            if($result)
            {
                echo "L'ajoute avec success";
            }else{ 
                echo mysqli_error($conx);
            }
        }
    }
    
    
?>

