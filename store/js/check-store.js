// 
$("#Form_store").on("submit",function(e)
{   
   
    var username=$("#username").val();
    var email=$("#email").val();
    var pwd=$("#pwd").val();
    var repeat_pwd=$("#repeat-pwd").val();
    var phone=$("#phone").val();
    var name_store=$("#name-store").val();
    var description=$("#description").val();
    var image_store=$("#image_store")[0].files;
    
    $.ajax({
        type: "POST",
        url: "check_vailability.php",
        data: new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        beforeSend: function(){
            $(".btn-create").html("جاري الانشاء...");
             e.preventDefault();
        },
        success: function (response) {
            if(response.indexOf('success')>=0){

                $("#check-message").html(response);
            }
            
            $("#check-message").html(response);
        },
        complete: function(){
            //window.location.href="https://amaniy.devsoltech.com/store/login";
            $("#redi").removeClass("hidden");
            $(".btn-create").addClass("hidden");
        }
        
    });
});





