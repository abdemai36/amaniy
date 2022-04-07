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

var GT=0;
var res=0;
var qnt =document.getElementsByClassName("qntity");
var iprice =document.getElementsByClassName("iprice"); 
var itotal =document.getElementsByClassName("itotal"); 
var input_Gtotal = document.getElementById("input_Gtotal");
var Gtotal = document.getElementById("Gtotal");

function subtotal(){
    GT=0;
    for(var i=0;i<iprice.length;i++){
        res=(iprice[i].value)*(qnt[i].value);
        itotal[i].innerText=res.toFixed(2);
        itotal[i].innerText+="د.م";
        GT=GT+(iprice[i].value)*(qnt[i].value);
    }
    Gtotal.innerText=GT.toFixed(2);
    input_Gtotal.value=GT.toFixed(2);
    Gtotal.innerText+="د.م";
}
//subtotal();



