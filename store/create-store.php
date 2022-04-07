<?php
    session_start();
    ob_start();
    include "../Admin/Includes/db.inc.php";
    if(isset($_SESSION["idstore"]) && isset($_SESSION["type_user"]))
    {
       header("location:dashboard_store");
       exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic&display=swap" rel="stylesheet">

    <title>créer store - Amaniy</title>
</head>
<body>
    <!-- topbar -->
    <div class="fixed top-0 z-20">
        <header class="flex justify-between">
            
            <a href="../index">
                <img src="../images/logo2.png" alt="" class="h-7">
            </a>
            <div class="flex space-x-5 items-center">
               
                <div class="relative inline-block text-left dropdown">
                    <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95 z-50">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            id="headlessui-menu-items-117" role="menu">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="body-overlay"></div>
        <nav class="real-menu z-50" role="navigation" dir="rtl">
            <ul class="mt-32">
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="product-list?page=1">المتجر</a></li>
                <li><a href="store/create-store">انشاء متجر</a></li>
            </ul>
        </nav>
    </div>
    <!-- end topbar -->
<div class="container m-auto mb-20 px-2 flex items-center justify-center mt-24 md:mt-32" dir="rtl">

<form action="" id="Form_store" class="flex flex-col space-y-5 w-full md:w-2/4" enctype="multipart/form-data">
    <h1 class="text-4xl fnt-semibold text-center">إنشاء متجرك</h1>
    <div class="flex flex-col">
        <label for="username">الاسم الكامل :</label>
        <input type="text" id="username" name="username" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400"  >
        <span class="text-red-500" id="check-username"></span>
    </div>
    <div class="flex flex-col">
        <label for="email">بريد الالكتروني :</label>
        <input type="email" id="email" name="email" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400"  >
        <span class="text-red-500" id="check-email"></span>
    </div>
    <div class="flex flex-col">
        <label for="">كلمة المرور :</label>
        <input type="password" id="pwd" name="pwd" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400"  >
        <span class="text-red-500" id="check-pwd"></span>
    </div>
    <div class="flex flex-col">
        <label for="">تأكيد كلمة المرور :</label>
        <input type="password" id="repeat-pwd" name="repeat_pwd" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400"  >
        <span  id="check-repeat-pwd"></span>
    </div>
    <div class="flex flex-col">
        <label for="">هاتف :</label>
        <div class="flex">
            <input type="number" id="phone" name="phone" placeholder="مثال: 600000000" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400 w-4/5" >
            <input type="text" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400 text-center w-1/5 mr-2" disabled value="+212">
        </div>
        <span class="text-red-500" id="check-phone"> </span>
    </div>
    <div class="flex flex-col">
        <label for="">اسم المتجر :</label>
        <input type="text" id="name-store" name="name_store" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" >
        <span class="text-red-500" id="check-store"></span>
    </div>
    <div class="flex flex-col">
        <label for="">وصف :</label>
        <textarea id="description" name="description" cols="30" rows="10" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" ></textarea>
        <span class="text-red-500" id="check-description"></span>
    </div>
    <div class="flex justify-center mt-8 ">
        <div class="w-full rounded-lg shadow-lg ">
            <div class="m-4">
                <label class="inline-block mb-2 text-gray-500">تحميل صورة</label>
                <div class="flex flex-col items-center justify-center w-full">
                    <label
                        class="flex flex-col w-full h-32 border-4 border-yellow-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                        <div class="flex flex-col items-center justify-center pt-7">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">إرفاق
                                صورة</p>
                        </div>
                        <input type="file" name="image_store[]" id="image_store" class="opacity-0 file-input"/>
                    </label>
                    <p class="fileName mt-3"></p>
                </div>
                <ul class="text-red-500" id="check-message"></ul>
            </div>

        </div>
    </div>
    <a href="login" class="text-center bg-green-400 text-white rounded p-2 btn-redirect hidden" id="redi">انتقل الى لوحة التحكم</a>
    <button name="submit" class="bg-yellow-400 text-white rounded p-2 btn-create">إنشاء متجر</button>
</form>
</div>
<?php
    include "includes/footer.php";
?>