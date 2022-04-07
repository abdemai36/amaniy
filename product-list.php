<?php 
    include "Includes/Navbar.php";

    if(!isset($_GET['page']) || empty($_GET["page"])){
        header("location:product-list?page=1");
        exit();
    }else{

        if(is_numeric($_GET['page'])){
            $page=intval($_GET['page']);
        }else{
            $page=1;
        }
    }

    $nbr_product_par_page=30;
    $nbr_product_max_avant_apre=30;

    $query="SELECT * FROM produit";
    $result_pagination=mysqli_query($conx,$query);
    $nbr_total_product=mysqli_num_rows($result_pagination);

    $last_page=ceil($nbr_total_product/$nbr_product_par_page);
    $Limit='LIMIT '.($page-1)*$nbr_product_par_page.','.$nbr_product_par_page;

    $query="SELECT * FROM produit WHERE etat='Active' ORDER BY ID_produit DESC $Limit";
    $result_pagination=mysqli_query($conx,$query);

    $pagination='';
    if($last_page!=1){
        if($page>1){
            $previous=$page-1;
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product-list?page='.$previous.'">
                <<
            </a>';
            for($i=$page-$nbr_product_max_avant_apre;$i<$page;$i++){
                if($i>0){
                    $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product-list?page='.$i.'">'.$i.'</a>';
                }
            }

        }
        $pagination .='<span class="bg-yellow-400 border-gray-300 text-white cursor-default relative inline-flex items-center px-4 py-2 border text-sm font-medium">'.$page.'</span>';
        for($i=$page+1;$i<=$last_page;$i++){
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product-list?page='.$i.'">'.$i.'</a>';
            if($i>=$page+$nbr_product_max_avant_apre){
                break;
            }
        }
        if($page!=$last_page){
            $next=$page+1;
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product-list?page='.$next.'">
               >>
            </a>';
        }
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

        <div class="flex flex-col md:flex-row mt-20 " dir="rtl">
            <div class="w-1/5 details-hide">
                <div class="p-5 border-2 rounded-lg flex flex-col">
                    <h1 class="font-semibold mb-2 text-xl mb-5">الفئات</h1>
                    <?php
                        $query="SELECT * FROM category";
                        $result=mysqli_query($conx,$query);
                        if($result){
                            if(mysqli_num_rows($result) !=0 ){
                                while($row=mysqli_fetch_array($result)){
                                    ?>
                                        <label for="">
                                            <input name="selector[]" class="category" type="checkbox" value="<?php echo $row["ID_category"];?>"><?php echo $row["name"];?>
                                        </label>
                                <?php }
                            }else{
                                echo "<p>جاري المعالجة ...</p>";
                            }
                        }
                    ?>
                </div>
                <div class=" w-full p-5 border-2 rounded-lg mt-5">
                    <h1 class="font-semibold mb-2 text-xl mb-5">الاثمنة</h1>
                    <div class="w-full" dir="rtl">
                        <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                        <div class="flex" style="margin:30px auto" dir="ltr">
                            <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field w-16" />
                            <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field w-20" />
                        </div>                    
                    </div>
                    <hr class="my-4">
                </div>
                <div class=" mt-5">
                    <?php
                        $query_ads="SELECT * FROM ads WHERE position_ads=1 AND `page`='liste produit' AND DATE(NOW()) between `date_debut` and `date_fin` ORDER BY ID_ads DESC LIMIT 1"; 
                        $result_ads=mysqli_query($conx,$query_ads);
                        if($result_ads){
                            while($row=mysqli_fetch_array($result_ads)){ ?>
                                <a href="<?php echo $row["url_ads"]?>"><div class="my-16 h-52 md:h-80  bg-no-repeat bg-cover rounded-lg"style="background-image: url('Admin/avatar/<?php echo $row["image_ads"];?>');">
                                </div></a>
                            <?php }
                        }
                    ?> 
                    
                </div>
            </div>
                <div class="md:w-4/5 md:mr-10">
                    <h1 class="text-4xl font-semibold mb-3"> المنتجات</h1>
                    <hr>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-5 searchresult">
                        <div id="loading" class="hidden">
                            <div style="border-top-color:transparent;" class="w-16 h-16 border-4 border-yellow-400 border-solid rounded-full animate-spin"></div>
                        </div>
                    <?php
                    if($result_pagination){
                        if(mysqli_num_rows($result_pagination) != 0){
                            while($row=mysqli_fetch_array($result_pagination)){ 
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
                        }
                    }
                    
                    ?>  
                                      
                </div>
                <div class="mt-10 w-full flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <?php
                    if(!isset($_GET["page"]) || $_GET['page']>$last_page || $_GET['page']==0)
                    {
                        echo "<div class='bg-yellow-400 p-4  text-xl rounded'>لايوجد اي منتج حاليا</div>";
                
                    }else{
                        ?>
                            <div class="pagina">
                                <div>
                                    <?php echo $pagination;?>
                                </div>
                            </div>
                    <?php }
                    
                    ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- end main page -->
<?php 
    include "Includes/footer.php";
?>      