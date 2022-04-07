<?php
    include "Includes/Navbar.php";
    if (isset($_POST['search'])) {
        $Name = $_POST['search'];
        $Query = " (SELECT name_product,etat,images,ID_produit FROM produit WHERE name_product LIKE '%$Name%') UNION (SELECT name_store,type_user,image,ID_owStore FROM owner_store WHERE name_store LIKE '%$Name%')";
        $ExecQuery = mysqli_query($conx, $Query);

        if($ExecQuery)
        {
            if(mysqli_num_rows($ExecQuery) !=0)
            {
                echo '
                <ul class="border-t  z-50 bg-white w-full  rounded-lg border ">
                ';
                while ($Result = mysqli_fetch_array($ExecQuery)) {
                    if($Result['etat'] == 'STR'){
                    ?>
                        <li class="p-2" onclick='fill("<?php echo $Result['name_product']; ?>")'>
                            <a class="flex items-center font-bold" href="detailStore?page=1&store=<?php echo $Result['name_product']?>&id=<?php echo $Result['ID_produit']?>">
                                <img class="h-10 w-10 rounded-full mr-2" src='Admin/avatar/<?php echo $Result['images'];?>'/>
                                <?php echo $Result['name_product'];?>
                            </a>
                        </li>
                <?php
                    }
                    else{?>
                    <li class="p-2" onclick='fill("<?php echo $Result['name_product']; ?>")'>
                            <a class="flex items-center font-bold" href="detail?titre=<?php echo $Result['name_product']?>">
                                 <img class="h-10 w-10 mr-2" src='Admin/avatar/<?php echo $Result['images'];?>'/>
                                <?php echo $Result['name_product'];?>
                            </a>
                        </li>
                    <?php
                } }
            }else{
               
                    echo  '<li class="p-2 list-none">  للايوجد منتج او مخزن بهذا الاسم ... </li>';
                
            }
        }
    
    }
?>
</ul>