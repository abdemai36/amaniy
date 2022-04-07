<?php
    include_once("includes/navbar.php");
    if(isset($_SESSION["idstore"]))
    {
        $id_owner_store=$_SESSION["idstore"];
    }

    if(!isset($_GET['page']) || empty($_GET["page"])){
        header("location:product?page=1");
        exit();
    }else{

        if(is_numeric($_GET['page'])){
            $page=intval($_GET['page']);
        }else{
            $page=0;
        }
    }

    $nbr_product_par_page=10;
    $nbr_product_max_avant_apre=10;

    $query_product="SELECT * FROM produit where ID_user=$id_owner_store";
    $result=mysqli_query($conx,$query_product);
    $nbr_total_product=mysqli_num_rows($result);

    $last_page=ceil($nbr_total_product/$nbr_product_par_page);
    $Limit='LIMIT '.($page-1)*$nbr_product_par_page.','.$nbr_product_par_page;

    $query_product="SELECT *,c.name as category_name FROM produit p inner join category c on p.ID_category=c.ID_category where ID_user=$id_owner_store $Limit";
    $result_product=mysqli_query($conx,$query_product);

    $pagination='';
    if($last_page!=1){
        if($page>1){
            $previous=$page-1;
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product?&page='.$previous.'"><</a>';
            for($i=$page-$nbr_product_max_avant_apre;$i<$page;$i++){
                if($i>0){
                    $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product?&page='.$i.'">'.$i.'</a>';
                }
            }
        }
        $pagination .='<span class="bg-blue-500 border-gray-300 text-white cursor-default relative inline-flex items-center px-4 py-2 border text-sm font-medium">'.$page.'</span>';
        for($i=$page+1;$i<=$last_page;$i++){
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product?&page='.$i.'">'.$i.'</a>';
            if($i>=$page+$nbr_product_max_avant_apre){
                break;
            }
        }
        if($page!=$last_page){
            $next=$page+1;
            $pagination.='<a class="bg-white border-gray-300 text-gray-500  relative inline-flex items-center px-4 py-2 border text-sm font-medium" href="product?&page='.$next.'">></a>';
        }
    }
   
?>
<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">
<div class="p-4">
    <h1 class="text-4xl font-semibold mb-3">Gestion des Produits</h1>
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

<form method="POST" action="add_product" class="grid grid-cols-1 md:grid-cols-2 gap-3" enctype="multipart/form-data">
    <div class="flex flex-col">
        <label for="">Titre du produit :</label>
        <input type="text" name="name_product" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Description :</label>

        <input type="text" name="description" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Prix :</label>
        <input type="text" name="prix" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Promotion :</label>
        <input type="text" name="promotion" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Quantité :</label>
        <input type="number" name="qnt" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
    </div>
    <div class="flex flex-col">
        <label for="">Etat :</label>
        <select name="etat" id="" class="border-2 rounded focus:outline-none p-2 focus:border-yellow-400">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
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
    </div>
    <div class="md:col-span-2">
        <button type="submit" name="add_product" class="bg-green-400 rounded shadow p-2 text-white float-right">ajouter</button>
    </div>
</form>

<div class="inline-block w-full shadow rounded-lg mt-5  overflow-y-scroll">
   
                  
                    <div class="block relative md:w-full w-96">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input placeholder="Search" id="storeproduitInput" onkeyup="storeproduitFilter()" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                
    <table class="w-full leading-normal " id="storeproduitTable">
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
                    Description
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Prix
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Promotion
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Etat
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Categories
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Image
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($result_product)
                {
                    if(mysqli_num_rows($result_product) !=0){
                        while($row=mysqli_fetch_array($result_product)){ ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php echo $row["ID_produit"];?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php echo $row["name_product"];?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm truncate">
                                    <?php echo substr($row["description"] ,0,50) ;?>...
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php echo $row["price"];?> DH
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php echo $row["promotion"];?>%
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php 
                                        if($row["etat"]=="Active"){ ?>
                                            <span class='bg-green-100 text-green-500 p-1 rounded-full'><?php echo $row["etat"];?></span>
                                        <?php }elseif($row["etat"]=="Inactive"){ ?>
                                            <span class='bg-red-100 text-red-500 p-1 rounded-full'><?php echo $row["etat"];?></span></td>
                                        <?php }
                                    ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php echo $row["category_name"]?>
                                </td>
                                <td class=" border-b border-gray-200 bg-white ">
                                    <?php 
                                        $res=$row["images"];
                                        $res=explode(" ",$row["images"]);
                                        $count=count($res)-1;
                                        for($i=0;$i<$count;$i++){
                                            echo "<img class='h-20' src='../Admin/avatar/".$res[$i]."' alt='".$row["name_product"]."'>";
                                        }
                                    ?>
                                </td>
                                <td class="flex items-center justify-center h-full bg-white ">
                                    <form action="edit_product" method="POST">
                                        <input type="hidden" name="ID_product" value="<?php echo $row["ID_produit"];?>">
                                        <button class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </form>
                                   
                                    <form action="delete_product" method="POST">
                                        <input type="hidden" name="ID_product" value="<?php echo $row["ID_produit"];?>">
                                        <button class="text-blue-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        <?php }
                    }else{
                        echo mysqli_error($conx);
                    }               
                }else{
                    echo mysqli_error($conx);

                }
            ?>
        </tbody>
    </table>

</div>
<div class="mt-10 w-full flex justify-center">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <?php
             if(!isset($_GET["page"]) || $_GET['page']>$last_page || $_GET['page']==0)
             {
                echo "<div class='my-32'>Aucun product ajouté.</div>";
        
            }else{
                ?>
                    <div class="pagina">
                        <div>
                            <?php echo $pagination;?>
                        </div>
                        
                    </div>
        
            <?php }
            
            ?>
            </nav>
        </div>
</div>
</div>
</div>
<script>function storeproduitFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("storeproduitInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("storeproduitTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}</script>
<?php
    include_once("includes/footer.php");
?>