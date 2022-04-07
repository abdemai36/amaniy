<?php  
    include "Includes/navbar.php";
?>

            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">
                <div class="p-4 w-full ">
                    <h1 class="text-4xl font-semibold mb-3 ">Ajouter livreurs</h1>
                    <hr>
                </div>

                <div class="inline-block w-full shadow rounded-lg mt-5 md:mt-10 overflow-x-auto p-5">
                    <form id="Form_livreur" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" id="id_livreur" name="id_livreur">
                        <input type="text" id="name" name="name" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Nom complet" required>
                        <input type="email" id="email" name="email" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Email" required>
                        <input type="text" id="phone" name="phone" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Numéro de téléphone" required>
                        <input type="text" id="ville" name="ville" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Ville" required>
                        <input type="text" id="addresse" name="addresse" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="addresse" required>
                        <input type="text" id="code" name="code" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="code de livreur" required>
                        <input type="text" id="password" name="password" class="border-2 p-2 rounded outline-none focus:border-yellow-400 " placeholder="Mot de passe" required>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-green-400 rounded shadow p-2 text-white float-right">ajouter</button>
                        </div>
                    </form>
                </div>
                <div class="inline-block w-full shadow rounded-lg mt-5  overflow-y-scroll">
                <div class="py-8">
            
                
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <input onkeyup="livreurFilter()" placeholder="Search" id="livreurInput" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full md:w-96 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                            <table id="livreurTable" class="min-w-full leading-normal mt-10">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nom de livreur
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            email
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Téléphone
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            ville
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            adresse
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Code de livreur
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Mot de passe
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            date d'inscription
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_livreur">
                                   
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    </div>
<?php  
    include "Includes/footer.php";
?>