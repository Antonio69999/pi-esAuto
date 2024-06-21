function openClose() {
  const now = new Date();
  const day = now.getDay();
  const time = now.getHours() * 100 + now.getMinutes(); // make time numeric

  document.querySelectorAll("div").forEach((d) => (d.style.display = "")); // make all divs visible at first

  const closedDot = document.getElementById("closedDot");
  const openDot = document.getElementById("openDot");

  if (
    (day >= 1 &&
      day <= 4 &&
      ((time >= 900 && time <= 1200) || (time >= 1330 && time <= 1800))) || // Mon to Thu
    (day === 5 &&
      ((time >= 900 && time <= 1200) || (time >= 1430 && time <= 1800))) || // Fri
    (day === 6 && time >= 800 && time <= 1200) // Sat
  ) {
    closedDot.style.display = "none";
    openDot.style.display = "inline-block"; // Adjust the display property based on your needs
    document.getElementById("closed").style.display = "none";
    document.getElementById("open").style.display = "inline-block";
  } else {
    openDot.style.display = "none";
    closedDot.style.display = "inline-block"; // Adjust the display property based on your needs
    document.getElementById("open").style.display = "none";
    document.getElementById("closed").style.display = "inline-block";
  }
}

setInterval(openClose, 5000);
openClose();
