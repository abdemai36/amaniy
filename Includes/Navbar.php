<?php
    session_start();
    ob_start();
    include "Admin/Includes/db.inc.php";
    $query_category="SELECT * from category LIMIT 4";
    $result_cotegory=mysqli_query($conx,$query_category);
    $data_category=array();
    if($result_cotegory){
        if(mysqli_num_rows($result_cotegory) != 0){
            while($row=mysqli_fetch_array($result_cotegory)){ 
                $data_category[]=$row;
            }
        }else{
            echo "<p>En coure ...</p>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="this is the SEO meta descriptoin blurb that describes what the page is about"/>
    <link href="css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles2.css">
    <link rel="icon" href="images/logo 5.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<meta name="description" content="مع اماني فتجارتك عيش هاني و <br>اصبح بائع على اماني"/>
    <title>Amaniy</title>
</head>
<body>
    
    
   

    <!-- topbar -->
    <div class="fixed top-0 z-20" >
        <header class="flex justify-between items-center">
            <button class="flex items-center" id="open-menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="index">
                <img src="images/logo2.png" alt="" class="h-7">
            </a>
            <div class="flex space-x-5 items-center">
                <a href="cart" class="relative inline-block">
                    <span id="cart-item" class='absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full'></span>                              
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg> 
                </a>
                <div class="relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm">
                        <button class="inline-flex justify-center w-full text-sm font-medium leading-5 text-black transition duration-150 ease-in-out  rounded-md  focus:outline-none "
                            type="button" aria-haspopup="true" aria-expanded="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>
                    </span>
                    <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95 z-50">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <?php
                                    if(isset($_SESSION["userType"]) && $_SESSION["userType"]=="ADM"){
                                        echo "<a href='Admin/Dashboard' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'>لوحة التحكم</a>";
                                        echo "<a href='Admin/Includes/LogOut' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'> تسجيل الخروج</a>";
                                    }elseif(isset($_SESSION["userType"]) && $_SESSION["userType"]=="USR"){
                                        echo "<a href='Admin/Includes/LogOut' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'> تسجيل الخروج</a>";
                                    }elseif(isset($_SESSION["type_user"]) && $_SESSION["type_user"]=="STR"){
                                        echo "<a href='store/dashboard_store' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'>لوحة التحكم</a>";
                                        echo "<a href='store/LogOut' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'> تسجيل الخروج</a>";
                                    }else{       
                                        echo "<a href='login' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'>تسجيل الدخول</a>";
                                        echo "<a href='signup' tabindex='0' class='text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left' role='menuitem'>التسجيل</a>";
                                    }
                                ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="body-overlay"></div>
        <nav class="real-menu z-50" role="navigation" dir="rtl">
            <ul class="mt-32 text-semibold text-xl">
                <li class="mb-4 ">
                    <a href="product-list?page=1" class="flex"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>المتجر
                    </a>
                </li>
                <?php
                    if(!isset($_SESSION["idstore"]) && !isset($_SESSION["type_user"]))
                    {
                    echo '<li class="mb-4"><a href="store/create-store" class="flex"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>انشاء متجر</a></li>';
                    echo '<li class="mb-4"><a href="store/login" class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
</svg>سجل الدخول الى متجرك</a></li>';
                    }else{
                    echo '<li class="mb-4"><a href="store/dashboard_store">لوحة التحكم</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
    <!-- end topbar -->