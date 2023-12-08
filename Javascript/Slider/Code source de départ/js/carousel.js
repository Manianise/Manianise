'use strict'; // mode strict du javascript

var image = document.querySelectorAll('.img-slide');
var imgVal;
console.log(image.length);
console.log(image[image.length -1].getAttribute('src'));
var thisImg = 2;
var imgArray = [];
var plays = false;
var carousel = new Object();
var indexImg;


imgVal = image.values();
console.log(imgVal);
for(var i=0; i <= image.length; i++) {
        imgVal = image[1].getAttribute('src');
        console.log(imgVal);
    }


function imgToArray() {
    imgArray.forEach(image => {
        
    });
}

// En attendant, le drag and drop carousel

const slider = document.querySelector('.gallery');

let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', e => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', _ => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', _ => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mousemove', e => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const SCROLL_SPEED = 2;
  const walk = (x - startX) * SCROLL_SPEED;
  slider.scrollLeft = scrollLeft - walk;
  console.log(slider.offsetLeft);
  
});
