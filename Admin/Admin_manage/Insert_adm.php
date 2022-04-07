<?php
    include_once("../Includes/db.inc.php");

    // $data=stripslashes(file_get_contents("php://input"));
    // $_POST=json_decode($data,true);
    $id=$_POST['id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];
    $addresse=$_POST['addresse'];


    //update or insert data
    if(!empty($username) && !empty($password) && !empty($email))
    {
        $query="INSERT INTO users(userID,username,email,`password`,userType,phone,addresse) VALUES('$id','$username','$email','$_POST['password']','ADM','$phone','$addresse') ON DUPLICATE 
        KEY UPDATE username='$username',email='$email',`password`='$password',userType='ADM',phone='$phone',addresse='$addresse'";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            echo "L'ajoute avec success";
        }else{
            echo "échec de l'ajout (Nom d'admin ou email déjà existe ! )";
            //echo mysqli_error($conx);
        }
    }else
    {
        echo "Saisir tous les information";
    }
?>

