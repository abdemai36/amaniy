<?php
       session_start();
       include_once("../Admin/Includes/db.inc.php");
    if(isset($_POST["create-submit"])){

        $name=mysqli_real_escape_string($conx,$_POST["name"]);
        $addresse=mysqli_real_escape_string($conx,$_POST["addesse"]);
        $email=mysqli_real_escape_string($conx,$_POST["email"]);
        $phone=mysqli_real_escape_string($conx,$_POST["phone"]);
        $pwd=mysqli_real_escape_string($conx,$_POST["pwd"]);
        $pwd_repeat=mysqli_real_escape_string($conx,$_POST["pwd-repeat"]);

        if(empty($name) || empty($email) || empty($addresse) || empty($pwd) || empty($pwd_repeat))
        {
            header("location:../signup?form=empty");
            exit();
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z-\s]*$/",$name)){
            header("location:../signup?form=uslsremail");
            exit();
        }elseif($pwd !== $pwd_repeat)
        {
            header("location:../signup?form=pwd");
            exit();
        }
        elseif(strlen($pwd)<6){
            header("location:../signup?form=len-pwd");
            exit();
        }       
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("location:../signup?form=email");
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z-\s]*$/",$addresse)){
            header("location:../signup?form=addresse");
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z-\s]*$/",$name)){
            header("location:../signup?form=name");
            exit();
        }else{
            $query="SELECT email FROM users WHERE email=?";
            $stmt=mysqli_stmt_init($conx);
            if(!mysqli_stmt_prepare($stmt,$query)){
                header("location:../signup?form=uralreadyexcited");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $result=mysqli_stmt_num_rows($stmt);
                if($result>0)
                {
                    header("location:../signup?form=urtaken");
                    exit();
                }else{
                    $query="INSERT into users(username,email,password,phone,addresse,userType) VALUE (?,?,?,?,?,?)";
                    $stmt=mysqli_stmt_init($conx);
                    $GoupeID="USR";
                    $hash_password=password_hash($pwd,PASSWORD_DEFAULT);
                    if(!mysqli_stmt_prepare($stmt,$query)){
                        header("location:../signup?form=sqlerror");
                        exit();
                        //echo mysqli_error($conx);
                    }else{
                        mysqli_stmt_bind_param($stmt,"ssssss",$name,$email,$pwd,$phone,$addresse,$GoupeID);
                        mysqli_stmt_execute($stmt);
                        header("location:../login");
                        exit();
                    }
                }
            }
        }

    }else
    {
        header("location:../index.php");
        exit();
    }

   
