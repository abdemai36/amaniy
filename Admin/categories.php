<?php  
    include "Includes/navbar.php";
?>


            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex flex-col  items-center">
                <div class="p-4 w-full ">
                    <h1 class="text-4xl font-semibold mb-3 ">Categories</h1>
                    <hr>
                </div>

                <form id="Form_categ" method="POST" class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-2" enctype="multipart/form-data">
                    <input type="hidden" id="id_categ" name="id_categ" class="border-2 rounded focus:outline-none p-2">
                    <input type="text" id="categorie" name="categorie" class="border-2 rounded focus:outline-none p-2">
                    <input type="file" id="logo_category" name="logo_category[]" class="border-2 rounded focus:outline-none p-2">
                    <input type="file" id="image_category" name="image_category[]" class="border-2 rounded focus:outline-none p-2">
                    <button id="btn_add_categ" class="bg-green-400 rounded shadow p-2 text-white ">Ajouter</button>
                </form>
                <div class="inline-block w-full md:w-1/2  shadow rounded-lg mt-5 overflow-x-scroll">
                    <table class="w-full leading-normal ">
                        <thead>
                            <tr>
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
                                    logo
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    image
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody_categ">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php  
    include_once("Includes/footer.php");
?>