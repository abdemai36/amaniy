$(document).ready(function () {
    //insert Produit  data
    $("#Form_product").on("submit",function(e)
    {
        e.preventDefault();
        var id_prod=$("#id_prod").val();
        var produit=$("#produit").val();
        var description=$("#description").val();
        var price=$("#price").val();
        var QNT=$("#QNT").val();
        var promo=$("#promo").val();
        var categorie=$("#categorie").find(":selected").text();
        var marque=$("#marque").find(":selected").text();
        var etat=$("#etat").find(":selected").text();
        var img_prod=$("#img_prod")[0].files;
        if(img_prod.length>0 && produit!="" && description!="" && price!=""  && QNT!="" && promo!="" && categorie!="" && etat!="")
        {
            $.ajax({
                url:"Produit_manage/insert_prod.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){ 
                    Swal.fire({
                        text: data
                    })
                    $("#Form_product")[0].reset();
                    select_Data_product();
                }
            })
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SVP! Saisir tous les informations.'
            });
            
        }

    });

    //select Produit  data
    function select_Data_product()
    {
        outPut_prod="";
        act="";
        
        $.ajax({
            url:"Produit_manage/select_prod.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    if(data[i].etat=="Active"){
                        act=data[i].etat="<td><span class='bg-green-100 text-green-500 p-1 rounded-full'>"+data[i].etat+"</span></td>";
                    }else if(data[i].etat=="Inactive"){
                        act=data[i].etat="<td><span class='bg-red-100 text-red-500 p-1 rounded-full'>"+data[i].etat+"</span></td>";
                    }
                    var res_image = data[i].images.split(" ");
                    outPut_prod +="<tr class='text-center'>"
                    +"<td>"+data[i].ID_produit +"</td>"+
                    "<td>"+data[i].name_product+"</td>"+
                    "<td>"+data[i].description+"</td>"
                    +act+
                    "<td>"+data[i].qnt+"</td>"+
                    "<td>"+data[i].promotion+"</td>"+
                    "<td>"+data[i].category_name+"</td>"+
                    "<td>"+data[i].price+"</td>"+
                    "<td><img style='width:90px;height:90px;' src='avatar/"+res_image[0]+"'></td>"+
                    "<td>"+
                    "<button class='text-red-500 btn-sm btn-edit-prod' data-id-prod='"+data[i].ID_produit+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</button>&nbsp;&nbsp; &nbsp; &nbsp;"+
                    "<button class='btn btn-danger btn-sm btn-delete-prod' data-id-prod='"+data[i].ID_produit+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
                        "</svg>"+
                    "</button></td>";
                }
                $("#tbody_prod").html(outPut_prod);
            }
        })
    } 
    select_Data_product();

      //Edit produit  data
      $("tbody").on('click','.btn-edit-prod',function(){

        var ID_prod=$(this).attr("data-id-prod");
        MyData_prod={ID_prod:ID_prod};
        $.ajax({
            url:"Produit_manage/edit_prod.php",
            method:"POST",
            dataType:"JSON",
            data:JSON.stringify(MyData_prod),
            success:function(data)
            {
                $("#id_prod").val(data.ID_produit);
                $("#produit").val(data.name_product);
                $("#description").val(data.description);
                $("#price").val(data.price);
                $("#QNT").val(data.qnt);
                $("#promo").val(data.promotion);
                $("#categorie").val(data.ID_category).change()
                $("#marque").val(data.ID_marke).change()
                $("#etat").val(data.etat).change()
            }
        })
    });

    //Delete Produit  data
    $("tbody").on('click','.btn-delete-prod',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            
                var id_prod=$(this).attr("data-id-prod");
                MyData_del_prod={id_prod:id_prod};
                this_btn_prod=this;
                $.ajax({
                    url:"Produit_manage/delete_prod.php",
                    method:"POST",
                    data:JSON.stringify(MyData_del_prod),
                    success:function(data)
                    {
                        Swal.fire({
                            title: data
                        })
                        $(this_btn_prod).closest("tr").fadeOut("slow");
                    }
                })
            
        }
        return false;
    });
    
    //*****Les categories****/
    
    //select Categories data
    function select_Data_categ()
    {
        outPut_categ="";
        $.ajax({
            url:"Category/select_categ.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut_categ+="<tr class='text-center'><td>"+data[i].ID_category +"</td><td>"+data[i].name+"</td>"+
                    "<td><img style='width:40px;height:40px;' src='avatar/"+data[i].logo+"'></td>"+
                    "<td><img style='width:40px;height:40px;' src='avatar/"+data[i].image+"'></td>"+
                    "<td>"+
                    "<button class='text-red-500 btn-sm btn-edit-categ' data-id-categ='"+data[i].ID_category+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</button>&nbsp;&nbsp; &nbsp; &nbsp;"+
                    "<button class='btn btn-danger btn-sm btn-delete_categ' data-id-categ='"+data[i].ID_category+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
                        "</svg>"+
                    "</button></td>";
                }

                $("#tbody_categ").html(outPut_categ);
            }
        })
    } 
    select_Data_categ();

    //insert Categories data
    $("#Form_categ").on("submit",function(e)
    {
        e.preventDefault();
        var id_categ=$("#id_categ").val();
        var categorie=$("#categorie").val();
        var logo_category=$("#logo_category")[0].files;
        var image_category=$("#image_category")[0].files;

        if(logo_category.length>0 && image_category.length>0 && categorie!="")
        {
            $.ajax({
                    url:"Category/Insert_categ.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){ 
                        Swal.fire({
                            text: data
                        })
                        $("#Form_categ")[0].reset();
                        select_Data_categ();
                    }
                })
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SVP! Saisir tous les informations.'
            });
        }

    });

      
    
    //Delete Categories data
    $("tbody").on('click','.btn-delete_categ',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            var id_categ=$(this).attr("data-id-categ");
            MyData_del_categ={id_categ:id_categ};
            this_btn_categ=this;
            $.ajax({
                url:"Category/delete_categ.php",
                method:"POST",
                data:JSON.stringify(MyData_del_categ),
                success:function(data)
                {
                    Swal.fire({
                        title: data
                    })
                    $(this_btn_categ).closest("tr").fadeOut("slow");
                }
            })
        }
        return false;
    });

    //Edit Categories data
    $("tbody").on('click','.btn-edit-categ',function(){
            var id_categ_et=$(this).attr("data-id-categ");
            MyData_categ_et={id_categ_et:id_categ_et};
            $.ajax({
                url:"Category/edit_categ.php",
                method:"POST",
                dataType:"JSON",
                data:JSON.stringify(MyData_categ_et),
                success:function(data)
                {
                    $("#id_categ").val(data.ID_category);
                    $("#categorie").val(data.name);
                }
            })
    });
    
   
    //select admins data
    function select_Data()
    {
        outPut="";
        $.ajax({
            url:"Admin_manage/select_adm.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut+="<tr class='text-center'><td>"+data[i].userID+"</td><td>"+data[i].username+"</td><td>"
                    +data[i].email+"</td><td>"+data[i].phone+"</td>"+
                    "<td>"+data[i].addresse+"</td>"+
                    "<td>"+
                    "<button class='btn btn-danger btn-sm btn-delete-admin' data-id-admin='"+data[i].userID+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'/>"+
                        "</svg>"+
                    "</button></td></tr>";
                }

                $("#tbody_adm").html(outPut);
            }
        })
    } 
    select_Data();


        //insert admins data
        $("#Form_admin").on("submit",function(e)
        {
            e.preventDefault();
            var id=$("#id").val();
            var username=$("#username").val();
            var email=$("#email").val();
            var password=$("#password").val();
            var phone=$("#phone").val();
            var addresse=$("#addresse").val();

            if(username!="" && email!="" && password!="" && phone!="" && addresse!="")
            {
                $.ajax({
                        url:"Admin_manage/Insert_adm.php",
                        method:"POST",
                        data:new FormData(this),
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(data){ 
                            Swal.fire({
                                text: data
                            })
                            $("#Form_admin")[0].reset();
                            select_Data();
                        }
                    })
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'SVP! Saisir tous les informations.'
                });
            }

        });


       //Delete admins data
    $("tbody").on('click','.btn-delete-admin',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            var id_adm=$(this).attr("data-id-admin");
            MyData_del={id_adm:id_adm};
            this_btn=this;
            $.ajax({
                url:"Admin_manage/delete_adm.php",
                method:"POST",
                data:JSON.stringify(MyData_del),
                success:function(data)
                {
                    Swal.fire({
                        title: data
                    })
                    //select_Data();
                    $(this_btn).closest("tr").fadeOut("slow");
                }
            })
        }
        return false;
    });

    //Edit admins data
    $("tbody").on('click','.btn-edit-admin',function(){

        var id=$(this).attr("data-id-admin");
        MyData={id:id};
        $.ajax({
            url:"Admin_manage/edit_adm.php",
            method:"POST",
            dataType:"JSON",
            data:JSON.stringify(MyData),
            success:function(data)
            {
                $("#id").val(data.userID);
                $("#username").val(data.username);
                $("#password").val(data.password);
                $("#email").val(data.email);
                $("#phone").val(data.phone);
                $("#addresse").val(data.addresse);
            }
        })
    });



    //select usr data
    
    function select_Data_usr()
    {
    
        outPut_usr="";
        $.ajax({
            url:"Admin_manage/select_usr.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut_usr+="<tr class='text-center'><td>"+data[i].userID+"</td><td>"+data[i].username+"</td><td>"
                    +data[i].email+"</td><td>"+data[i].phone+"</td>"+
                    "<td>"+data[i].addresse+"</td>"+
                    "<td>"+
                    "<button class='btn btn-danger btn-sm btn-delete-admin' data-id-admin='"+data[i].userID+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'/>"+
                        "</svg>"+
                    "</button></td></tr>";
                }

                $("#tbody_usr").html(outPut_usr);
            }
        })
    } 
    select_Data_usr();












    //search using category
    // $("#search_categ").on("change",function(){
    //    var result=$("#search_categ").val();
    //    outPut_prod="";
    //     act="";
    //    $.ajax({
    //         type: 'POST',
    //         data:{result:result},
    //         url: 'Produit_manage/search.php',
    //         success: function(data)
    //         {
    //             if(data)
    //                 x=data;
    //             else
    //                 x="";
    //             for(i=0;i<x.length;i++)
    //             {
    //                 if(data[i].etat=="Active"){
    //                     act=data[i].etat="<td><span class='bg-green-100 text-green-500 p-1 rounded-full'>"+data[i].etat+"</span></td>";
    //                 }else if(data[i].etat=="Inactive"){
    //                     act=data[i].etat="<td><span class='bg-red-100 text-red-500 p-1 rounded-full'>"+data[i].etat+"</span></td>";
    //                 }
    //                 outPut_prod +="<tr class='text-center'>"
    //                 +"<td>"+data[i].ID_produit +"</td>"+
    //                 "<td>"+data[i].name+"</td>"+
    //                 "<td>"+data[i].description+"</td>"
    //                 +act+
    //                 "<td>"+data[i].qnt+"</td>"+
    //                 "<td>"+data[i].promotion+"</td>"+
    //                 "<td>"+data[i].name+"</td>"+
    //                 "<td>"+data[i].price+"</td>"+
    //                 "<td><img style='width:90px;height:90px;' src='avatar/"+data[i].images+"'></td>"+
    //                 "<td>"+
    //                 "<button class='text-red-500 btn-sm btn-edit-prod' data-id-prod='"+data[i].ID_produit+"'>"+
    //                     "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
    //                         "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
    //                         "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
    //                             "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
    //                     "</svg>"+
    //                 "</button>&nbsp;&nbsp; &nbsp; &nbsp;"+
    //                 "<button class='btn btn-danger btn-sm btn-delete-prod' data-id-prod='"+data[i].ID_produit+"'>"+
    //                     "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
    //                         "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
    //                         "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
    //                         "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
    //                     "</svg>"+
    //                 "</button></td>";
    //             }
    //         $("#tbody_prod").html(outPut_prod);
    //         }
    //     });
    // })

    //insert ads data
    $("#Form_ads").on("submit",function(e)
    {
        e.preventDefault();
        var id_ads=$("#id_ads").val();
        var titre_ads=$("#titre_ads").val();
        var page=$("#page").find(":selected").text();
        var url_ads=$("#url_ads").val();
        var position_ads=$("#position_ads").find(":selected").text();
        var date_debut=$("#date_debut").val();
        var date_fin=$("#date_fin").val();
        var image_ads=$("#image_ads")[0].files;

        if(image_ads.length>0 && titre_ads!="" && page!="" && position_ads!="" && date_fin !="" && date_debut !="")
        {
            $.ajax({
                    url:"Ads_manage/Insert_ads.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){ 
                        Swal.fire({
                            text: data
                        })
                        $("#Form_ads")[0].reset();
                        select_Data_ads();
                    }
                })
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SVP! Saisir tous les informations.'
            });
        }

    });

    //select ads  data
    function select_Data_ads()
    {
        outPut_ads="";
        act="";
        
        $.ajax({
            url:"Ads_manage/select_ads.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut_ads +="<tr class='text-center'>"
                    +"<td>"+data[i].ID_ads  +"</td>"+
                    "<td><a class='underline hover:text-yellow-500' href='"+data[i].url_ads+"' >"+data[i].titre_ads+"</a></td>"+
                    "<td>"+data[i].page+"</td>"+
                    "<td>"+data[i].position_ads+"</td>"+
                    "<td>"+data[i].date_debut+"</td>"+
                    "<td>"+data[i].date_fin+"</td>"+
                    "<td><img style='width:90px;height:90px;' src='avatar/"+data[i].image_ads+"'></td>"+
                    "<td>"+
                    "<button class='text-red-500 btn-sm btn-edit-ads' data-id-ads='"+data[i].ID_ads +"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</button>&nbsp;&nbsp; &nbsp; &nbsp;"+
                    "<button class='btn btn-danger btn-sm btn-delete-ads' data-id-ads='"+data[i].ID_ads +"' data-image='"+data[i].image_ads+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
                        "</svg>"+
                    "</button></td>";
                }
                $("#tbody_ads").html(outPut_ads);
            }
        })
    } 
    select_Data_ads();

    //Edit ads  data
    $("tbody").on('click','.btn-edit-ads',function(){

        var ID_ads=$(this).attr("data-id-ads");

        MyData_prod={ID_ads:ID_ads};
        $.ajax({
            url:"Ads_manage/edit_ads.php",
            method:"POST",
            dataType:"JSON",
            data:JSON.stringify(MyData_prod),
            success:function(data)
            {

                $("#id_ads").val(data.ID_ads);
                $("#titre_ads").val(data.titre_ads);
                $("#page").val(data.page);
                $("#url_ads").val(data.url_ads);
                $("#position_ads").val(data.position_ads);
                $("#date_debut").val(data.date_debut);
                $("#date_fin").val(data.date_fin);
                $("#input_image_ads").val(data.image_ads);
            }
        })
    });

    //Delete ads  data
    $("tbody").on('click','.btn-delete-ads',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            
                var id_ads=$(this).attr("data-id-ads");
                //var img_ads=$(this).attr("data-image");
                MyData_del_ads={id_ads:id_ads};
                this_btn_ads=this;
                $.ajax({
                    url:"Ads_manage/delete_ads.php",
                    method:"POST",
                    data:JSON.stringify(MyData_del_ads),
                    success:function(data)
                    {
                        Swal.fire({
                            title: data
                        })
                        console.log(data);
                        $(this_btn_ads).closest("tr").fadeOut("slow");
                    }
                })
            
        }
        return false;
    });

    //insert livreue data
    $("#Form_livreur").on("submit",function(e)
    {
        e.preventDefault();
        var id_livreur=$("#id_livreur").val();
        var name=$("#name").val();
        var email=$("#email").val();
        var phone=$("#phone").val();
        var ville=$("#ville").val();
        var addresse=$("#addresse").val();
        var code=$("#code").val();
        var password=$("#password").val();

        if(name!="" && email!="" && phone!="" && ville!="" && addresse !="" && password !="" && code!="")
        {
            $.ajax({
                    url:"Livreur_manage/Insert_livreur.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){ 
                        Swal.fire({
                            text: data
                        })
                        $("#Form_livreur")[0].reset();
                        select_Data_livreur();
                    }
                })
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SVP! Saisir tous les informations.'
            });
        }

    });

    //select livreur data
    function select_Data_livreur()
    {
        outPut_livreur="";
        $.ajax({
            url:"Livreur_manage/select_livreur.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    
                    outPut_livreur+="<tr class='text-center'><td>"+data[i].name+"</td><td>"+data[i].email+"</td></td><td>"+data[i].phone+"</td>"+
                    "<td>"+data[i].ville+"</td>"+
                    "<td>"+data[i].addresse+"</td>"+
                    "<td>"+data[i].code_livreur+"</td>"+
                    "<td>"+data[i].password+"</td>"+
                    "<td>"+data[i].date+"</td>"+
                    "<td>"+
                    "<button class='btn text-red-500 btn-sm btn-edit-livreur' data-id-livreur='"+data[i].ID_livreur+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</button>"+
                    "<button class='btn btn-danger btn-sm btn-delete-livreur' data-id-livreur='"+data[i].ID_livreur+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'/>"+
                        "</svg>"+
                    "</button>"+
                    "</td></tr>";
                }

                $("#tbody_livreur").html(outPut_livreur);
            }
        })
    } 
    select_Data_livreur();

       //Delete livreur data
       $("tbody").on('click','.btn-delete-livreur',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            var id_livreur=$(this).attr("data-id-livreur");
            MyData_del={id_livreur:id_livreur};
            this_btn=this;
            $.ajax({
                url:"Livreur_manage/delete_livreur.php",
                method:"POST",
                data:JSON.stringify(MyData_del),
                success:function(data)
                {
                    Swal.fire({
                        title: data
                    })
                    //select_Data();
                    $(this_btn).closest("tr").fadeOut("slow");
                }
            })
        }
        return false;
    });

    //Edit livreur data
    $("tbody").on('click','.btn-edit-livreur',function(){

        var id=$(this).attr("data-id-livreur");
        MyData={id:id};
        $.ajax({
            url:"Livreur_manage/edit_livreur.php",
            method:"POST",
            dataType:"JSON",
            data:JSON.stringify(MyData),
            success:function(data)
            {
                $("#id").val(data.userID);
                $("#username").val(data.username);
                $("#password").val(data.password);
                $("#email").val(data.email);
                $("#phone").val(data.phone);
                $("#addresse").val(data.addresse);

                $("#id_livreur").val(data.id_livreur)
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#phone").val(data.phone);
                $("#ville").val(data.ville);
                $("#addresse").val(data.addresse);
                $("#code").val(data.code_livreur);
                $("#password").val(data.password);

            }
        })
    });

    //select stores data
    function select_Data_store()
    {
        outPut_store="";
        $.ajax({
            url:"stores_manage/select_store.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut_store+="<tr class='text-center'><td>"+data[i].ID_owStore +"</td><td>"+data[i].username+"</td>"+
                    "<td>"+data[i].email+"</td>"+
                    "<td>"+data[i].password+"</td>"+
                    "<td>"+data[i].phone+"</td>"+
                    "<td>"+data[i].name_store+"</td>"+
                    "<td><img style='width:90px;height:90px;' src='avatar/"+data[i].image+"'></td>"+
                    "<td>"+data[i].date+"</td>"+
                    "<td class='flex items-center justify-center h-full'>"+
                    "<button class='btn btn-danger btn-sm btn-delete-store' data-id-store='"+data[i].ID_owStore+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
                        "</svg>"+
                    "</button>"+
                    "<a href='edit-store.php?id="+data[i].ID_owStore+"' class='btn text-red-500 btn-sm btn-edit-store'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</a></td>";
                }
                $("#tbody_store").html(outPut_store);
            }
        })
    } 
    select_Data_store();

    //Delete store data
    $("tbody").on('click','.btn-delete-store',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            var id_store=$(this).attr("data-id-store");
            MyData_del={id_store:id_store};
            this_btn=this;
            $.ajax({
                url:"stores_manage/delete_store.php",
                method:"POST",
                data:JSON.stringify(MyData_del),
                success:function(data)
                {
                    Swal.fire({
                        title: data
                    })
                    //select_Data();
                    $(this_btn).closest("tr").fadeOut("slow");
                }
            })
        }
        return false;
    });
    
       //insert slider ads data
    $("#Form_slider_ads").on("submit",function(e)
    {
        e.preventDefault();
        var id_ads=$("#id_slider_ads").val();
        var titre_ads=$("#titre_slider_ads").val();
        var url_ads=$("#url_slider_ads").val();
        var date_debut=$("#date_debut").val();
        var date_fin=$("#date_fin").val();
        var image_ads=$("#image_slider_ads")[0].files;

        if(image_ads.length>0 && titre_ads!="" && date_fin !="" && date_debut !="")
        {
            $.ajax({
                    url:"Ads_slider_manage/insert_slider_ads.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){ 
                        Swal.fire({
                            text: data
                        })
                        $("#Form_slider_ads")[0].reset();
                        select_Data_slider_ads();
                    }
                })
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SVP! Saisir tous les informations.'
            });
        }

    });

    function select_Data_slider_ads()
    {
        outPut_slider_ads="";
        act="";
        $.ajax({
            url:"Ads_slider_manage/select_slider_ads.php",
            method:"GET",
            dataType:'JSON',
            success:function(data){
                if(data)
                    x=data;
                else
                    x="";
                for(i=0;i<x.length;i++)
                {
                    outPut_slider_ads +="<tr class='text-center'>"
                    +"<td>"+data[i].ID_slider_ads+"</td>"+
                    "<td><a class='underline hover:text-yellow-500' href='"+data[i].url_slider_ads+"'>"+data[i].title_slider_ads+"</a></td>"+
                    "<td>"+data[i].date_debut_slider_ads+"</td>"+
                    "<td>"+data[i].date_fin_slider_ads+"</td>"+
                    "<td><img style='width:90px;height:90px;' src='avatar/"+data[i].image_slider_ads+"'></td>"+
                    "<td>"+
                    "<button class='text-red-500 btn-sm btn-edit-slider-ads' data-id-slider-ads='"+data[i].ID_slider_ads +"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                                "d='M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' />"+
                        "</svg>"+
                    "</button>&nbsp;&nbsp; &nbsp; &nbsp;"+
                    "<button class='btn btn-danger btn-sm btn-delete-slider-ads' data-id-slider-ads='"+data[i].ID_slider_ads +"' data-image='"+data[i].image_slider_ads+"'>"+
                        "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6'"+
                            "fill='none' viewBox='0 0 24 24' stroke='currentColor'>"+
                            "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'"+
                            "d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />"+
                        "</svg>"+
                    "</button></td>";
                }
                $("#tbody_slider_ads").html(outPut_slider_ads);
            }
        })
    } 
    select_Data_slider_ads();

    //Delete ads  data
    $("tbody").on('click','.btn-delete-slider-ads',function(){
        if (confirm("Voulez-vous vraiment fait la supprition ?")) {
            
                var id_slider_ads=$(this).attr("data-id-slider-ads");
                //var img_ads=$(this).attr("data-image");
                MyData_del_slider_ads={id_slider_ads:id_slider_ads};
                this_btn_slider_ads=this;
                $.ajax({
                    url:"Ads_slider_manage/delete_slider_ads.php",
                    method:"POST",
                    data:JSON.stringify(MyData_del_slider_ads),
                    success:function(data)
                    {
                        Swal.fire({
                            title: data
                        })
                        console.log(data);
                        $(this_btn_slider_ads).closest("tr").fadeOut("slow");
                    }
                })
            
        }
        return false;
    });


    //Edit slider ads  data
    $("tbody").on('click','.btn-edit-slider-ads',function(){

        var ID_slider_ads=$(this).attr("data-id-slider-ads");

        MyData_prod={ID_slider_ads:ID_slider_ads};
        $.ajax({
            url:"Ads_slider_manage/edit_slider_ads.php",
            method:"POST",
            dataType:"JSON",
            data:JSON.stringify(MyData_prod),
            success:function(data)
            {
                $("#id_slider_ads").val(data.ID_slider_ads );
                $("#titre_slider_ads").val(data.title_slider_ads);
                $("#url_slider_ads").val(data.url_slider_ads);
                $("#date_slider_debut").val(data.date_debut_slider_ads);
                $("#date_slider_fin").val(data.date_fin_slider_ads);
                $("#input_image_slider_ads").val(data.image_slider_ads);
            }
        })
    });


});