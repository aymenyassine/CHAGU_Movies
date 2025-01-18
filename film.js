let radius = 240; // how big of the radius
let autoRotate = true; // auto rotate or not
let rotateSpeed = -60; // unit: seconds/360 degrees
let imgWidth = 120; // width of images (unit: px)
let imgHeight = 170; // height of images (unit: px)

// ===================== start =======================
// animation start after 1000 miliseconds
setTimeout(init, 1000);

let odrag = document.querySelectorAll(".drag-container");
let ospin = document.querySelector(".spin-container");
let aImg = ospin.getElementsByTagName("img");
let aEle = [...aImg];

// Size of images
ospin.style.width = imgWidth + "px";
ospin.style.height = imgHeight + "px";

// Size of ground - depend on radius
let ground = document.querySelector(".ground");
ground.style.width = radius * 3 + "px";
ground.style.height = radius * 3 + "px";

function init(delayTime) {
  for (let i = 0; i < aEle.length; i++) {
    aEle[i].style.transform =
      "rotateY(" +
      i * (360 / aEle.length) +
      "deg) translateZ(" +
      radius +
      "px)";
    aEle[i].style.transition = "transform 1s";
    aEle[i].style.transitionDelay = delayTime || (aEle.length - i) / 4 + "s";
  }
}


let sX,
  sY,
  nX,
  nY,
  desX = 0,
  desY = 0,
  tX = 0,
  tY = 10;

// auto spin
if (autoRotate) {
  let animationName = rotateSpeed > 0 ? "spin" : "spinRevert";
  ospin.style.animation = `${animationName} ${Math.abs(
    rotateSpeed
  )}s infinite linear`;
}



const scrollToTopBtn = document.getElementById('scrollToTopBtnn');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.classList.add('show');
    } else {
        scrollToTopBtn.classList.remove('show');
    }
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
