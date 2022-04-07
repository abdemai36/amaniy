<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles2.css">
    <link rel="icon" href="images/logo 5.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <title>تسجيل الدخول</title>
</head>

<body>




    <!-- main page -->
    <div class="h-screen w-screen flex">
        <div class="h-screen w-0 md:w-1/2 bg-cover" style="background-image: url('images/amaniy-back.jpg);">
        </div>

        <div class="flex flex-col w-full md:w-1/2 md:mt-32">
            <div class=" text-yellow-400 p-20 " dir="rtl">
                <div class="flex justify-between mb-5">
                    <img src="images/logo 5.png" alt="">
                    <a href="index" class="text-yellow-400 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                </div>
                <h1 class="text-2xl font-semibold">تسجيل الدخول</h1>
                <p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور</p>
            </div>
        
            <form action="Includes/login.inc.php" method="POST" class="flex flex-col space-y-7 w-3/4 mt-5  m-auto">

            <?php
                if(isset($_GET["form"])){
                    if($_GET["form"]=="empty"){?>
                     <div class="w-full text-white bg-red-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">أدخل جميع المعلومات. </p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
                if(isset($_GET["form"])){
                    if($_GET["form"]=="email"){?>
                     <div class="w-full text-white bg-red-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">البريد الإلكتروني غير صحيح! </p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
                if(isset($_GET["form"])){
                    if($_GET["form"]=="sqlerror"){?>
                     <div class="w-full text-white bg-red-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">هناك خطأ في مستوى قاعدة البيانات!</p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
                if(isset($_GET["form"])){
                    if($_GET["form"]=="wrongpwd"){?>
                     <div class="w-full text-white bg-red-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">كلمة المرور أو البريد الإلكتروني غير صحيح! </p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
                if(isset($_GET["form"])){
                    if($_GET["form"]=="nousers"){?>
                     <div class="w-full text-white bg-red-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">هذا البريد الإلكتروني غير موجود!</p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
                if(isset($_GET["new-pass"])){
                    if($_GET["new-pass"]=="updated"){?>
                     <div class="w-full text-white bg-green-500 rounded" dir="rtl">
                        <div class="p-4">
                            <div class="flex">
                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                    <path
                                        d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                    </path>
                                </svg>
                                <p class="mx-3">تحديث كلمة المرور بنجاح.</p>
                            </div>
                        </div>
                    </div>
                    <?php }
                }
           ?>

                <input type="email" name="email" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="البريد الإلكتروني" dir="rtl">
                <div class="flex flex-col">
                    <input type="password" name="pwd" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="كلمة المرور" dir="rtl">
                </div>
                <button type="submit" name="login-submit" class="bg-black text-white p-2 rounded-full"> تسجيل الدخول</button>
                <a href="signup" class="text-yellow-400">ليس لديك حساب؟ </a>
                
            </form>
        </div>
    </div>





    <script src="js/globale.js"></script>
</body>

</html>