<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div
            class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:w-3/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="w-full bg-white shadow-lg">
                    <div class="flex justify-between p-4">
                        <div>
                            <img src="../images/logo4.png" alt="amaniy" class="w-1/2">

                        </div>
                        <button type="button"
                            class="modal-close bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-400">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-full h-0.5 bg-yellow-500"></div>
                    <div class="flex justify-between p-4">
                        
                            <address>
                                <span class="font-bold">La date de Commande :</span> 
                                <span class="model-date"> </span><br>
                                <span class="font-bold">ID de  Commande:</span> 
                                <span class="model-id"> </span>
                            </address>
                        
                        <div class="">
                            <address class="text-sm">
                                <span class="font-bold">Le nom de Client : </span>
                                <span class="model-username"> </span><br>
                                <span class="font-bold">Numéro de Téléphone : </span>
                                <span class="model-phone"></span>
                            </address>
                        </div>
                        <div class="">
                            <address class="text-sm">
                                <span class="font-bold">Adresse :</span>
                                    <span class="model-ville"></span> - 
                                    <span class="model-addresse"></span>
                            </address>
                        </div>
                        
                    </div>
                    <div class="flex justify-center p-4">
                        <div class="border-b border-gray-200 shadow overflow-x-auto">
                            <table class="">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-xs text-gray-500 ">
                                            #
                                        </th>
                                        <th class="px-4 py-2 text-xs text-gray-500 ">
                                            Produits titre
                                        </th>
                                        <th class="px-4 py-2 text-xs text-gray-500 ">
                                            Quantity
                                        </th>
                                        <th class="px-4 py-2 text-xs text-gray-500 ">
                                            Prix
                                        </th>
                                        <th class="px-4 py-2 text-xs text-gray-500 ">
                                            Prix totale
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            #
                                        </td>
                                        <td class="px-6 py-4 model-nameProduct">
                                            
                                        </td>
                                        <td class="px-6 py-4 model-qnt">
                                            
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 model-Price">
                                            
                                        </td>
                                        <td class="px-6 py-4 model-totalPrice">
                                            
                                        </td>
                                    </tr>
                                    <tr class="text-white bg-gray-800">
                                        <th colspan="3"></th>
                                        <td class="text-sm font-bold"><b>Total</b></td>
                                        <td class="text-sm font-bold"><b class="model-globalPrice"></b> DH</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-full h-0.5 bg-yellow-500"></div>

                </div>
            </div>
        </div>
    </div>

<div class="second-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:w-1/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="w-full bg-white flex flex-col p-5">
                    <div class="w-full">
                        <button type="button"
                            class="float-right modal-close2 bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-400">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="update_order" method="POST">
                        <label for="" class="text-xl">Choisir livreur :</label>
                        <input type="hidden" name="id_order" id="id_order">
                        <select name="code_livreur" class="mt-3 form-select appearance-none  block w-full  px-3 py-1.5  text-base  font-normal  text-gray-700  bg-white bg-clip-padding bg-no-repeat  border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-yellow-400 focus:outline-none"
                            aria-label="Default select example" autocomplete="on">
                            <option selected hidden value="-1">Selecter un livreur</option>
                            <?php
                                $query="SELECT * FROM livreurs ORDER BY addresse DESC";
                                $result=mysqli_query($conx,$query);
                                if($result){
                                    while($row=mysqli_fetch_array($result)){ ?>
                                        <option value="<?php echo $row["code_livreur"];?>"><?php echo $row["ville"];?> - <?php echo $row["name"];?></option>
                                    <?php }
                                }
                            ?>
                        </select>
                        <button type="submit" name="update_order" class="bg-yellow-400 text-white p-2 w-full rounded mt-3">valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script src="js/dashboard.js"></script>
    <script src="js/check-store.js"></script>
</body>
</html>
