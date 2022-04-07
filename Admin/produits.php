<?php  
    include "Includes/navbar.php";
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
                <div class="p-4">
                    <h1 class="text-4xl font-semibold mb-3">Gestion des Produits</h1>
                    <hr>
                </div>
                <form id="Form_product" class="grid grid-cols-1 md:grid-cols-2 gap-3" enctype="multipart/form-data">
                    <div class="flex flex-col">
                        <label for="">Titre du produit :</label>
                        <input type="hidden" id="id_prod" name="id_prod" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                        <input type="text" name="produit" id="produit" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Description :</label>
                        <input type="text" name="description" id="description" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Prix :</label>
                        <input type="text" name="price" id="price" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Promotion :</label>
                        <input type="text" name="promo" id="promo" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                    </div>
                    <div class="flex flex-col">
                        <label for="">Quantité :</label>
                        <input type="number" name="QNT" min="0" id="QNT" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Etat :</label>
                        <select name="etat" id="etat" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Categories :</label>
                        <select name="categorie" id="categorie" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                            <?php
                                $query="SELECT * FROM category order by `name`";
                                $result=mysqli_query($conx,$query);
                                if($result){
                                    if(mysqli_num_rows($result) !=0){
                                        while($row=mysqli_fetch_array($result)){
                                            ?>
                                                <option value="<?php echo $row['ID_category']; ?>"><?php echo $row['name']; ?></option>
                                        <?php }
                                        
                                    }else{
                                        echo "<option value=''>En course ...</option>";
                                    }
                                } 
                            ?>                            
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Image :</label>
                        <input type="file" name="img_prod[]" id="img_prod" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" multiple required>
                    </div>
                    <div class="md:col-span-2">
                        <button name="add_prod" id="add_prod" class="bg-green-400 rounded shadow p-2 text-white float-right">ajouter</button>
                    </div>
                </form>

                <div class="my-2 flex sm:flex-row flex-col mt-10">
                    <div class="flex flex-row mb-1 sm:mb-0">

                        <div class="relative">
                            <select id="search_categ" class="appearance-none h-full rounded-l rounded-r border-l border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                <option value="-1" selected>Tous</option>
                                <?php
                                $query="SELECT * FROM category order by `name`";
                                $result=mysqli_query($conx,$query);
                                if($result){
                                    if(mysqli_num_rows($result) !=0){
                                        while($row=mysqli_fetch_array($result)){
                                            ?>
                                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                        <?php }
                                        
                                    }else{
                                        echo "<option value=''>En course ...</option>";
                                    }
                                } 
                            ?>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="block relative ">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input placeholder="Search" id="produitInput" onkeyup="produitFilter()"
                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                </div>

                <div class="inline-block w-full shadow rounded-lg mt-5  overflow-y-scroll">
                    
                    <table class="w-full leading-normal" id="produitTable">
                        <thead>
                            <tr class='text-center'>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    id
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    titre
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Etat
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantité
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Promotion
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Categories
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Prix
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    image
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody_prod">
                         

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php  
    include "Includes/footer.php";
?>