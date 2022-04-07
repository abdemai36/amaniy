<?php 
    include "Includes/Navbar.php";
    //statistiques of visitor websit
    $visitor_ip=$_SERVER["REMOTE_ADDR"];
    $query_visitor="INSERT into counter_visitor(ip_addresse) values('$visitor_ip')";
    $result_visitor=mysqli_query($conx,$query_visitor);
?>
    <!-- message success  -->         
    <div id="message" class="w-full">
                     
    </div>

    <!-- end topbar -->
        <div class="container m-auto mb-20 px-2 ">
            <div class="flex flex-col w-full mx-auto bg-white rounded-lg mt-20 border" >
                <div class="flex items-center " >
        <div class="w-full">
            <input type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none " placeholder="تهرن ..." id="search" autocomplete="off" dir="rtl">
        </div>
        <div>
            <button  class="flex items-center bg-yellow-400 justify-center w-12 h-12 text-white rounded-r-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="display" class="w-full "></div>
    </div>
    
            <!-- stores -->
            <div class="flex justify-center items-center mt-10 w-full m-auto">
                <div class="swiper mySwiper3 h-1/2 w-full">
                    <div class="swiper-wrapper">
                        <?php
                            $query_store="SELECT * FROM owner_store ORDER BY ID_owStore";
                            $result_store=mysqli_query($conx,$query_store);
                            if($result_store){
                                while($row=mysqli_fetch_array($result_store)){
                                    // replace non letter or digits by divider
                                    //$store = preg_replace('~[^\pL\d]+~u', "-", $row["name_store"]);

                                    $store=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row["name_store"]);
                                    $store=str_replace(' ','-',$store);
                                    ?>
                                    <div class="swiper-slide">
                                        <a href="detailStore?page=1&store=<?php echo $store?>&id=<?php echo $row["ID_owStore"];?>" class="flex flex-col items-center">
                                            <img class="rounded-full w-16 h-16" src="Admin/avatar/<?php echo $row["image"]?>" alt="">
                                            <span class="text-center font-semibold text-sm md:text-md">
                                                <?php 
                                                    if(strlen($row["name_store"])>12)
                                                    {
                                                        echo substr($row["name_store"],0,9)."...";
                                                    }else{
                                                        echo $row["name_store"];
                                                    }                                                 
                                                ?>
                                            </span>
                                        </a>
                                    </div>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- end stores -->

            <div class="swiper mySwiper mt-5 rounded-lg" id="banner-slider" dir="rtl">
                <div class="swiper-wrapper">
                    <?php
                        $query_slider_ads="SELECT * FROM slider_ads WHERE DATE(NOW()) between `date_debut_slider_ads` and `date_fin_slider_ads` ORDER BY ID_slider_ads DESC";
                        $result_slider_ads=mysqli_query($conx,$query_slider_ads);
                        if($result_slider_ads){
                            while($row=mysqli_fetch_array($result_slider_ads)){ ?>
                                <div class="swiper-slide bg-cover bg-center bg-no-repeat flex flex-col justify-center text-white p-5"
                                    style="background-image: url('Admin/avatar/<?php echo $row["image_slider_ads"];?>');">
                                </div>
                            <?php }
                        }else{
                            echo mysqli_error($conx);
                        }
                    ?>
                </div>
            </div>


            <!-- sponsors -->
            <div class="flex justify-center items-center mt-5 w-full m-auto hidden">
                <div class="swiper mySwiper3 h-1/2 w-full">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                        <div class="swiper-slide"><a href="" class="flex flex-col items-center"><img  src="images/R (10).png" alt=""></a></div>
                       
                    </div>
                </div>
            </div>
             

            <!-- end sponsors -->

            <section class="mt-16">
                <div class="flex items-center font-semibold text-4xl mb-4" dir="rtl">
                    <img class="ml-5" width="50" src="Admin/avatar/<?php echo $data_category[0]["logo"]; ?>">    
                    <?php echo $data_category[0]["name"];?>
                </div>
               
                <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-3" dir="rtl">
                    <div class="w-full h-32 md:h-full col-span-2 md:col-span-1 row-span-2 bg-cover"
                        style="background-image: url('Admin/avatar/<?php echo $data_category[0]["image"]; ?>');"></div>
                    <!-- componenet -->
                    <?php
                        $id_category=$data_category[0]["ID_category"];
                        $query_category_prod="SELECT * from produit WHERE ID_category=$id_category AND `etat`='Active' LIMIT 6";
                        $result_cotegory_prod=mysqli_query($conx,$query_category_prod);
                        if($result_cotegory_prod){
                            if(mysqli_num_rows($result_cotegory_prod) != 0){
                                while($row=mysqli_fetch_array($result_cotegory_prod)){ 
                                    $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                                    $titre=str_replace(' ','-',$titre); 
                                    
                                    $image=$row['images'];
                                    $image=explode(' ',$image);
                                    $count=count($image)-1;
                                    for($i=0;$i<1;$i++){
                                        $loop_image_one=$image[$i];
                                    }
                                ?>
                <div class=" relative transition ease-in hover:shadow-md">
                    <div class="bg-contain bg-center  bg-no-repeat h-44 md:h-60"
                    style="background-image: url('Admin/avatar/<?php echo $loop_image_one;?>');">
                    </div>
                    
                    
                    
                   <form action="index" method="POST" class="form-submit absolute top-1 right-1">
                                <input type="hidden" class="id_p" name="id_p" value="<?php echo $row['ID_produit'];?>">
                                <input type="hidden" class="name_p" value="<?php echo $row['name_product'];?>">
                                <input type="hidden" class="id_owner_product" name="id_owner_product" value="<?php echo $row['ID_user']?>">
                                 <?php
                                        if($row['promotion'] > 0){?>
                                            <?php 
                                            $price = $row['price'];
                                            $promotion = $row['promotion'];
                                            $res = "";
                                            $res=$price-($price*$promotion)/100;
                                                        ?>
                                            <input type="hidden" class="price_p" value="<?php echo $res?>">
                                            <?php  }else{ ?>
                                                        <input type="hidden" class="price_p" value="<?php echo $row['price'];?>">
                                            <?php }?>  
                                            <input type="hidden" class="image_p" value="<?php echo $loop_image_one;?>">
                                            <a href="cart" class="addItemBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </a>
                    </form>
                    <?php 
                    if($row['promotion']>0){ ?>
                  
                    <div class="absolute top-1 left-1 bg-yellow-400 text-white font-bold p-1 px-3 rounded-md"> <?php echo $row["promotion"];?>%-</div>
                    <?php }
                ?>
                <div class=" bg-white w-full p-4">
                    <a href="detail?titre=<?php echo $titre;?>">
                        <h1 class="font-semibold">
                            <?php echo $row['name_product'];?>
                        </h1>
                    </a>
                    <div class="w-full">
                        <?php
                        if($row['promotion'] > 0){?>
                        <span class="text-red-500">
                            <?php 
                                $price = $row['price'];
                                $promotion = $row['promotion'];
                                $res = "";
                                    $res=$price-($price*$promotion)/100;
                                    echo number_format($res,2);
                                ?>د.م
                        </span>
                        <span class="line-through">
                            <?php echo number_format($row['price'],2);?> د.م
                        </span>
                        <?php  }else{ ?>
                        <span>
                            <?php echo number_format($row['price'],2) ?>د.م
                        </span>
                        <?php }
                    ?>
                    </div>
                </div>

                </div>
       
                                                    
                                <?php }
                            }else{
                                 echo "<p>جاري المعالجة ...</p>";
                            }
                        }
                    ?>
                    <!-- end componenet --> 
                </div>
            </section>
            <?php
                $query_ads="SELECT * FROM ads WHERE position_ads=1 AND `page`='Accueil' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                $result_ads=mysqli_query($conx,$query_ads);
                if($result_ads){
                    while($row=mysqli_fetch_array($result_ads)){ ?>
                        <a href="<?php echo $row["url_ads"]?>">
                              <div class="my-16 h-44 md:h-80  bg-no-repeat bg-cover bg-center rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                        </div>
                        </a>
                    <?php }
                }
            ?>            
            <section class="mt-16">
                <div class="flex items-center font-semibold text-4xl mb-4 " dir="rtl">
                <img class="ml-5" width="50" src="Admin/avatar/<?php echo $data_category[1]["logo"]; ?>">    
                    <?php echo $data_category[1]["name"];?>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-3" dir="rtl">
                    <div class="w-full h-32 md:h-full col-span-2 md:col-span-1 row-span-2 bg-cover"
                        style="background-image: url('Admin/avatar/<?php echo $data_category[1]["image"]; ?>');"></div>
                    <!-- componenet -->
                    <?php
                        $id_category=$data_category[1]["ID_category"];
                        $query_category_prod="SELECT * from produit WHERE ID_category=$id_category AND `etat`='Active' LIMIT 6";
                        $result_cotegory_prod=mysqli_query($conx,$query_category_prod);
                        if($result_cotegory_prod){
                            if(mysqli_num_rows($result_cotegory_prod) != 0){
                                while($row=mysqli_fetch_array($result_cotegory_prod)){ 
                                    $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                                    $titre=str_replace(' ','-',$titre); 
                                    
                                    $image=$row['images'];
                                    $image=explode(' ',$image);
                                    $count=count($image)-1;
                                    for($i=0;$i<1;$i++){
                                        $loop_image_one=$image[$i];
                                    }
                                ?>
                                    <div class=" relative transition ease-in hover:shadow-md">
                    <div class="bg-contain bg-center  bg-no-repeat h-44 md:h-60"
                    style="background-image: url('Admin/avatar/<?php echo $loop_image_one;?>');">
                    </div>
                    
                    
                    
                   <form action="index" method="POST" class="form-submit absolute top-1 right-1">
                                <input type="hidden" class="id_p" name="id_p" value="<?php echo $row['ID_produit'];?>">
                                <input type="hidden" class="name_p" value="<?php echo $row['name_product'];?>">
                                <input type="hidden" class="id_owner_product" name="id_owner_product" value="<?php echo $row['ID_user']?>">
                                 <?php
                                        if($row['promotion'] > 0){?>
                                            <?php 
                                            $price = $row['price'];
                                            $promotion = $row['promotion'];
                                            $res = "";
                                            $res=$price-($price*$promotion)/100;
                                                        ?>
                                            <input type="hidden" class="price_p" value="<?php echo $res?>">
                                            <?php  }else{ ?>
                                                        <input type="hidden" class="price_p" value="<?php echo $row['price'];?>">
                                            <?php }?>  
                                            <input type="hidden" class="image_p" value="<?php echo $loop_image_one;?>">
                                            <a href="cart" class="addItemBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </a>
                    </form>
                    <?php 
                    if($row['promotion']>0){ ?>
                  
                    <div class="absolute top-1 left-1 bg-yellow-400 text-white font-bold p-1 px-3 rounded-md"> <?php echo $row["promotion"];?>%-</div>
                    <?php }
                ?>
                <div class=" bg-white w-full p-4">
                    <a href="detail?titre=<?php echo $titre;?>">
                        <h1 class="font-semibold">
                            <?php echo $row['name_product'];?>
                        </h1>
                    </a>
                    <div class="w-full">
                        <?php
                        if($row['promotion'] > 0){?>
                        <span class="text-red-500">
                            <?php 
                                $price = $row['price'];
                                $promotion = $row['promotion'];
                                $res = "";
                                    $res=$price-($price*$promotion)/100;
                                    echo number_format($res,2);
                                ?>د.م
                        </span>
                        <span class="line-through">
                            <?php echo number_format($row['price'],2);?> د.م
                        </span>
                        <?php  }else{ ?>
                        <span>
                            <?php echo number_format($row['price'],2) ?>د.م
                        </span>
                        <?php }
                    ?>
                    </div>
                </div>

                </div>
                                                    
                                <?php }
                            }else{
                                 echo "<p>جاري المعالجة ...</p>";
                            }
                        }
                    ?>
                    <!-- end componenet --> 
                </div>
            </section>

            <!-- ads -->
            <div class="grid grid-cols-2 gap-3 mt-16">
            <?php
                $query_ads="SELECT * FROM ads WHERE position_ads=3 AND `page`='Accueil' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                $result_ads=mysqli_query($conx,$query_ads);
                if($result_ads){
                    while($row=mysqli_fetch_array($result_ads)){ ?>
                                <a href="<?php echo $row["url_ads"]?>">      <div class="my-16 h-44 md:h-80  bg-no-repeat bg-cover bg-center rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                        </div></a>
                    <?php }
                }
            ?>

            <?php   
                $query_ads="SELECT * FROM ads WHERE position_ads=2 AND `page`='Accueil' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                $result_ads=mysqli_query($conx,$query_ads);
                if($result_ads){
                    while($row=mysqli_fetch_array($result_ads)){ ?>
                        <a href="<?php echo $row["url_ads"]?>"><div class="my-16 h-44 md:h-80  bg-no-repeat bg-cover bg-center rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                        </div></a>
                    <?php }
                }
            ?>

            </div>
            <?php
                $query_ads="SELECT * FROM ads WHERE position_ads=4 AND `page`='Accueil' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                $result_ads=mysqli_query($conx,$query_ads);
                if($result_ads){
                    while($row=mysqli_fetch_array($result_ads)){ ?>
                        <a href="<?php echo $row["url_ads"]?>">
                           <div class="my-16 h-52 md:h-80  bg-no-repeat bg-cover bg-center rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                        </div>
                        
                        </a>
                    <?php }
                }
            ?>
            
            <section class="mt-16"> 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div dir="rtl">
                        <div class="flex items-center bg-yellow-400 text-white text-2xl p-2 w-full  md:w-2/5 mb-4" style="border-radius: 10px 0 0 0 ;">
                            <img class="ml-5" width="50" src="Admin/avatar/<?php echo $data_category[2]["logo"]; ?>">    
                            <?php echo $data_category[2]["name"];?>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 w-full gap-3" dir="rtl">
                            <!-- componenet -->
                            <?php
                        $id_category=$data_category[2]["ID_category"];
                        $query_category_prod="SELECT * from produit WHERE ID_category=$id_category AND `etat`='Active' LIMIT 6";
                        $result_cotegory_prod=mysqli_query($conx,$query_category_prod);
                        if($result_cotegory_prod){
                            if(mysqli_num_rows($result_cotegory_prod) != 0){
                                while($row=mysqli_fetch_array($result_cotegory_prod)){ 
                                    $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                                    $titre=str_replace(' ','-',$titre); 
                                    
                                    $image=$row['images'];
                                    $image=explode(' ',$image);
                                    $count=count($image)-1;
                                    for($i=0;$i<1;$i++){
                                        $loop_image_one=$image[$i];
                                    }
                                ?>
                               <div class="each mb-10 relative transition ease-in hover:shadow-md">
                    <div class="bg-contain bg-center  bg-no-repeat h-44 md:h-60"
                    style="background-image: url('Admin/avatar/<?php echo $loop_image_one;?>');">
                    </div>
                    
                        <form action="index" method="POST" class="form-submit absolute top-1 right-1">
                                <input type="hidden" class="id_p" name="id_p" value="<?php echo $row['ID_produit'];?>">
                                <input type="hidden" class="name_p" value="<?php echo $row['name_product'];?>">
                                <input type="hidden" class="id_owner_product" name="id_owner_product" value="<?php echo $row['ID_user']?>">
                                 <?php
                                        if($row['promotion'] > 0){?>
                                            <?php 
                                            $price = $row['price'];
                                            $promotion = $row['promotion'];
                                            $res = "";
                                            $res=$price-($price*$promotion)/100;
                                                        ?>
                                            <input type="hidden" class="price_p" value="<?php echo $res?>">
                                            <?php  }else{ ?>
                                                        <input type="hidden" class="price_p" value="<?php echo $row['price'];?>">
                                            <?php }?>  
                                            <input type="hidden" class="image_p" value="<?php echo $loop_image_one;?>">
                                            <a href="cart" class="addItemBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </a>
                    </form>
                    
                    
                    <?php 
                    if($row['promotion']>0){ ?>
                  
                    <div class="absolute top-1 left-1 bg-yellow-400 text-white font-bold p-1 px-3 rounded-md"> <?php echo $row["promotion"];?>%-</div>
                    <?php }
                ?>
                <div class=" bg-white w-full p-4">
                    <a href="detail?titre=<?php echo $titre;?>">
                        <h1 class="font-semibold">
                            <?php echo $row['name_product'];?>
                        </h1>
                    </a>
                    <div class="w-full">
                        <?php
                        if($row['promotion'] > 0){?>
                        <span class="text-red-500">
                            <?php 
                                $price = $row['price'];
                                $promotion = $row['promotion'];
                                $res = "";
                                    $res=$price-($price*$promotion)/100;
                                    echo number_format($res,2);
                                ?>د.م
                        </span>
                        <span class="line-through">
                            <?php echo number_format($row['price'],2);?> د.م
                        </span>
                        <?php  }else{ ?>
                        <span>
                            <?php echo number_format($row['price'],2) ?>د.م
                        </span>
                        <?php }
                    ?>
                    </div>
                </div>

                </div>           
                                                    
                                <?php }
                            }else{
                                 echo "<p>جاري المعالجة ...</p>";
                            }
                        }
                    ?>
                            <!-- end componenet -->
                        </div>
                    </div>
                    <div dir="rtl">
                        <div class="flex items-center bg-purple-400 text-white text-2xl p-2 w-full md:w-2/5 mb-4" style="border-radius: 10px 0 0 0 ;">
                            <img class="ml-5" width="50" src="Admin/avatar/<?php echo $data_category[3]["logo"]; ?>">    
                            <?php echo $data_category[3]["name"];?>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 w-full gap-3" dir="rtl">
                            <!-- componenet -->
                            <?php
                        $id_category=$data_category[3]["ID_category"];
                        $query_category_prod="SELECT * from produit WHERE ID_category=$id_category AND `etat`='Active' LIMIT 6";
                        $result_cotegory_prod=mysqli_query($conx,$query_category_prod);
                        if($result_cotegory_prod){
                            if(mysqli_num_rows($result_cotegory_prod) != 0){
                                while($row=mysqli_fetch_array($result_cotegory_prod)){ 
                                    $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                                    $titre=str_replace(' ','-',$titre); 
                                    
                                    $image=$row['images'];
                                    $image=explode(' ',$image);
                                    $count=count($image)-1;
                                    for($i=0;$i<1;$i++){
                                        $loop_image_one=$image[$i];
                                    }
                                ?>
                                   <div class="each mb-10 relative transition ease-in hover:shadow-md">
                    <div class="bg-contain bg-center  bg-no-repeat h-44 md:h-60"
                    style="background-image: url('Admin/avatar/<?php echo $loop_image_one;?>');">
                    </div>
                        <form action="index" method="POST" class="form-submit absolute top-1 right-1">
                                <input type="hidden" class="id_p" name="id_p" value="<?php echo $row['ID_produit'];?>">
                                <input type="hidden" class="name_p" value="<?php echo $row['name_product'];?>">
                                <input type="hidden" class="id_owner_product" name="id_owner_product" value="<?php echo $row['ID_user']?>">
                                 <?php
                                        if($row['promotion'] > 0){?>
                                            <?php 
                                            $price = $row['price'];
                                            $promotion = $row['promotion'];
                                            $res = "";
                                            $res=$price-($price*$promotion)/100;
                                                        ?>
                                            <input type="hidden" class="price_p" value="<?php echo $res?>">
                                            <?php  }else{ ?>
                                                        <input type="hidden" class="price_p" value="<?php echo $row['price'];?>">
                                            <?php }?>  
                                            <input type="hidden" class="image_p" value="<?php echo $loop_image_one;?>">
                                            <a href="cart" class="addItemBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </a>
                    </form>
                    <?php 
                    if($row['promotion']>0){ ?>
                  
                    <div class="absolute top-1 left-1 bg-yellow-400 text-white font-bold p-1 px-3 rounded-md"> <?php echo $row["promotion"];?>%-</div>
                    <?php }
                ?>
                <div class=" bg-white w-full p-4">
                    <a href="detail?titre=<?php echo $titre;?>">
                        <h1 class="font-semibold">
                            <?php echo $row['name_product'];?>
                        </h1>
                    </a>
                    <div class="w-full">
                        <?php
                        if($row['promotion'] > 0){?>
                        <span class="text-red-500">
                            <?php 
                                $price = $row['price'];
                                $promotion = $row['promotion'];
                                $res = "";
                                    $res=$price-($price*$promotion)/100;
                                    echo number_format($res,2);
                                ?>د.م
                        </span>
                        <span class="line-through">
                            <?php echo number_format($row['price'],2);?> د.م
                        </span>
                        <?php  }else{ ?>
                        <span>
                            <?php echo number_format($row['price'],2) ?>د.م
                        </span>
                        <?php }
                    ?>
                    </div>
                </div>

                </div>             
                                                    
                                <?php }
                            }else{
                                 echo "<p>جاري المعالجة ...</p>";
                            }
                        }
                    ?>
                            <!-- end componenet -->
                        </div>    
                </div>
            </section>
            <?php
                $query_ads="SELECT * FROM ads WHERE position_ads=5 AND `page`='Accueil' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                $result_ads=mysqli_query($conx,$query_ads);
                if($result_ads){
                    while($row=mysqli_fetch_array($result_ads)){ ?>
                        <a href="<?php echo $row["url_ads"]?>"><div class="my-16 h-52 md:h-80  bg-no-repeat bg-cover bg-center rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                        </div></a>
                    <?php }
                }
            ?>
        </div>
    </div>
<?php 
    include "Includes/footer.php";
?>        