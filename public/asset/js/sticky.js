const nav = document.querySelector("nav");
const title = document.querySelector("h1");
const logo = document.querySelector(".logo");
const tel = document.querySelector(".tel");
const header = document.querySelector("header");
const statu = document.querySelector(".status");

window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    nav.classList.add("navtop");
    title.classList.add("titletop");
    logo.classList.add("logotop");
    tel.classList.add("teltop");
    statu.classList.add("statustop");
    header.style.height = "120px";
  } else {
    nav.classList.remove("navtop");
    title.classList.remove("titletop");
    logo.classList.remove("logotop");
    tel.classList.remove("teltop");
    statu.classList.remove("statustop");
    header.style.height = "150px";
  }
});