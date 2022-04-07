<?php  
    include "Includes/navbar.php";
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
                <div class="p-4">
                    <h1 class="text-4xl font-semibold mb-3">Dashboard</h1>
                    <hr>
                </div>
                <!-- filters  -->
                <!--<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4 shadow-lg rounded-lg">
                    <div class="flex justify-center ">
                        <div x-data="{ dropdownOpen: false }" class="relative ">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="relative block rounded-md bg-white p-2 focus:outline-none flex justify-between bg-yellow-500 w-72">
                                Ville
                                <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                class="fixed inset-0 h-full w-full z-10"></div>
                            <div x-show="dropdownOpen"
                                class="absolute right-0 mt-2 py-2 w-full bg-white rounded-md shadow-xl z-20">
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    your profile
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Your projects
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Help
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Settings
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center ">
                        <div x-data="{ dropdownOpen: false }" class="relative ">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="relative  block rounded-md bg-white p-2 focus:outline-none flex justify-between bg-yellow-500 w-72">
                                Ville
                                <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                class="fixed inset-0 h-full w-full z-10"></div>
                            <div x-show="dropdownOpen"
                                class="absolute right-0 mt-2 py-2 w-full bg-white rounded-md shadow-xl z-20">
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    your profile
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Your projects
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Help
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Settings
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center ">
                        <div x-data="{ dropdownOpen: false }" class="relative ">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="relative  block rounded-md bg-white p-2 focus:outline-none flex justify-between bg-yellow-500 w-72">
                                Ville
                                <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                class="fixed inset-0 h-full w-full z-10"></div>
                            <div x-show="dropdownOpen"
                                class="absolute right-0 mt-2 py-2 w-full bg-white rounded-md shadow-xl z-20">
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    your profile
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Your projects
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Help
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Settings
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center ">
                        <input type="date"
                            class=" block rounded-md bg-white p-2 focus:outline-none flex justify-between bg-yellow-500 w-72">
                    </div>
                </div>-->
                <!-- ./filters  -->

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 gap-4 shadow-lg rounded-lg mt-20">
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div
                            class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">
                                <?php
                                    $query="SELECT count(*) FROM counter_visitor";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?>
                            </p>
                            <p>Visitors</p>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div
                            class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">
                                <?php
                                    $query="SELECT count(*) FROM tb_order";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?>
                            </p>
                            <p>Orders</p>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div
                            class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">
                            <?php
                                    $query="SELECT sum(global_price) FROM tb_order";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?> DH
                            </p>
                            <p>Chiffre d'affaire</p>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full  ">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                           <p class="text-2xl">
                            <?php
                                $query="SELECT count(*) FROM owner_store";
                                $result=mysqli_query($conx,$query);
                                if($result)
                                {
                                    while($row=mysqli_fetch_array($result)){
                                        echo number_format($row[0]);
                                    }
                                }
                            ?>
                            </p>
                            <p>Numbre de stores</p>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full  ">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">$75,257</p>
                            <p>Balances</p>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-yellow-600  text-white font-medium">
                        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full  ">
                            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl">$75,257</p>
                            <p>Balances</p>
                        </div>
                    </div>

                </div>
                <!-- ./Statistics Cards -->
            
      
            
            </div>
        </div>
    </div>
<?php  
    include "Includes/footer.php";
?>