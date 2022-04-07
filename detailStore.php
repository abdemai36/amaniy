<?php
      include "Includes/Navbar.php";
      if(!isset($_GET['page']) || empty($_GET["page"])){
        header("index");
        exit();
    }else{

        if(is_numeric($_GET['page'])){
            $page=intval($_GET['page']);
        }else{
            $page=1;
        }
    }
    if(isset($_GET["store"]) && !empty($_GET["store"])){
        $name_store=str_replace("-"," ",$_GET["store"]);
        $id_owner_store = $_GET["id"];
    }else{
        header("location:index");
        exit();
    }

    $queryselect_store="SELECT * FROM owner_store where name_store='".$name_store."' limit 1";
    $resultselect_store=mysqli_query($conx,$queryselect_store);

    $nbr_product_par_page=30;
    $nbr_product_max_avant_apre=30;

    $query="SELECT * FROM produit WHERE ID_user='$id_owner_store'";
    $result_pagination=mysqli_query($conx,$query);
    $nbr_total_product=mysqli_num_rows($result_pagination);

    $last_page=ceil($nbr_total_product/$nbr_product_par_page);
    $Limit='LIMIT '.($page-1)*$nbr_product_par_page.','.$nbr_product_par_page;

    $query="SELECT * FROM produit WHERE ID_user=$id_owner_store ORDER BY ID_produit DESC $Limit";
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
  <div class="flex flex-col w-full mx-auto bg-white rounded-lg mt-20 border container m-auto" >
                <div class="flex items-center " >
        <div class="w-full">
            <input type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none " placeholder="ابحث في هذا المتجر ..." id="searchStoreDetails" autocomplete="off" dir="rtl">
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
    <div id="displayStoreDetails" class="w-full "></div>
    </div>
    
    <div class="flex flex-col justify-center items-center mt-24">
        <?php
            if($resultselect_store){
                while($row=mysqli_fetch_array($resultselect_store)){ ?>
                    <img src="Admin/avatar/<?php echo $row["image"]?>" class="h-32 w-32 rounded-full mb-5" alt="<?php  echo $name_store;?>">
                    <h1 class="text-center text-4xl font-semibold"><?php  echo $name_store;?></h1>
                <?php }
            }
        ?>
     
    </div>


    <div class="flex flex-col md:flex-row mt-20 container m-auto" dir="rtl">
            
                <div class="md:w-full mb-32">
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
                        echo "<div class='bg-yellow-400 p-4  text-xl rounded''>لا يوجد اي منتج في هذا المتجر .</div>";
                
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

<?php 
    include "Includes/footer.php";
?>   