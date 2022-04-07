<?php  
    include "Includes/navbar.php";
    if(isset($_GET["id"]) && is_numeric($_GET['id']))
    {
        $id_store=$_GET['id'];
        $query="SELECT * FROM owner_store WHERE ID_owStore='".$id_store."'";
        $result=mysqli_query($conx,$query);
        $data=array();
        if($result)
        {
            if(mysqli_num_rows($result) != 0)
            {
                while($row= mysqli_fetch_array($result))
                {
                    $data[]=$row;
                }
            }else{
                header("location:stores");
                exit();
            }
        }
    }
?>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">
                <div class="p-4 w-full ">
                    <h1 class="text-4xl font-semibold mb-3 ">Modifier store</h1>
                    <hr>
                </div>
                <div class="inline-block w-full shadow rounded-lg mt-5 md:mt-10 overflow-x-auto p-5">
                    <form method="POST" action="update_store.php" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" id="ID_owStore" name="ID_owStore" value="<?php echo $data[0]["ID_owStore"];?>" >
                        <div class="flex flex-col">
                            <label for="">Nom </label>
                            <input type="text" id="name" name="name" value="<?php echo $data[0]["username"];?>" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Nom complet" required>
                        </div>
                        <div  class="flex flex-col">
                            <label for="">Numéro de téléphone </label>
                            <input type="text" id="phone" name="phone" value="<?php echo $data[0]["phone"];?>" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="Numéro de téléphone" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="">Nom de store</label>
                            <input type="text" id="store_name" name="store_name" value="<?php echo $data[0]["name_store"];?>" class="border-2 p-2 rounded outline-none focus:border-yellow-400" placeholder="nom de store" required>
                        </div>
                        <div class="flex flex-col">
                             <label for="">Nom de store</label>
                        <input type="file" name="image[]" class="border-2 p-2 rounded outline-none focus:border-yellow-400" >
                        </div>
                        <div class="flex flex-col">
                            <label for="">déscription </label>
                        <textarea class="border-2 p-2 rounded outline-none focus:border-yellow-400" name="description" id="" cols="30" rows="10"><?php echo $data[0]["description"];?></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="submit" class="bg-green-400 rounded shadow p-2 text-white float-right">Modifier</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
<?php  
    include "Includes/footer.php";
?>