<?php 
    include "Includes/Navbar.php";
    
?>
    <!-- main page -->
    <div >
        <div class="container m-auto px-2 mb-20">
            <h1 class="font-semibold text-2xl md:text-4xl mt-20 md:mt-32" dir="rtl">عربة التسوق</h1>
            <div class=" m-auto  mt-5">
                
                <form action="validez-comande" method="POST">
                    <div class="flex justify-center my-6">
                        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow pin-r pin-y w-3/4 m-auto">
                            <div class="flex-1">
                                <table class="w-full text-sm lg:text-base" dir="rtl" cellspacing="0">
                                    <thead>
                                        <tr class="h-12 uppercase">
                                            <th class="text-center">منتج</th>
                                            <th class="text-right"></th>
                                            <th class="text-right ">الكمية </th>
                                            <th class="hidden  md:table-cell"></th>
                                            <th class="text-right">السعر</th>
                                            <th class="text-right">المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_cart">
                                        <?php
                                            
                                            if(isset($_SESSION["iduser"])){
                                                $total_price=0; 
                                                $user_id=$_SESSION["iduser"];

                                                $query_select_product_cart="SELECT * FROM cart WHERE ID_user=$user_id AND visibility=1";
                                                $result_select_product_cart=mysqli_query($conx,$query_select_product_cart);
                                                if($result_select_product_cart){
                                                    if(mysqli_num_rows($result_select_product_cart) != 0){
                                                        while($row=mysqli_fetch_array($result_select_product_cart)){ 
    
                                                            //total price
                                                            $total_price += $row["total_price"];
                                                            $id_cart=$row["ID_cart"];
                                                            ?>
                                                            <tr class="border-b-2 border-yellow-200">
                                                                    <td class=" pb-4 md:table-cell">
                                                                        <img class="h-32" src="Admin/avatar/<?php echo trim($row['image_product']);?>" alt="<?php echo $row["image_product"];?>">
                                                                        <input type="hidden" class="pid" value="<?php echo $row['ID_produit'];?>">
                                                                        <input type="hidden" class="pprice" value="<?php echo $row['price_product'];?>">
                                                                    </td>
                                                                    <td>
                                                                        <p class="mb-2 font-semibold md:text-lg"><?php echo $row["name_product"];?></p>
                                                                        <a href="action?remove=<?php echo $row['ID_cart'];?>" class="cursor-pointer md:ml-4 flex text-red-400" id="btn-delete-prod">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    stroke-width="1.5"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                            <small class="">حذف منتج</small>
                                                                        </a>
                                                                    <td>
                                                                        <div class="w-20 h-10">
                                                                            <div class="relative flex flex-row w-full h-8">
                                                                                <input type="number" value="<?php echo $row['qnt'];?>" min="1" class="iQuetity w-1/2 md:w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="hidden text-right md:table-cell">
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <span class="text-sm lg:text-base font-medium">   
                                                                            <?php echo number_format($row["price_product"],2);?>د.م                                         
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <span class="itotal text-sm lg:text-base font-medium">   
                                                                            <span> 
                                                                                <?php echo number_format($row["total_price"],2);?>د.م  
                                                                            </span>
                                                                        </span> 
                                                                    </td>
                                                                </tr> 
    
                                                        <?php }
                                                    }else{
                                                        echo "
                                                            <div class='w-full flex flex-col space-y-5 justify-center items-center'>
                                                                <div class='rounded-full bg-yellow-400 p-10'>    
                                                                    <svg xmlns='http://www.w3.org/2000/svg' class='h-20 w-20' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='1'
                                                                        d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'/>
                                                                    </svg>
                                                                </div>
                                                            <span>سلتك فارغة !</span>
                                                            <a href='index' class='bg-white shadow-lg text-yellow-400 p-3 w-44 text-center'>الاستمرار
                                                            بالتسوق</a>
                                                            </div>
                                                        ";
                                                    }
                                                }
                                            }elseif(isset($_SESSION["cart"])){
                                                $total_price_session=0;
                                                $product_id=array_column($_SESSION["cart"],"product_id");
                                                $query_select_product_cart="SELECT * FROM produit";
                                                $result_select_product_cart=mysqli_query($conx,$query_select_product_cart);
                                                if($result_select_product_cart){
                                                    if(mysqli_num_rows($result_select_product_cart) != 0){
                                                        while($row=mysqli_fetch_array($result_select_product_cart)){ 

                                                            foreach($product_id as $id){
                                                                if($row["ID_produit"]==$id){
                                                                    $image=$row['images'];
                                                                    $image=explode(' ',$image);
                                                                    $count=count($image)-1;
                                                                    for($i=0;$i<1;$i++){
                                                                        $loop_image_one=$image[$i];
                                                                    }                                                                        
                                                                    ?>
                                                                    <tr class="border-b-2 border-yellow-200">
                                                                        <td class=" pb-4 md:table-cell">
                                                                            <img class="h-20 md:h-32" src="Admin/avatar/<?php echo $loop_image_one;?>" alt="<?php echo $row["name_product"];?>">
                                                                        </td>
                                                                        <td>
                                                                            <p class="mb-2 font-semibold md:text-lg"><?php echo $row["name_product"];?></p>
                                                                            <a href="action?remove=<?php echo $row['ID_produit'];?>" class="cursor-pointer md:ml-4 flex text-red-400" id="btn-delete-prod">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                                        stroke-width="1.5"
                                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                                </svg>
                                                                                <small class="">حذف منتج</small>
                                                                            </a>
                                                                        <td>
                                                                            <div class="w-20 h-10">
                                                                                <div class="relative flex flex-row w-full h-8">
                                                                                    <input type="number"  onchange="subtotal();" value="1" min="1" class="qntity w-1/2 md:w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="hidden text-right md:table-cell">
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <span class="text-sm lg:text-base font-medium">   
                                                                                <?php
                                                                                    if($row['promotion'] > 0){?>
                                                                                        <span class="text-red-500">
                                                                                            <?php 
                                                                                            $price = $row['price'];
                                                                                            $promotion = $row['promotion'];
                                                                                            $res = "";
                                                                                                $res=$price-($price*$promotion)/100;
                                                                                                echo number_format($res,2);
                                                                                                $total_price_session+=$res;
                                                                                            ?>د.م
                                                                                        </span>
                                                                                        <span class="line-through"> <?php echo number_format($row['price'],2);?> د.م</span>
                                                                                        <input type="hidden" class="iprice" value="<?php echo number_format($res,2); ?>">

                                                                                <?php  }else{
                                                                                        $total_price_session+=$row['price'];
                                                                                    ?>
                                                                                        <input type="hidden" class="iprice" value="<?php echo number_format($row['price'],2) ?>">
                                                                                        <span><?php echo number_format($row['price'],2) ?>د.م </span>
                                                                                <?php }
                                                                                ?>                                             
                                                                            </span>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <span class="itotal text-sm lg:text-base font-medium">   
                                                                                <span> 
                                                                                      
                                                                                </span>
                                                                            </span> 
                                                                        </td>
                                                                    </tr> 

                                                                <?php }
                                                            }
                                                            
                                                            ?>
                                                        <?php }
                                                    }else{
                                                        echo "
                                                            <div class='w-full flex flex-col space-y-5 justify-center items-center'>
                                                                <div class='rounded-full bg-yellow-400 p-10'>    
                                                                    <svg xmlns='http://www.w3.org/2000/svg' class='h-20 w-20' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='1'
                                                                        d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'/>
                                                                    </svg>
                                                                </div>
                                                            <span>سلتك فارغة !</span>
                                                            <a href='index' class='bg-white shadow-lg text-yellow-400 p-3 w-44 text-center'>الاستمرار
                                                            بالتسوق</a>
                                                            </div>
                                                        ";
                                                    }
                                                }
                                            }else{

                                                echo "
                                                        <div class='w-full flex flex-col space-y-5 justify-center items-center'>
                                                            <div class='rounded-full bg-yellow-400 p-10'>    
                                                                <svg xmlns='http://www.w3.org/2000/svg' class='h-20 w-20' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='1'
                                                                    d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'/>
                                                                </svg>
                                                            </div>
                                                        <span>سلتك فارغة !</span>
                                                        <a href='index' class='bg-white shadow-lg text-yellow-400 p-3 w-44 text-center'>الاستمرار
                                                        بالتسوق</a>
                                                        </div>
                                                    ";
                                            }
                                            
                                        ?>           
                                    </tbody>
                                </table>
                                <div class="my-4 md:mt-6 -mx-2 lg:flex w-full">
                                    <div class="lg:px-2 w-full lg:w-2/4 float-left">
                                        <div class="p-4">
                                            <div class="flex justify-between pt-4 border-b" dir="rtl">
                                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                                    المبلغ الإجمالي
                                                </div>
                                                <div class="total lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                                    <span id="Gtotal" >
                                                        <?php 
                                                            if(isset($_SESSION["iduser"]))
                                                            {
                                                                echo number_format($total_price,2);
                                                                
                                                            }elseif(isset($_SESSION["cart"])){
                                                                echo number_format($total_price_session,2);
                                                                echo '<input  type="hidden" id="input_Gtotal" value="">';
                                                            }else{
                                                                echo "0";
                                                            }                                                            
                                                        ?>د.م
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                            <div class="rounded shadow mt-10 p-2" dir="rtl">
                                                <button
                                                    class="details-hide bg-green-400 text-white p-2 rounded">أدخل
                                                    رمز
                                                    التوصيل(إختياري)</button>
                                                <input class="border-none focus:outline-none p-3" type="text" name="code_livreur"
                                                    placeholder="رمز التوصيل">
                                            </div>
                                            <div class="flex space-x-10 mt-5">
                                                <?php
                                                    if(isset($_SESSION['userType']) && $_SESSION["userType"]=="ADM" || isset($_SESSION['userType']) && $_SESSION["userType"]=="USR"){
                                                        if($total_price>1){
                                                            $id=$_SESSION['iduser'];
                                                            $query_update_tbCard="UPDATE cart SET ID_user=$id WHERE ID_cart=$id_cart";
                                                            $result_update=mysqli_query($conx,$query_update_tbCard);
                                                            echo '<button type="submit"  name="send_comande" class="text-center bg-yellow-400 shadow-lg text-white p-3 w-44">اشتري الآن</button>';
                                                        }else{
                                                            echo '<button type="submit" disabled name="send_comande" class="text-center bg-yellow-400 shadow-lg text-white p-3 w-44">اشتري الآن</button>';
                                                        }
                                                    }elseif(isset($_SESSION['cart'])){
                                                        if($total_price_session>1){
                                                            echo '<a href="login" class="text-center bg-yellow-400 shadow-lg text-white p-3 w-44">اشتري الآن</>';
                                                        }else{
                                                            echo '<a href="login" disabled class="text-center bg-yellow-400 shadow-lg text-white p-3 w-44">اشتري الآن</>';
                                                        }
                                                    }
                                                ?>
                                                <a  href="product-list" class="text-center shadow-lg text-black p-3 w-44">الاستمرار بالتسوق</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
        </div>
        <!-- end main page -->
<?php 
    include "Includes/footer.php";
?>