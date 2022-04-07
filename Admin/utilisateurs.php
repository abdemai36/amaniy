<?php
include "Includes/navbar.php";
?>

<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">
    <div class="p-4 w-full ">
        <h1 class="text-4xl font-semibold mb-3 ">Gestion des utilisateurs</h1>
        <hr>
    </div>
    <div class="inline-block w-full shadow rounded-lg mt-5 md:mt-10 overflow-x-auto p-5">
        <form id="Form_admin" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="hidden" name="id" id="id" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
            <input type="text" name="username" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="Nom" required>
            <input type="email" name="email" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="email" required>
            <input type="text" name="phone" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="numéro de téléphone" required>
            <input type="text" name="addresse" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="addresse" required>
            <input type="password" name="password" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400" placeholder="Mot de passe" required>
            <div class="md:col-span-2">
                <button type="submit" name="submit" id="btn-add-admin" class="bg-green-400 rounded shadow p-2 text-white float-right">ajouter</button>
            </div>
            </from>

    </div>
    <div class="inline-block w-full shadow rounded-lg mt-10 overflow-x-auto">
        
        <table class="w-full leading-normal " >
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
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Téléphone
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        addresse
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody id="tbody_adm">

            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php
include "Includes/footer.php";
?>