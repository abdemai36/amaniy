<?php

    include "Admin/Includes/db.inc.php";
    if(isset($_POST["action"])){
        $query="
            SELECT * FROM produit where 
        ";
        if(isset($_POST["min_price"] , $_POST["max_price"]) && !empty($_POST["max_price"]) && !empty($_POST["max_price"])){
            $query .="
                price BETWEEN '".$_POST["min_price"]."' AND '".$_POST["max_price"]."'
            ";
        }

        if(!empty($_POST["category"])){
            $category=implode("','",$_POST["category"]);
            $query .="
                AND ID_category IN ('".$category."')
            ";
        }

        
        $query .=" ORDER BY ID_produit DESC limit 30";
        $result_=mysqli_query($conx,$query);

        $cout=mysqli_num_rows($result_);
        if($cout == 0){
            echo "<div class='bg-yellow-400 p-3 rounded text-center'>لا يوجد  مطابق لاختيارك</div>";
        }
        /******************************************** */

        if($result_){
            if(mysqli_num_rows($result_) != 0){
                while($row=mysqli_fetch_array($result_)){ 
                    $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                    $titre=str_replace(' ','-',$titre); 
                    
                    $image=$row['images'];
                    $image=explode(' ',$image);
                    $count=count($image)-1;
                    for($i=0;$i<1;$i++){
                        $loop_image_one=$image[$i];
                    }
                ?>
                <a href="detail?titre=<?php echo $titre;?>">
                    <div class="h-72 bg-contain bg-center  bg-no-repeat  relative border-2 bg-hovering"
                        style="background-image: url('Admin/avatar/<?php echo $loop_image_one;?>');">
                        <?php 
                            if($row['promotion']>0){ ?>
                                <div class="ribbon ribbon-top-left"><span><?php echo $row["promotion"];?>%-</span></div>
                            <?php }
                        ?>
                        <div class="flex flex-col p-4">
                        <form action="index" method="POST">
                            <input type="hidden" name="inpt_cart_product_id" value="<?php echo $row['ID_produit'];?>">
                            <button type="submit" name="btn_add_to_cart" class="cursor-pointer w-min">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </form>
                        </div>
                        <div class="absolute bottom-0 bg-gradient-to-t from-gray-200 w-full p-4">
                            <h1 class="font-semibold"><?php echo $row['name_product'];?></h1>
                            <div>
                                <?php
                                    if($row['promotion'] > 0){?>
                                        <span class="text-red-500">
                                            <?php 
                                            $price = $row['price'];
                                            $promotion = $row['promotion'];
                                            $res = "";
                                                $res=$price-($price*$promotion)/100;
                                                echo $res;
                                            ?>د.م
                                        </span>
                                        <span class="line-through"> <?php echo $row['price'];?> د.م</span>
                                <?php  }else{ ?>
                                        <span><?php echo $row['price']?>د.م </span>
                                <?php }
                                ?>                                                
                            </div>
                        </div>
                    </div>              
                </a>                      
                <?php }
            }
        }else{
            echo mysqli_error($conx);
        }
        
        /************************************** */
    
    }