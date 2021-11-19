let popupanalysis = document.querySelector('.scroll-analysis');
let closeanalysis = document.getElementById('btncloseanalysis');
let blurdashboard = document.querySelector('.main-dashboard');
let analyticTitel = document.querySelector('.analytic-titel');



// pop up analysis

let popbill = document.getElementById('billsbtn');
popbill.addEventListener('click' , ()=>{
  openanalytic("BILLS  ");
 createPieChart();
 createBarGraph();
 createBarGraphrReport();
})
let popshopping = document.getElementById('shoppingbtn');
popshopping.addEventListener('click' , ()=>{
  openanalytic("SHOPPING ");
 createPieChart();
 createBarGraph();
 createBarGraphrReport();
})
let popsaving = document.getElementById('savingbtn');
popsaving.addEventListener('click' , ()=>{
  openanalytic("SAVING  ");
 createPieChart();
 createBarGraph();
 createBarGraphrReport();
})
let popemergency = document.getElementById('emergencybtn')
popemergency.addEventListener('click' , ()=>{
  openanalytic("EMERGENCY ");
 createPieChart();
 createBarGraph();
 createBarGraphrReport();
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