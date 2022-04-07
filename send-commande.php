<?php 
    session_start();
    include_once("Admin/Includes/db.inc.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=FILTER_VAR($_POST['name'],FILTER_SANITIZE_STRING);
        $addresse=FILTER_VAR($_POST['addresse'],FILTER_SANITIZE_STRING);
        $phone=FILTER_VAR($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
        $email=FILTER_VAR($_POST['email'],FILTER_SANITIZE_EMAIL);
        $ville=FILTER_VAR($_POST['ville'],FILTER_SANITIZE_STRING);
        $code_livreur=FILTER_VAR($_POST['code_livreur'],FILTER_SANITIZE_STRING);
        $direction="";
        if(empty($code_livreur)){
            $direction=1;
        }else{
            $direction=0;
        }

        $G_total=0;
        $user_id=$_SESSION["iduser"];
        $user_name=$_SESSION["username"];
        $user_phone=$_SESSION["phone"];
        $user_email=$_SESSION["email"];
   

        $query="SELECT c.ID_cart as id_cart,c.product_owner as product_owner,c.name_product as nameP,c.price_product as priceP,c.image_product as image,c.qnt as qnt,c.total_price as total FROM cart c WHERE ID_user=$user_id AND visibility=1";
        $result=mysqli_query($conx,$query);
        $data=array();
        if($result){
            while($row=mysqli_fetch_array($result)){
                $G_total+=$row["total"];
                $data[]=$row;
            }
        }

        if(!empty($addresse) && !empty($email) && !empty($phone) && !empty($name))
        {
            if(!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$name) || is_numeric($name))
            {
                header("location:validez-comande?form=name");
                exit();
            }
            if(!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$ville))
            {
                header("location:validez-comande?form=object");
                exit();
            } 
            if(!preg_match("/^[\+0-9\-\(\)\s]*$/",$phone))
            {
                header("location:validez-comande?form=phone");
                exit();
            } 
            if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
            {
                header("location:validez-comande?form=email");
                exit();
            }
            $total_price_Qnt=0;
            $Global_total=0;
             for($i=0;$i<count($data);$i++){
                 //les produits dommendes
                $products[]= $data[$i]["nameP"];
                $products_price[]= $data[$i]["priceP"]." DH";
                $products_total_price[]= $data[$i]["total"]." DH";
                $products_qnt[]= $data[$i]["qnt"];
                $ID_owner_store[]= $data[$i]["product_owner"];
            }

            if(empty($products_total_price)){
                header("location:index");
                exit();
            }else{
                for($i=0;$i<count($products_total_price);$i++){
                    $Global_total+=(int)$products_total_price[$i];
                }
            }
            

            //addresse complet
            $addresse_complite= $ville." ".$addresse;

            //Load Composer's autoloader
            require 'vendor/autoload.php';
            // //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = "ssl://smtp.gmail.com";                     //Set the SMTP server to send throughisSMTP
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "amaniy.app@gmail.com";                     //SMTP username
            $mail->Password   = "pL5NB4wa8";                               //SMTP password
            $mail->SMTPSecure = "tls";         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;     
           

            //Content
            $mail->isHTML(true); 
            $mail->CharSet="UTF-8";

            $mail->setFrom($email,$name);
            $mail->addAddress("web@devsoltech.com",$name); 
        

            $mail->Subject = "Commande";
            $mail->Body    = "
            <table border='2' style='border-collapse:collapse;' >
                <thead style='font-size:25px;text-align:center;color:#fff;background-color:#FFB900;'>
                    <tr>
                        <th colspan='8'><h3>Les produits demandé</h3></th>
                    </tr>
                    <tr>
                        <td style='padding:10px;'>Client</td>
                        <td style='padding:10px;'>Phone</td>
                        <td style='padding:10px;'>email</td>
                        <td style='padding:10px;'>Addresse</td>
                        <td style='padding:10px;'>Nom produit</td>
                        <td style='padding:10px;'>Quantité</td>
                        <td style='padding:10px;'>Prix</td>
                        <td style='padding:10px;'>Total Prix</td>
                    </tr>
                </thead>
                <tbody style='font-size:20px;text-align:center;'>
                    <tr>
                        <td style='padding:10px;'>".$user_name."</td>
                        <td style='padding:10px;'>".$user_phone."</td>
                        <td style='padding:10px;'>".$user_email."</td>
                        <td style='padding:10px;'>".$addresse_complite."</td>
                        <td style='padding:10px;'>".implode("<br>",$products) ."</td>
                        <td style='padding:10px;'>".implode("<br>",$products_qnt)."</td>
                        <td style='padding:10px;'>".implode("<br>",$products_price)."</td>
                        <td style='padding:10px;'>".implode("<br>",$products_total_price)."</td>                     
                    </tr>
                    <tr>
                        <td style='font-weight: bold;' colspan='7'>TOTAL PRIX </td>
                        <td style='font-weight: bold;' colspan='7'>".$Global_total." DH</td>
                    </tr>
                </tbody>
            </table>";
                
            $mail->send();
            if(true)
            {
                $products=implode("<br>",$products);
                $products_price=implode("<br>",$products_price);
                $total_price=implode("<br>",$products_total_price);
                $ID_owner_store_=implode("<br>",$ID_owner_store);
                $Qnt=implode("/",$products_qnt);
                $query="INSERT INTO tb_order(`ID_client`,`username`,`products`,`Qnt`,`total_price`,`global_price`,`ville`,`addresse`,`prices`,`phone`,`etat`,`code_livreur`,`direction`,`ID_owner_store`) 
                VALUES('$user_id','$user_name','$products','$Qnt','$total_price','$Global_total','$ville','$addresse','$products_price','$phone','en dépot','$code_livreur',$direction,'$ID_owner_store_')";
                //start
                $result=mysqli_query($conx,$query);
                if(!$result){
                    header("location:validez-comande?form=error");
                    exit();
                   // echo mysqli_error($conx);
                }else{
                    $query_update_item="UPDATE cart SET visibility=0 WHERE ID_user=$user_id";
                    $result_update_item=mysqli_query($conx,$query_update_item);
                    unset($_SESSION['card']);
                    header("location:validez-comande?form=success");
                    exit(); 

                }                    
            }else{
                header("location:validez-comande?form=error");
                exit();
            }  
        }else
        {
            header("location:validez-comande?form=empty");
            exit();
         }
    }
    else
    {
        header("location:404.php");
        exit();
    }