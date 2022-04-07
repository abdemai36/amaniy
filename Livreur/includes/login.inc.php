<?php
    session_start();
    include_once("../../Admin/Includes/db.inc.php");
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if(isset($_POST["login-submit-livreur"]))
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
            $query="SELECT * FROM livreurs WHERE email=?";
            //$userType=0;
            $stmt=mysqli_stmt_init($conx);
            if(!mysqli_stmt_prepare($stmt,$query)){
                header("location:../login?form=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result))
                {

                    //$checkpassword=password_verify($pwd,$row["password"]);
                    if($pwd!=$row["password"]){
                        header("location:../login?form=wrongpwd");
                        exit();
                    }elseif($pwd==$row["password"]){
                            $_SESSION["idLivreur"]=$row["ID_livreur"];
                            $_SESSION["username"]=$row["name"];
                            $_SESSION["email"]=$row["email"];
                            $_SESSION["phone"]=$row["phone"];
                            $_SESSION["addresse"]=$row["addresse"];
                            $_SESSION["userType"]="LVR";
                            header("location:../Livreurs-dashboard");
                            exit();
                        
                    }else{
                        header("location:../login?form=wrongpwd");
                        exit();
                    }
                }else{
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