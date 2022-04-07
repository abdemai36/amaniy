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



    //model livreur
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




    //select data main model datails order store
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



//create form input image
const fileInput = document.querySelector(".file-input");
var fileShow = document.querySelector(".fileName")
fileInput.onchange = ({ target }) => {
    let file = target.files[0];
    fileShow.innerHTML=file.name;

    // if (file) {
    //     let fileName = file.name;
    //     if (fileName.length >= 20) {
    //         let splitName = fileName.split('.');
    //         fileName = splitName[0].substring(0, 21) + "... ." + splitName[1];
    //         fileShow.innerHTML = fileName;
    //     }

    // }
}








