var sideelm = document.querySelector(".side");
var side = 1;

if (localStorage.getItem("sidemenu") == 1) {
  document.getElementById("sidebar").classList.add("ciut");
  sideelm.classList.add("ciut");
} else {
  document.getElementById("sidebar").classList.remove("ciut");
  sideelm.classList.remove("ciut");
}

function openNav() {
  // Set Item

  if (localStorage.getItem("sidemenu") == 1) {
    localStorage.setItem("sidemenu", 0);
    document.getElementById("sidebar").classList.add("ciut");
    sideelm.classList.add("ciut");
  } else {
    localStorage.setItem("sidemenu", 1);
    document.getElementById("sidebar").classList.remove("ciut");
    sideelm.classList.remove("ciut");
  }
}
