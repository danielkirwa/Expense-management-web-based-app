let btn_call_registraction = document.getElementById('btn_call_register');
let btn_call_login = document.getElementById('btn_call_login');

let register_page = document.getElementById('registration_form');
let login_page = document.getElementById('login_form');

let visiblePage = 1;
 
 localStorage.setItem('visiblePageNumber',1);

 function ManagePages(argument) {
   // body...
   let activePage = localStorage.getItem('visiblePageNumber')
   if (activePage == visiblePage) {
    register_page.style.display = "none";
    login_page.style.display = "block";

   }else{
    login_page.style.display = "none";
    register_page.style.display = "block";
   }
 }
 btn_call_login.addEventListener("click", () =>{
  localStorage.setItem('visiblePageNumber',1);
  ManagePages();
 })
 btn_call_registraction.addEventListener("click", () =>{
  localStorage.setItem('visiblePageNumber',2);
   ManagePages();
 })




 ManagePages();