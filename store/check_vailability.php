<?php
    include_once("../Admin/Includes/db.inc.php");
    
    $username=$_POST["username"];
    $name_store=$_POST["name_store"];
    $email=$_POST["email"];
    $pwd=$_POST["pwd"];
    $repeat_pwd=$_POST["repeat_pwd"];
    $phone=$_POST["phone"];
    $description=$_POST["description"];
    
    $check_name_store=false;
    $check_email=false;
    $check_username=false;
    $check_pwd=false;
    $check_repeat_pwd=false;
    $check_phone=false;
    $check_description=false;
    $check_extention_image=false;
    $check_image_store=false;

    if(isset($_POST["name_store"])){
        $name_store=strtolower(trim(filter_var($_POST["name_store"],FILTER_SANITIZE_STRING)));
        if(!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$name_store)){
            echo "<li>اسم المتجر غير صحيح</li>";
        }else{
            $query="SELECT * FROM owner_store WHERE name_store='$name_store'";
            $result=mysqli_query($conx,$query);
            $count=mysqli_num_rows($result);
            if($count>0){
                echo "<li>هدا الاسم موجود مسبقا</li>";
                $check_name_store=false;
            }else{
                $check_name_store=true;
            }
        }
    }
    if(isset($_POST["email"])){
        $email=strtolower(trim(filter_var($_POST["email"],FILTER_SANITIZE_EMAIL)));
        $query="SELECT * FROM owner_store WHERE email='$email'";
        $result=mysqli_query($conx,$query);
        $count=mysqli_num_rows($result);
        if($count>0){
            echo "<li>البريد الالكتروني  موجود مسبقا</li>";
            $check_email=false;
        }else{
            $check_email=true;
        }
    }
    if(isset($_POST["username"])){
        $username=strtolower(trim(filter_var($_POST["username"],FILTER_SANITIZE_STRING)));
        if(!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$username)){
            echo "<li>الاسم غير صحيح</li>";
            $check_username=false;
        }else{
            $check_username=true;
        }
    }
    if(isset($_POST["pwd"])){
        $pwd=strtolower(trim(filter_var($_POST["pwd"],FILTER_SANITIZE_STRING)));
        if(strlen($pwd)>=25){
            echo "يجب إدخال كلمة المرور اقل من 25 حرفًا";
            $check_pwd=false;
        }else{
            $check_pwd=true;
        }
    }
    if(isset($_POST["repeat_pwd"]) && isset($_POST["pwd"])){
        $repeat_pwd=strtolower(trim(filter_var($_POST["repeat_pwd"],FILTER_SANITIZE_STRING)));
        $pwd=strtolower(trim(filter_var($_POST["pwd"],FILTER_SANITIZE_STRING)));
        if($pwd !== $repeat_pwd){
            echo "<li class='text-red-500'>كلمة المرور غير متطابقة</li>";
            $check_repeat_pwd=false;
        }elseif(empty($pwd) && empty($repeat_pwd)){
            echo "<li class='text-red-500'>المرجو ادخال كلمة المرور</li>";
            $check_repeat_pwd=false;
        }else{
            $check_repeat_pwd=true;
        }
    }
    if(isset($_POST["phone"])){
        $phone=strtolower(trim(filter_var($_POST["phone"],FILTER_SANITIZE_NUMBER_INT)));
        if(!preg_match("/^[06|07|05|6|7|5][0-9]{8,}$/",$phone)){
            echo "<li>رقم الهاتف غير صحيح<li>";
            $check_phone=false;
        }else{
            $check_phone=true;
        }
    }
    if(isset($_POST["description"])){
        $description=strtolower(trim(filter_var($_POST["description"],FILTER_SANITIZE_STRING)));
        if(strlen($description)<10 || empty($description)){
            echo "<li>المرجو ادخال وصف لمتجرك</li>";
            $check_description=false;
        }else{
            $check_description=true;
        }
    }
    $image_store_Name = strtolower(trim(filter_var($_FILES['image_store']['name'],FILTER_SANITIZE_STRING)));
      
    $image_store_Size = $_FILES['image_store']['size'];
    $image_store_tmpN = $_FILES['image_store']['tmp_name'];
    $image='';
    $dataImg='';
    $image_store_type = $_FILES['image_store']['type'];
    $image_store_Allow_Extansion = array("jpeg","png","jpg","PNG","JEPJ","JPG");

    if($image_store_Size>0){

        if (is_array($_FILES['image_store']['name']) || is_object($_FILES['image_store']['name']))
        {
            foreach($_FILES['image_store']['name'] as $key=>$val)
            {
                $image=$_FILES['image_store']['name'][$key];
                $image_store_tmpN=$_FILES['image_store']['tmp_name'][$key];
                $image_store_Extansion =pathinfo($image,PATHINFO_EXTENSION);
                move_uploaded_file($image_store_tmpN,'../Admin/avatar/'.$image);
                $dataImg .=$image." ";
            }
        }
        if(!in_array($image_store_Extansion,$image_store_Allow_Extansion))
        {
            echo "المرجو ادخال الصورة بصيغة PNG او JPEG او JPG ";
            $check_extention_image=false;
        }else
        {
            $check_image_store=true;
            $check_extention_image=true;
            if($check_name_store==true && $check_username==true && $check_description==true && $check_phone==true && $check_repeat_pwd==true && $check_pwd==true && $check_email==true && $check_image_store==true && $check_extention_image=true){
               $query="INSERT INTO `owner_store`(`type_user`, `username`, `password`, `email`, `phone`, `image`, `name_store`, `description`, `date`) 
               VALUES ('STR','$username','$pwd','$email','$phone','$image','$name_store','$description','".date("Y-m-d")."')";
               $result=mysqli_query($conx,$query);
               if($result){
                   header("location:https://amaniylivreur.devsoltech.com/login");
                   exit();
                   echo "success";
               }else{
                    echo "هناك خطا في معلوماتك";
               }
            }           
        }
    }else{
        echo "المرجو ادخال الصورة";
    }

    

    // if (file_exists('http://www.mydomain.com/images/'.$filename)) {
    //  }

     
    