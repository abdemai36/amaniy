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
    <title>Les commandes direct</title>
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
            <a href="Livreurs-dashboard"><img src="../images/logo2.png" alt="" class="h-7"></a>
            <div class="flex space-x-4">
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
            </div>

        </header>
    </div>
    <!-- end topbar -->
    <!-- main page -->
    <div class="container m-auto px-2 mb-20 mt-20">
        <div class="bg-yellow-400 text-white text-center w-full p-4  rounded-md text-4xl">
            طلبات مباشرة
        </div>

        <table class="w-full leading-normal mt-10">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        id
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Clients
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        products
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        les prix
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Qauntité
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        téléphone
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        code livreur
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        la date
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Prix totale
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        ville
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        addresse
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        Etat
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query="SELECT * FROM tb_order WHERE code_livreur='$code_livreur' AND direction=0 ORDER BY ID_order DESC";
                    $result=mysqli_query($conx,$query);
                    if($result)
                    {
                        if(mysqli_num_rows($result)!=0)
                        {
                            while($row=mysqli_fetch_array($result))
                            { ?>
                            <tr class="border-b border-gray-200 ">
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["ID_order"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["username"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["products"]; ?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php  echo $row["prices"];?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["Qnt"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["phone"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["code_livreur"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["date"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["total_price"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["ville"] ;?>
                                </td>
                                <td class="px-5 py-5  bg-white text-sm text-center">
                                    <?php echo $row["addresse"] ;?>
                                </td>
                                <?php
                                    if($row["etat"]=="en dépot"){?>
                                        <td class="px-5 py-5  bg-red-400 text-sm text-center">
                                            <?php echo $row["etat"] ;?>
                                        </td>
                                    <?php }elseif($row["etat"]=="En cours Liv."){ ?>
                                        <td class="px-5 py-5  bg-yellow-600 text-sm text-center">
                                            <?php echo $row["etat"] ;?>
                                        </td>
                                    <?php }elseif($row["etat"]=="livré"){ ?>
                                        <td class="px-5 py-5  bg-green-400 text-sm text-center">
                                            <?php echo $row["etat"] ;?>
                                        </td>
                                    <?php }
                                ?>
                                <td class="p-3 space-x-2 flex items-center  bg-white text-center">
                                    <form action="prendre" method="POST">
                                        <input type="hidden" name="id_order" value="<?php echo $row["ID_order"] ;?>">
                                        <button name="prendre" type="submit" class="detail bg-red-400 p-3 text-white rounded">
                                            prendre
                                        </button>
                                    </form>
                                   <form action="livre" method="POST">
                                        <input type="hidden" name="id_order" value="<?php echo $row["ID_order"] ;?>">
                                        <button name="livre" type="submit" class="detail bg-green-400 p-3 text-white rounded">
                                            livré
                                        </button>
                                   </form>
                                </td>
                            </tr>
                            
                            <?php }
                        }else{
                            echo "Aucune commande";
                        }
                    }else{
                        echo mysqli_error($conx);
                    }
                ?>     
            </tbody>
        </table>
    </div>
    <!-- end main page -->
    <footer class="bg-yellow-400 md:fixed md:bottom-0 w-full" dir="rtl">
        <div class="flex flex-col-reverse md:flex-row justify-center md:justify-between space-y-10 text-black container m-auto">
            <div class="flex flex-col space-y-5 justify-center items-center">
                <img src="images/logo2.png" alt="" class="w-40 ">
            </div>
        </div>
        <div class="text-white text-center text-white p-3 bg-black">
            © All rights reserved to Amaniy 2022.
        </div>
    </footer>
    <script src="../js/globale.js"></script>
</body>
</html>