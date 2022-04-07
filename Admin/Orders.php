<?php  
    include "Includes/navbar.php";
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">
                <div class="p-4 w-full ">
                    <h1 class="text-4xl font-semibold mb-3 ">Orders</h1>
                    <hr>
                </div>
                <?php
                    if(isset($_GET["message"])){
                        if($_GET["message"]=="success"){?>
                        <div id="msg_success" class="w-full text-white bg-green-500 rounded" dir="rtl">
                            <div class="p-4">
                                <div class="flex">
                                    <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                        <path
                                            d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                        </path>
                                    </svg>
                                    <p class="mx-3"> تم تحويل الطلبية بنجاح </p>
                                </div>
                            </div>
                        </div>
                        <?php }
                    }
                ?>
                <div class="inline-block w-full shadow rounded-lg mt-5  overflow-x-auto">
                            <input onkeyup="orderFilter()" placeholder="Search" id="orderInput" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full md:w-96 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                     <table class="w-full leading-normal mt-10" id="orderTable">
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
                                    Details
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                    Transferer
                                </th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php
                                $query="SELECT * FROM tb_order ORDER BY ID_order DESC";
                                $result=mysqli_query($conx,$query);
                                if($result)
                                {
                                    if(mysqli_num_rows($result)!=0)
                                    {
                                        while($row=mysqli_fetch_array($result))
                                        {
                                            $ID_owner_store=explode("<br>",$row["ID_owner_store"]);
                                            $count=count($ID_owner_store);
                                            for ($i=0; $i < $count; $i++) { 
                                                if($ID_owner_store[$i]==0){ ?>
                                                 <tr>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["ID_order"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["username"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["products"]; ?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php  echo $row["prices"];?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["Qnt"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["phone"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["code_livreur"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["date"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["total_price"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["ville"] ;?>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                        <?php echo $row["addresse"] ;?>
                                                    </td>
                                                        <?php
                                                            if($row["etat"]=="en dépot"){?>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-red-400 text-sm text-center">
                                                                    <?php echo $row["etat"] ;?>
                                                                </td>
                                                            <?php }elseif($row["etat"]=="En cours Liv."){ ?>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-yellow-600 text-sm text-center">
                                                                    <?php echo $row["etat"] ;?>
                                                                </td>
                                                            <?php }elseif($row["etat"]=="livré"){ ?>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-green-400 text-sm text-center">
                                                                    <?php echo $row["etat"] ;?>
                                                                </td>
                                                            <?php }
                                                        ?>
                                                    <td class=" border-b border-gray-200 bg-white text-center">
                                                        <button class="detail bg-green-400 p-3 text-white rounded"
                                                        data-id="<?php echo $row["ID_order"] ;?>" data-username="<?php echo $row["username"] ;?>" data-phone="<?php echo $row["phone"] ;?>"
                                                        data-ville="<?php echo $row["ville"] ;?>" data-addresse="<?php echo $row["addresse"] ;?>"
                                                        data-date="<?php echo $row["date"] ;?>" data-nameProduct="<?php echo $row["products"] ;?>" data-qnt="<?php echo $row["Qnt"] ;?>"
                                                        data-totalPrice="<?php echo $row["total_price"] ;?>" data-Price="<?php echo $row["prices"] ;?>" 
                                                        data-globalPrice="<?php echo $row["global_price"] ;?>"
                                                        onclick="openModal()">
                                                            détail
                                                        </button>
                                                    </td>

                                                    <?php if(empty($row["code_livreur"])):?>
                                                        <td class=" border-b border-gray-200 bg-white text-center">
                                                            <button onclick="openModal2()" data-id="<?php echo $row["ID_order"];?>" class="transfir_code_livreur text-yellow-400 text-center flex justify-center items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    <?php endif;?>
                                                </tr>
                                                <?php }
                                            }
                                             ?>
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
            </div>
        </div>
    </div>
<!-- pop up -->

<?php  
    include "Includes/footer.php";
?>