let btn_call_registraction = document.getElementById('btn_call_register');
let btn_call_login = document.getElementById('btn_call_login');




 btn_call_login.addEventListener("click", () =>{
     header("Location:authapp.php");
     alert("hello");
 })
 btn_call_registraction.addEventListener("click", () =>{
   header("Location:register.php");
    alert("hello");
 })




