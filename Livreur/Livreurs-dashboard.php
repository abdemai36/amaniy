<?php
    session_start();
    include_once("../Admin/Includes/db.inc.php");
    $id_livreur=$_SESSION["idLivreur"];
    $query_livreur="select * from livreurs WHERE ID_livreur=$id_livreur LIMIT 1";
    $result_livreur=mysqli_query($conx,$query_livreur);
    if($result_livreur){
        if(mysqli_num_rows($result_livreur) !=0){
            while($row=mysqli_fetch_array($result_livreur)){
                $code_livreur=$row["code_livreur"];
            }
        }else{
            header("location:login");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <title><?php echo $_SESSION["username"];?></title>
</head>

<body>


    <!-- topbar -->
    <div class="fixed top-0 z-50 ">

        <header class="flex justify-between">
            <button class="flex items-center" id="open-menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <img src="../images/logo2.png" alt="" class="h-7">
                <div class="relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm">
                        <button
                            class="inline-flex justify-center w-full text-sm font-medium leading-5 text-black transition duration-150 ease-in-out  rounded-md  focus:outline-none "
                            type="button" aria-haspopup="true" aria-expanded="true">
                            <img src="../images/John-Doe.png" alt="">
                        </button>
                    </span>
                    <div
                        class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95 z-50">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href='../Admin/Includes/LogOut' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'> تسجيل الخروج</a>
                            </div>
                        </div>
                    </div>
                </div>
        </header>
    </div>
    <!-- end topbar -->

    <!-- main page -->

    <div class="container m-auto px-2 mb-20 mt-20">
        <div class="bg-yellow-400 text-white text-center w-full p-4  rounded-md text-4xl">
            داشبورد
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-10">
            <div dir="rtl">
                <h1 class="text-2xl font-semibold mb-3">طلبات غير مباشرة</h1>
                <a href="orders_indirect">
                    <div class="bg-yellow-400 text-white rounded p-4">
                        <div class="flex justify-between">
                            <h1>عدد الطلبات</h1>
                            <span>
                                <?php 
                                        $query="SELECT count(*) FROM tb_order where code_livreur='$code_livreur' AND direction=1";
                                        $result=mysqli_query($conx,$query);
                                        if($result)
                                        {
                                            while($row=mysqli_fetch_array($result)){
                                                echo number_format($row[0]);
                                            }
                                        }                            
                                    ?>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <h1>قيمة الطلبات </h1>
                            <span>
                                <?php
                                    $query="SELECT sum(global_price) FROM tb_order WHERE code_livreur='$code_livreur' AND direction=1";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?> DH
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div dir="rtl">
                <h1 class="text-2xl font-semibold mb-3">طلبات مباشرة</h1>
                <a href="orders">
                    <div class="bg-yellow-400 text-white rounded p-4">
                        <div class="flex justify-between">
                            <h1>عدد الطلبات</h1>
                            <span>
                                <?php 
                                    $query="SELECT count(*) FROM tb_order where code_livreur='$code_livreur' AND direction=0";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }                            
                                ?>
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <h1>قيمة الطلبات </h1>
                            <span>  
                                <?php
                                    $query="SELECT sum(global_price) FROM tb_order WHERE code_livreur='$code_livreur' AND direction=0";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?> DH
                                
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>



    <!-- end main page -->


    <footer class="bg-yellow-400 md:fixed md:bottom-0 w-full" dir="rtl">
        <div class="text-white text-center text-white p-3 bg-black">
            © All rights reserved to Amaniy 2022.
        </div>
    </footer>




    <script src="../js/globale.js"></script>
</body>

</html>