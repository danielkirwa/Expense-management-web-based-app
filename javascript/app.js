const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#tour-btn");
const container = document.querySelector(".container");
const btn_login = document.getElementById('btn-login');

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
btn_login.addEventListener("click", () => {
  window.location.href='admincontrol.html';
});