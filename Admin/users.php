<?php  
    include "Includes/navbar.php";
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">
                <div class="p-4 w-full ">
                    <h1 class="text-4xl font-semibold mb-3 ">Gestion des utilisateurs</h1>
                    <hr>
                </div>
            <div class="inline-block w-full shadow rounded-lg mt-10 overflow-x-auto">
                 <input onkeyup="userFilter()" placeholder="Search" id="myInput" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full md:w-96 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        <table id="myTable" class="w-full leading-normal mt-10">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        id
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                     <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Mot de passe
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Téléphone
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        addresse
                                    </th>
                                    <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_usr">

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
<?php  
    include "Includes/footer.php";
?>