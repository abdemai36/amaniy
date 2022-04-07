<?php 
    include "Includes/Navbar.php";
    if(!isset($_SESSION['userType']) && $_SESSION["userType"]!="ADM" || !isset($_SESSION['userType']) && $_SESSION["userType"]!="USR"){
        header("location:login");
        exit();
    }
    if(isset($_POST["code_livreur"])){
        $code_livreur=$_POST["code_livreur"];
    }else{
        $code_livreur="";
    }
?>
    <!-- main page -->
    <div class="container m-auto px-2 mb-20">
        
        <div class="container m-auto mb-20 px-2 ">
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

        <div class="flex md:space-x-10 mt-28 mb-32">
            <div class="w-1/4  details-hide">
                <div class=" rounded shadow  " dir="rtl">
                    <h1 class="font-semibold text-2xl md:text-4xl p-2">المنتجات </h1>
                    <hr>
                    <?php
                        $G_total=0;
                        $user_id=$_SESSION["iduser"];
                        $query="SELECT * FROM cart WHERE ID_user=$user_id AND visibility=1";
                        $result=mysqli_query($conx,$query);
                        if($result){
                            while($row=mysqli_fetch_array($result)){
                                $G_total+=$row["total_price"];
                                ?>
                                    <div class="overflow-x-auto">
                                        <div class="flex p-1 border-b">
                                                <img src='Admin/avatar/<?php echo trim($row["image_product"]);?>' class='w-20 rounded ml-3' alt='Thumbnail'>
                                            <div>
                                                <h1><?php echo $row["name_product"];?></h1>
                                                <div>
                                                    <span>
                                                        <span>
                                                            <?php echo number_format($row["price_product"],2);?> د.م  
                                                        </span> 
                                                    </span>
                                                </div>
                                                <div>
                                                الكمية : 
                                                    <span>
                                                        <?php echo $row["qnt"];?> 
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                        }
                    ?>
                    
                                        
                    <div class="flex justify-between border-t p-3">
                        <span class="text-xl">المبلغ الإجمالي</span>
                        <span class="text-yellow-400 text-xl"> <?php echo number_format( $G_total,2);?> د.م  </span>
                    </div>
                </div>
            </div>
            <div class="pt-10   md:shadow md:w-3/4 p-5" dir="rtl">
                <div class="container mx-auto px-4">
                    <h1 class="font-semibold text-xl md:text-3xl mb-4">ضع الطلب</h1>
                    
                        <?php
                            if(isset($_GET["form"]))
                            {
                                if($_GET["form"]=="empty")
                                {?>
                                        <div class="bg-red-100 border-red-500 text-red-700 p-4" role="alert">
                                            <p class="font-bold"></p>
                                            <p>الرجاء إدخال كافة المعلومات</p>
                                        </div>
                                <?php }
                            }
                            if(isset($_GET["form"]))
                            {
                                if($_GET["form"]=="name")
                                {?>
                                        <div class="bg-red-100 border-red-500 text-red-700 p-4" role="alert">
                                            <p class="font-bold"></p>
                                            <p>اسمك غير صالح</p>
                                        </div>
                                <?php }
                            }
                            if(isset($_GET["form"]))
                            {
                                if($_GET["form"]=="message")
                                {?>
                                        <div class="bg-red-100 border-red-500 text-red-700 p-4" role="alert">
                                            <p class="font-bold">خطأ</p>
                                            <p>رسالتك غير صالحة</p>
                                        </div>
                                <?php }
                            }
                            if(isset($_GET["form"]))
                            {
                                if($_GET["form"]=="error")
                                {?>
                                        <div class="bg-red-100 border-red-500 text-red-700 p-4" role="alert">
                                            <p class="font-bold">خطأ</p>
                                            <p>فشل الطلب المرج اعادة المحاولة</p>
                                        </div>
                                <?php }
                            }
                            if(isset($_GET["form"]))
                            {
                                if($_GET["form"]=="success")
                                {?>
                                        <div class="bg-green-100 border-green-500 text-green-900 p-4" role="alert">
                                            <p class="font-bold"></p>
                                            <p>تم الطلب بنجاح</p>
                                        </div>
                                <?php }
                            }
                        ?>
                    <form action="send-commande" method="POST" class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label for=""> الإسم الشخصي العائلي :</label>
                            <input type="hidden" name="code_livreur" value="<?php echo $code_livreur ;?>">
                            <input type="hidden" name="email" value="<?php echo $_SESSION["email"] ;?>">
                            <input type="text" name="name" readonly value="<?php echo $_SESSION["username"] ;?>" class="border-2 rounded bg-gray-200 focus:outline-none p-2 focus:border-yellow-400">
                        </div>
                        <div class="flex flex-col">
                            <label for=""> رقم الهاتف النقال :</label>
                            <input type="number" name="phone" readonly min="0" value="<?php echo $_SESSION["phone"] ;?>" class="border-2 bg-gray-200 rounded focus:outline-none p-2 focus:border-yellow-400">
                        </div>
                        <div class="flex flex-col">
                            <label for=""> مدينة :</label>
                            <input type="text" name="ville" readonly value="<?php echo $_SESSION["addresse"] ;?>" class="border-2 bg-gray-200 rounded focus:outline-none p-2 focus:border-yellow-400">
                        </div>
                        <div class="flex flex-col">
                            <label for=""> العنوان :</label>
                            <input type="text" name="addresse" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                        </div>
                        <div>
                            <button type="submit" name="submit" class="bg-yellow-400 shadow-lg text-white p-3 w-44">اشتري الآن</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main page -->
<?php 
    include "Includes/footer.php";
?>       