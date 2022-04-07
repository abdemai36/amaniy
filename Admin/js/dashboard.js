const modal = document.querySelector('.main-modal');
const closeButton = document.querySelectorAll('.modal-close');

const modalClose = () => {
    modal.classList.remove('fadeIn');
    modal.classList.add('fadeOut');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
}

const openModal = () => {
    modal.classList.remove('fadeOut');
    modal.classList.add('fadeIn');
    modal.style.display = 'flex';
}

for (let i = 0; i < closeButton.length; i++) {

    const elements = closeButton[i];

    elements.onclick = (e) => modalClose();

    modal.style.display = 'none';

    window.onclick = function (event) {
        if (event.target == modal) modalClose();
    }
}


function simpleToast() {
    var x = document.getElementById("simpleToast");
    x.className = "show";
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
}




$.sidebarMenu = function (menu) {
    var animationSpeed = 300;

    $(menu).on('click', 'li a', function (e) {
        var $this = $(this);
        var checkElement = $this.next();

        if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
            checkElement.slideUp(animationSpeed, function () {
                checkElement.removeClass('menu-open');
            });
            checkElement.parent("li").removeClass("active");
        }

        //If the menu is not visible
        else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
            //Get the parent menu
            var parent = $this.parents('ul').first();
            //Close all open menus within the parent
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            //Remove the menu-open class from the parent
            ul.removeClass('menu-open');
            //Get the parent li
            var parent_li = $this.parent("li");

            //Open the target menu and add the menu-open class
            checkElement.slideDown(animationSpeed, function () {
                //Add the class active to the parent li
                checkElement.addClass('menu-open');
                parent.find('li.active').removeClass('active');
                parent_li.addClass('active');
            });
        }
        //if this isn't a link, prevent the page from being redirected
        if (checkElement.is('.treeview-menu')) {
            e.preventDefault();
        }
    });
}

$.sidebarMenu($('.sidebar-menu'))

$(".tbody").on("click",function(e){
    if(e.target.className ==="detail bg-green-400 p-3 text-white rounded"){
        var id= $(e.target).attr("data-id");
        var username= $(e.target).attr("data-username");
        var phone= $(e.target).attr("data-phone");
        var ville= $(e.target).attr("data-ville");
        var addresse= $(e.target).attr("data-addresse");
        var date= $(e.target).attr("data-date");
        var nameProduct = $(e.target).attr("data-nameProduct");
        var qnt = $(e.target).attr("data-qnt");
        var Price = $(e.target).attr("data-Price");
        var totalPrice = $(e.target).attr("data-totalPrice");
        var globalPrice = $(e.target).attr("data-globalPrice");

        $(".main-modal .model-date").text(date);
        $(".main-modal .model-id").text(id);
        $(".main-modal .model-ville").text(ville);
        $(".main-modal .model-addresse").text(addresse);
        $(".main-modal .model-phone").text(phone);
        $(".main-modal .model-username").text(username);
        $(".main-modal .model-nameProduct").html('<div class="text-sm text-gray-900 ">'+nameProduct+'</div>');
        $(".main-modal .model-qnt").html('<div class="text-sm text-gray-900 ">'+qnt+'</div>');
        $(".main-modal .model-Price").html('<div class="text-sm text-gray-900 ">'+Price+'</div>');
        $(".main-modal .model-totalPrice").html('<div class="text-sm text-gray-900 ">'+totalPrice+'</div>');
        $(".main-modal .model-globalPrice").text(globalPrice);
    }
});


//selection page with position
$(document).ready(function () {
    $("#page").click(function () {
        var val = $(this).val();
        if (val == "Accueil") {
            $("#position_ads").html("<option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option>");
        } else if (val == "liste produit") {
            $("#position_ads").html("<option value='1'>1</option>");
        } 
    });
});

//pagination table livreur
var table="#table_livreur";
$(".mawRow").on('change',function(){
    $(".pagination").html();
    var trnum=0;
    var maxRow=parseInt($(this).val());
    var totalRow =$(table +' tbody tr').length;
    $(table+' tr:gt(0)').each(function(){
        trnum++;
        if(trnum>maxRow){
            $(this).hide();
        }
        if(trnum<=maxRow){
            $(this).show();
        }
    })
    if(totalRow > maxRow){
        
    }

})


const modal2 = document.querySelector('.second-modal');
const closeButton2 = document.querySelectorAll('.modal-close2');

const modalClose2 = () => {
    modal2.classList.remove('fadeIn');
    modal2.classList.add('fadeOut');
    setTimeout(() => {
        modal2.style.display = 'none';
    }, 500);
}

const openModal2 = () => {
    modal2.classList.remove('fadeOut');
    modal2.classList.add('fadeIn');
    modal2.style.display = 'flex';
}

for (let i = 0; i < closeButton.length; i++) {

    const elements = closeButton2[i];

    elements.onclick = (e) => modalClose2();

    modal2.style.display = 'none';

    window.onclick = function (event) {
        if (event.target == modal) modalClose2();
    }
}

//get code of livreur
$(".transfir_code_livreur").on("click",function(){
    var id_order=$(this).attr("data-id");
    $("#id_order").val(id_order);
})

setTimeout(function() {
    $("#msg_success").fadeOut('fast');
}, 2000); // <-- time in milliseconds
$("#msg_success")




function userFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}



function orderFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("orderInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("orderTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[9];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}



function produitFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("produitInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("produitTable");
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
}




function livreurFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("livreurInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("livreurTable");
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
}




function storeFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("storeInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("storeTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}




















