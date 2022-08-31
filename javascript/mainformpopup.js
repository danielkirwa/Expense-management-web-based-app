let popupanalysis = document.querySelector('.scroll-analysis');
let closeanalysis = document.getElementById('btncloseanalysis');
let blurdashboard = document.querySelector('.main-dashboard');
let analyticTitel = document.querySelector('.analytic-titel');



// pop up analysis

let popbill = document.getElementById('billsbtn');
popbill.addEventListener('click' , ()=>{
location.href = "bill.php";
})
let popshopping = document.getElementById('shoppingbtn');
popshopping.addEventListener('click' , ()=>{
location.href = "shopping.php";
})
let popsaving = document.getElementById('savingbtn');
popsaving.addEventListener('click' , ()=>{
location.href = "saving.php";
})

closeanalysis.addEventListener('click' , () =>{
 closeanalytic();
})

function openanalytic(unit) {
  // body...
  popupanalysis.style.display = "block";
  blurdashboard.style.opacity = "0.4";
  analyticTitel.innerHTML = unit + "Analysis";
}
function closeanalytic() {
  // body...
  popupanalysis.style.display = "none";
  blurdashboard.style.opacity = "1";
}