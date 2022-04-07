<?php 
    include "Includes/navbar.php";


    if(isset($_POST['submit']))
    {
        $ID_owStore=$_POST['ID_owStore'];
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $store_name=$_POST['store_name'];
        $description=$_POST['description'];

        $image_Name = $_FILES['image']['name'];
        $image_Size = $_FILES['image']['size'];
        $image_tmpN = $_FILES['image']['tmp_name'];
        $image='';
        $dataImg='';
        $image_type = $_FILES['image']['type'];
        $image_Allow_Extansion = array("jpeg","png","jpg","gif","PNG","JEPJ","JPG");
    
        if (is_array($_FILES['image']['name']) || is_object($_FILES['image']['name'])) 
    {
        foreach($_FILES['image']['name'] as $key=>$val)
        {
            $image=$_FILES['image']['name'][$key];
            $image_tmpN=$_FILES['image']['tmp_name'][$key];
            $image_Extansion =pathinfo($image,PATHINFO_EXTENSION);
            move_uploaded_file($image_tmpN,'avatar/'.$image);
            $dataImg .=$image." ";
        }
        if(!in_array($image_Extansion,$image_Allow_Extansion))
        {
            echo "S'il vous plait saisir seulement des image (png | jpg | jpeg | gif)";
        }
        else
        {
            $query="UPDATE `owner_store` SET `username`='".$name."',
            `phone`='".$phone."',`image`='".$dataImg."',`name_store`='".$store_name."',`description`='".$description."' WHERE ID_owStore='".$ID_owStore."'";
            $result=mysqli_query($conx,$query);
            if($result){
                $_SESSION['success']="Modification avec success";
                echo '<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">';
                echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">'.$_SESSION["success"].'</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>';
                echo '</div>';
            }else{
                $_SESSION['error']="La modification de produit a échoué !";
                echo '<div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4 flex justify-center flex-col items-center">';
                echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">'.$_SESSION["error"].'</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>';
                echo '</div>';
            }
        }
    }
    }

?>