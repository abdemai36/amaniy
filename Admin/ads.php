<?php  
    include "Includes/navbar.php";
?>

<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
                <div class="p-4">
                    <h1 class="text-4xl font-semibold mb-3">Gestion des publicités</h1>
                    <hr>
                </div>
                <form id="Form_ads" class="grid grid-cols-1 md:grid-cols-2 gap-3" enctype="multipart/form-data">
                    <div class="flex flex-col">
                        <label for="">Titre publicité :</label>
                        <input type="hidden" id="id_ads" name="id_ads" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                        <input type="text" name="titre_ads" id="titre_ads" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Page :</label>
                        <select name="page" id="page" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                            <option value="Accueil" selected>Accueil</option>
                            <option value="liste produit">liste produit</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="">URL publicité :</label>
                        <input type="text" name="url_ads" id="url_ads" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                    </div>
                    <div class="flex flex-col">
                        <label for="">Position publicité :</label>
                        <select name="position_ads" id="position_ads" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
                                             
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Image publicité :</label>
                        <input type="file" name="image_ads[]" id="image_ads" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                        <input type="hidden" name="input_image_ads" id="input_image_ads">
                    </div>
                    <div class="flex flex-col">
                        <label for="">Date debut :</label>
                        <input type="date" name="date_debut" id="date_debut" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Date fin :</label>
                        <input type="date" name="date_fin" id="date_fin" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" required>
                    </div>
                    <div class="md:col-span-2">
                        <button name="add_ads" type="submit" id="add_ads" class="bg-green-400 rounded shadow p-2 text-white float-right">ajouter</button>
                    </div>
                </form>


                <div class="inline-block w-full shadow rounded-lg mt-5  overflow-y-scroll">
                    <table class="w-full leading-normal" >
                        <thead>
                            <tr class='text-center'>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    id
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Titre publicité
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Page
                                </th>
                                   <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Position
                                </th> 
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date debut
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date fin
                                </th>
                              
                                 <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Image publicité
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                  Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody_ads">
                         

                        </tbody>
                    </table>
                </div>

            </div>
<?php  
    include "Includes/footer.php";
?>