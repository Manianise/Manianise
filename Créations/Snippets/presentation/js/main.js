// JS related to 






// JS related to Carousel
// *************************************************************************

var dotCtn = document.createElement('div');
var carouselBox = document.querySelector('.carousel-boxing');
var gallery = document.querySelector('.gallery');
var arrayFromNodeList = Array.from(document.querySelectorAll('.img-slide'));
let img = 0;


//On veut que toutes les images sauf la première soient cachées et
// créer le nombre d'éléments appropriés et autres actions mineures
// ************************************************************

dotCtn.classList.add('dot-container');
carouselBox.appendChild(dotCtn);

for (let i = 0; i < arrayFromNodeList.length; i++) {
  var dot = document.createElement('div');
  dot.classList.add('dot-style');
  dotCtn.appendChild(dot);
  
}

var arrayFromDots = Array.from(document.querySelectorAll('.dot-style'));
arrayFromDots[0].classList.add('bg-selected');

// functions qui permettent de gérer le slide sélectionné
// ***************************************************************


function changeSlide(moveTo) {

  arrayFromDots[img].classList.toggle("bg-selected");
  arrayFromDots[moveTo].classList.toggle("bg-selected");  
  
  img = moveTo;
}

// foreach pour que les points soient cliquables 
// *******************************************************************

arrayFromDots.forEach((bullet, bulletIndex) => {
  bullet.onclick =  () => {
      if (img !== bulletIndex) {
          changeSlide(bulletIndex);
      }
      gallery.style.transform = `translateX(${bulletIndex * -100}%)`;
  }
})

// events sur les boutons

function next() {
  img++

  if (img > arrayFromDots.length - 1) {
    img = arrayFromDots.length - 1;
  } else {
  gallery.style.transform = `translateX(${img * -100}%)`
  arrayFromDots[img].classList.toggle("bg-selected");
  arrayFromDots[img - 1].classList.toggle("bg-selected");  
  }
}

function prev() {
  img--

  if (img < 0) {
    img = 0;
  } else {
    gallery.style.transform = `translateX(${img * -100}%)`
    arrayFromDots[img].classList.toggle("bg-selected");
    arrayFromDots[img + 1].classList.toggle("bg-selected"); 
  }
}

setInterval(next, 30000);

// Carousel swipe 
// Swipe Up / Down / Left / Right
// *******************************************************************************
 
var initialX = null;
var initialY = null;

function startTouch(e) {
  initialX = e.touches[0].clientX;
  initialY = e.touches[0].clientY;
};
 
function moveTouch(e) {
  if (initialX === null) {
    return;
  }
 
  if (initialY === null) {
    return;
  }
 
  var currentX = e.touches[0].clientX;
  var currentY = e.touches[0].clientY;
 
  var diffX = initialX - currentX;
  var diffY = initialY - currentY;
 
  if (Math.abs(diffX) > Math.abs(diffY)) {
    // sliding horizontally
    if (diffX > 0) {
      // swiped left
      next();
    } else {
      // swiped right
      prev();
    }  
  }
 
  initialX = null;
  initialY = null;
   
  e.preventDefault();
};


