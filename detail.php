<?php 
    include "Includes/Navbar.php";

    if(isset($_GET["titre"]) ){
        $titre=$_GET["titre"];
        $titre=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$titre);
        $titre=str_replace(array('-','%27'),array(' ',"\\'"),$titre);

        $query="SELECT * FROM produit WHERE name_product='$titre' LIMIT 1";
        $result=mysqli_query($conx,$query);
        if($result){
            while($row=mysqli_fetch_array($result)){
                $category=$row["ID_category"];
            }
        }
    }else{
        header("location:index");
        exit();
    }
?>
    <!-- main page -->
    <div class="container m-auto px-2 mb-20">
        
             <div class="flex flex-col w-full mx-auto bg-white rounded-lg mt-20 border" >
                <div class="flex items-center " >
        <div class="w-full">
            <input type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none " placeholder="ابحث عن ..." id="search" autocomplete="off" dir="rtl">
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
        <div class="flex md:space-x-10 ">
            <div class="w-1/4 details-hide">
                <div class=" mt-20 rounded shadow p-4 h-1/4" dir="rtl">
                    <h1 class="font-semibold text-xl md:text-3xl mb-2">أداء البائع </h1>
                    <hr>
                    <div class="mb-3 mt-3 text-xl">
                        <span class="text-yellow-400">✓</span>
                        معدل سرعه توصيل الطلب: ممتاز
                    </div>
                    <div class="mb-3  text-xl">
                        <span class="text-yellow-400">✓</span>
                        تقييم الجودة: جيد
                    </div>
                    <div class=" text-xl">
                        <span class="text-yellow-400">✓</span>
                        تقييم العملاء: متوسط
                    </div>
                </div>
                <h1 class="font-semibold text-xl md:text-3xl mt-5 mb-2" dir="rtl">قد يعجبك ايضا</h1>
                <div class="grid gap-3">
                    
                        <?php 
                            $query="SELECT * FROM produit WHERE ID_category=$category AND name_product NOT IN ('$titre')  LIMIT 2";
                            $result=mysqli_query($conx,$query);
                            if($result){
                                if(mysqli_num_rows($result) !=0 ){
                                while($row=mysqli_fetch_array($result)){
                                    $titre_=preg_replace('/[^\p{L}\p{N}\s\']/u',' ',$row['name_product']);
                                    $titre_=str_replace(' ','-',$titre_);

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
                    <a href="detail?titre=<?php echo $titre_;?>">
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
                   
                </div>
            </div>
            <div class="pt-10  md:mt-20 md:shadow md:w-3/4" dir="rtl">
            <?php
                $query="SELECT * FROM produit WHERE name_product='$titre' LIMIT 1";
                $result=mysqli_query($conx,$query);
                if($result){
                    if(mysqli_num_rows($result) !=0 ){
                        while($row=mysqli_fetch_array($result)){
                            ?>
                            <div class="container mx-auto px-4">
                                <div class="flex flex-wrap -mx-4 mb-24">
                                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                                        <?php 
                                            $image=$row['images'];
                                            $image=explode(' ',$image);
                                            $count=count($image)-1;
                                        ?>
                                        <div class="h-60 md:h-96 md:mb-10 flex items-center justify-center">
                                            <?php 
                                                for($i=0;$i<1;$i++){
                                                    echo "<img src='Admin/avatar/".$image[$i]."' class='w-auto h-full object-contain' alt='".$row['name_product']."' id='pic1'>";
                                                }
                                            ?>
                                        </div>
                                        <div class="flex  justify-center -mx-2">
                                            <?php 
                                                for($i=0;$i<$count;$i++){
                                                    echo "<div class='h-24 w-24 md:h-32 md:w-32 p-2 border hover:border-yellow-400'>
                                                            <img src='Admin/avatar/".$image[$i]."' class='w-auto h-full object-contain' alt='".$row['name_product']."' onclick='changeIt(this.src)' onmouseover='changeIt(this.src)'>
                                                         </div>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2 px-4">
                                        <div class="lg:pl-20">
                                            <div class="mb-10 pb-10 border-b">
                                                <span class="text-gray-500">Amaniy</span>
                                                <h2 class="mt-2 mb-6 max-w-xl text-3xl md:text-4xl font-bold font-heading"><?php echo $row['name_product'];?></h2>
                                                <div class="inline-block mb-8 text-2xl font-bold font-heading flex justify-between">
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
                                                                    <span class="font-normal text-base text-gray-400 line-through"> <?php echo $row['price'];?>د.م</span>
                                                            <?php  }else{ ?>
                                                                    <span><?php echo $row['price']?>د.م </span>
                                                            <?php }
                                                            ?>
                                                    </div>
                                                        <?php 
                                                            if($row['promotion'] > 0){
                                                                echo "<span class='text-white bg-red-600 p-1'>".$row['promotion']."%</span>";
                                                            }
                                                        ?>
                                                </div>

                                                <p class="max-w-md text-gray-500"><?php echo $row["description"];?></p>
                                            </div>
                                            <div class="w-full px-4 mb-4 xl:mb-0">
                                                <form action="index" method="POST" class="form-submit">
                                                <input type="hidden" class="id_p" name="id_p" value="<?php echo $row['ID_produit'];?>">
                                                <input type="hidden" class="name_p" value="<?php echo $row['name_product'];?>">
                                                <input type="hidden" class="price_p" value="<?php echo $res?>">
                                                <input type="hidden" class="price_p" value="<?php echo $row['price'];?>">
                                                <input type="hidden" class="image_p" value="<?php echo $image[0];?>">
                                                <div class="w-full bg-yellow-400 text-center h-full p-4 rounded text-white flex items-center">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
</svg>
                                                      <a href="cart" class="addItemBtn bg-yellow-400  p-2 text-white w-full h-full">
                                                        إضافة لسلة التسوق
                                                    </a>

                                                </div>
                                              
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                       <?php }
                    }else{
                        echo "<p>جاري المعالجة ...</p>";
                        //echo mysqli_error($conx);
                    }
                }
                ?>
            </div>
        </div>


        <h1 class="font-semibold text-2xl md:text-4xl mt-20" dir="rtl">شاهد العملاء أيضًا</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 w-full mt-10 gap-3" dir="rtl">
                    <!-- componenet -->
                    <?php 
                        $query_product="SELECT * from produit LIMIT 4";
                        $result_product=mysqli_query($conx,$query_product);
                        if($result_product){
                            if(mysqli_num_rows($result_product) != 0){
                                while($row=mysqli_fetch_array($result_product)){ 
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
                        }else{
                            
                        }
                    ?>

                    <!-- end componenet -->
                </div>
    </div>
    <!-- end main page -->
<?php 
    include "Includes/footer.php";
?>