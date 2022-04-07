<?php
    session_start();
    include_once("Admin/Includes/db.inc.php");

    if(isset($_POST['ip'])){
        $ip=$_POST['ip'];
        $iname=$_POST['namep'];
        $iprice=$_POST['pricep'];
        $iimage=$_POST['imagep'];
        $id_owner_product=$_POST['id_owner_product'];
        $qntp=1;

        if(isset($_SESSION["iduser"])){
            $user_id=$_SESSION["iduser"];
            $query_select_product_cart="SELECT * FROM cart WHERE ID_produit=$ip and ID_user=$user_id AND visibility=1";
            $result_select_product_cart=mysqli_query($conx,$query_select_product_cart);
            if($result_select_product_cart){
                if(mysqli_num_rows($result_select_product_cart) == 0){
                    $query_insert_product_cart="INSERT INTO cart(name_product,ID_produit,price_product,image_product,qnt,total_price,ID_user,visibility,product_owner) VALUES('".$iname."',".$ip.",'".$iprice."',' ".$iimage."',$qntp,'".$iprice."',$user_id,1,'$id_owner_product')";
                    $result_insert_product_cart=mysqli_query($conx,$query_insert_product_cart);
                    if($result_insert_product_cart){
                        echo "<div class='z-50 bg-green-500 text-center text-white py-3 w-full fixed top-0'>
                                تم اضافة المنتج الى السلة بنجاح
                            </div>";
                    }
                }else{
                    echo "<div class='z-50 bg-red-500 text-center text-white py-3 w-full fixed top-0'>
                        المنتج موجود في السلة 
                    </div>";
                }
            }
        }else{
            if(isset($_SESSION["cart"])){

                $item_array_id=array_column($_SESSION["cart"],"product_id");
                if(in_array($ip,$item_array_id)){
                    echo "<div class='z-50 bg-red-500 text-center text-white py-3 w-full fixed top-0'>
                        المنتج موجود في السلة 
                    </div>";
                }else{
                    $count=count($_SESSION["cart"]);
                    $item_array=array(
                        "product_id" =>$ip, 
                    );
                    $_SESSION["cart"][$count]=$item_array;
                }

            }else{
                $item_array=array(
                    "product_id" =>$ip, 
                );

                $_SESSION["cart"][0]=$item_array;
                
            }
        }
        
    }

    // Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        if(isset($_SESSION["iduser"])){
            $user_id=$_SESSION["iduser"];
            $query_select_product_cart="SELECT count(*) FROM cart WHERE ID_user=$user_id AND visibility=1";
            $result_select_number_product_cart=mysqli_query($conx,$query_select_product_cart);
            $rows = mysqli_fetch_row($result_select_number_product_cart);
            echo $rows[0];
        }else{
            if(isset($_SESSION["cart"])){
                echo count($_SESSION["cart"]);
            }else{
                echo "0";
            }
        }        
    }

    // Remove single items from cart
	if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
        if(isset($_SESSION["iduser"])){
            $user_id=$_SESSION["iduser"];
            $query_dalete_item="DELETE FROM cart WHERE ID_cart=$id AND ID_user=$user_id";
            $result_delete_item=mysqli_query($conx,$query_dalete_item);
            header('location:cart');
        }else{
            if(isset($_SESSION["cart"])){
                foreach($_SESSION["cart"] as $key => $value){
                    if($value["product_id"] == $id){
                        unset($_SESSION["cart"][$key]);
                        header('location:cart');
                    }
                }
            }
        }
    }

    // Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $pprice = $_POST['pprice'];
  
        $tprice = $qty * $pprice;
        if(isset($_SESSION["iduser"])){
            $user_id=$_SESSION["iduser"];
            $query_update_item="UPDATE cart SET qnt=$qty, total_price=$tprice WHERE ID_produit=$pid AND ID_user=$user_id";
            $result_update_item=mysqli_query($conx,$query_update_item);
        }
    }