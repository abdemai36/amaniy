<?php
    include_once("includes/navbar.php");
    if(isset($_SESSION["idstore"]))
    {
        $id_owner_store=$_SESSION["idstore"];
    }
    if(isset($_POST["ID_product"])){
        $ID_product=$_POST["ID_product"];
        $query="SELECT *,c.name as nameC FROM produit p inner join category c on p.ID_category=c.ID_category WHERE ID_produit=$ID_product LIMIT 1";
        $result=mysqli_query($conx,$query);
        $data=array();
        if($result){
            if(mysqli_num_rows($result) !=0){
                while($row=mysqli_fetch_array($result)){
                    $namep=$row["name_product"];
                    $description=$row["description"];
                    $etat=$row["etat"];
                    $qnt=$row["qnt"];
                    $promotion=$row["promotion"];
                    $category=$row["nameC"];
                    $price=$row["price"];
                    $image=$row["images"];
                }
            }else{
                header("location:product");
                exit();
            }
        }
    }
   
?>
<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
<div class="p-4">
    <h1 class="text-4xl font-semibold mb-3">Modifier le Produit</h1>
    <hr>
</div>
    <?php 
        if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
            echo  "<div class='text-center text-white py-2 w-3/4 m-auto bg-red-400 rounded mb-4' >".$_SESSION['error']."</div>";
            unset( $_SESSION["error"]);
        }
        if(isset($_SESSION["success"]) && !empty($_SESSION["success"])){
            echo  "<div class='text-center text-white py-2 w-3/4 m-auto bg-green-400 rounded mb-4' >".$_SESSION['success']."</div>";
            unset( $_SESSION["success"]);
        }
    ?>

<form method="POST" action="update_product" class="grid grid-cols-1 md:grid-cols-2 gap-3" enctype="multipart/form-data">
    <div class="flex flex-col">
        <label for="">Titre du produit :</label>
        <input type="hidden" name="ID_product" value="<?php echo $ID_product ?>" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
        <input type="text" name="name_product" value="<?php echo $namep ?>" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Description :</label>
        <textarea type="text" name="description"  class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400"><?php echo $description ?></textarea>
        
    </div>
    <div class="flex flex-col">
        <label for="">Prix :</label>
        <input type="text" name="prix" value="<?php echo $price; ?>" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Promotion :</label>
        <input type="text" name="promotion" value="<?php echo $promotion?>" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Quantité :</label>
        <input type="number" name="qnt" value="<?php echo $qnt?>" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Etat :</label>
        <select name="etat" id="" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
            <option value="Active"<?=$etat == 'Active' ? ' selected="selected"' : '';?>>Active</option>
            <option value="Inactive"<?=$etat == 'Inactive' ? ' selected="selected"' : '';?>>Inactive</option>
        </select>
    </div>
    <div class="flex flex-col">
        <label for="">Categories :</label>
        <select name="categoriy" id="" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
            <?php 
                $query_category="SELECT * FROM category";
                $result_category=mysqli_query($conx,$query_category);
                if($result_category){
                    while($row=mysqli_fetch_array($result_category)){ ?>
                        <option value="<?php echo $row["ID_category"]?>"><?php echo $row["name"];?></option>
                    <?php }
                }
            ?>
        </select>
    </div>
    <div class="flex flex-col">
        <label for="">Image :</label>
        <input type="file" name="image_product[]" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
        <img class="w-32 h-32 mt-2" src="../Admin/avatar/<?php echo $image?>" alt="<?php echo $namep?>">
    </div>
    <div class="md:col-span-2">
        <button type="submit" name="update_product" class="bg-green-400 rounded shadow p-2 text-white float-right">Modifier</button>
    </div>
</form>

</div>
</div>
<?php
    include_once("includes/footer.php");
?>