<?php
    session_start();
    include_once("../Admin/Includes/db.inc.php");
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if(isset($_POST["login-submit"]))
    {
        $email= mysqli_real_escape_string($conx,$_POST["email"]);
        $pwd= mysqli_real_escape_string($conx,$_POST["pwd"]);

        if(empty($email) || empty($pwd)){
            header("location:../login?form=empty");
            exit();
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("location:../login?form=email");
            exit();
        }else{
            $query="SELECT * FROM users WHERE email='".$email."'";
            $result=mysqli_query($conx,$query);
            if($result)
            {
                if(mysqli_num_rows($result) !=0){
                    while($row=mysqli_fetch_array($result)){
                    $checkpassword=password_verify($pwd,$row["password"]);
                    if($checkpassword==false){
                        header("location:../login?form=wrongpwd");
                        exit();
                    }elseif($checkpassword==true){
                        $userType=$row["userType"];
                        if($userType=="SLR"){
                            $_SESSION["iduser"]=$row["userID"];
                            $_SESSION["username"]=$row["username"];
                            $_SESSION["email"]=$row["email"];
                            $_SESSION["phone"]=$row["phone"];
                            $_SESSION["addresse"]=$row["addresse"];
                            $_SESSION["userType"]="SLR";
                            header("location:../index");
                            exit();
                        }elseif($userType=="ADM"){
                            $_SESSION["iduser"]=$row["userID"];
                            $_SESSION["username"]=$row["username"];
                            $_SESSION["email"]=$row["email"];
                            $_SESSION["phone"]=$row["phone"];
                            $_SESSION["addresse"]=$row["addresse"];
                            $_SESSION["userType"]="ADM";
                            header("location:../Admin/Dashboard");
                            exit();
                        }else{
                            $_SESSION["iduser"]=$row["userID"];
                            $_SESSION["username"]=$row["username"];
                            $_SESSION["email"]=$row["email"];
                            $_SESSION["userType"]="USR";
                            $_SESSION["phone"]=$row["phone"];
                            $_SESSION["addresse"]=$row["addresse"];
                            header("location:../index");
                            exit();
                        }
                    }else{
                        header("location:../login?form=wrongpwd");
                        exit();
                    }
                }
                    
                }else{
                    //echo mysqli_error($conx);
                    header("location:../login?form=wrongpwd");
                    exit();
                }
            }
        }
    }else
    {
        header("location:../login");
        exit();
    }
?>