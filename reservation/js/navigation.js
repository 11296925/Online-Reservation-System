function openNav() {
  // Animate navigation opening
  document.getElementById("navbar").style.width = "15em";
  document.getElementById("navbar").style.overflowX = "visible";
}

function closeNav() {
  // Animate navigation closing
  document.getElementById("navbar").style.width = "0";
  document.getElementById("navbar").style.overflowX = "hidden";
}
