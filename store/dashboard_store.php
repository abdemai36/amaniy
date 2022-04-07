<?php  
    include "includes/navbar.php";
    if(isset($_SESSION["idstore"]))
    {
        $id_owner_store=$_SESSION["idstore"];
    }
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
                <div class="p-4">
                    <h1 class="text-4xl font-semibold mb-3">Dashboard</h1>
                    <hr>
                </div>
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 gap-4 shadow-lg rounded-lg mt-20">
                   
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
                                    $query="SELECT count(*) FROM tb_order WHERE ID_owner_store=$id_owner_store";
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
                                    $query="SELECT sum(global_price) FROM tb_order WHERE ID_owner_store=$id_owner_store";
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
                                    $query="SELECT count(*) FROM produit WHERE ID_user=$id_owner_store";
                                    $result=mysqli_query($conx,$query);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result)){
                                            echo number_format($row[0]);
                                        }
                                    }
                                ?>
                            </p>
                            <p>total des produits</p>
                        </div>
                    </div>
                    
                    

                </div>
                <!-- ./Statistics Cards -->
            </div>
        </div>
    </div>
<?php  
    include "includes/footer.php";
?>