'use strict';   // Mode strict du JavaScript

/*************************************************************************************************/
/* ****************************************** DONNEES ****************************************** */
/*************************************************************************************************/

// Codes ASCII des touches du clavier.

const TOUCHE_ESPACE = 32;
const TOUCHE_GAUCHE = 39;
const TOUCHE_DROITE = 37;
const TOUCHE_RANDOM = 82;


var image = document.querySelector('#image');
var titre = document.querySelector('#titre');
var nowImage = 2;
var Key = new Object();
var isPlaying = false;
var SlideShow = new Object();
var slides = [
{image: 'images/1.jpg', legend: 'Street Art'},
{image: 'images/2.jpg', legend: 'Great Bridge'},
{image: 'images/3.jpg', legend: 'Colorful Building'},
{image: 'images/4.jpg', legend: 'Night Life'},
{image: 'images/5.jpg', legend: 'City Lights'},
{image: 'images/6.jpg', legend: 'Paris Eve'},
]
// Objet contenant l'état du carrousel.
console.log(slides);
var state;


/*************************************************************************************************/
/* ***************************************** FONCTIONS ***************************************** */
/*************************************************************************************************/
function getImg(nowImage) {
	image.src = slides[nowImage].image;
	titre.textContent = slides[nowImage].legend;
}
// function changeImg(dir) {
// 	nowImage += dir;

// 	if(nowImage < 0) {
// 		nowImage = slides.length -1;
// 	}
// 	else if(nowImage > slides.length-1) {
// 		nowImage = 0;
// 	}
// }

// POUR REDUIRE ENCORE PLUS LES LIGNES DE CODE !!
function onClickFade() {
	var fadein = document.querySelector('#image');
	nowImage++;
	fadein.classList.remove('fadein');
	if(nowImage == slides.length) {
		nowImage = 0;
	}
	setTimeout(function(){
	fadein.classList.add('fadein')},1);
}

function onClickFadePrev() {
	var fadein = document.querySelector('#image');
	nowImage--;
	fadein.classList.remove('fadein');
	if(nowImage == slides.length) {
		nowImage = 5;
	}
	setTimeout(function(){
	fadein.classList.add('fadein')},1);
}

function onClick() {
	var buttons = document.querySelector(".toolbar");
	var updown = document.querySelector("#toolbar-toggle .fas");
	buttons.classList.toggle("hidden");
	updown.classList.toggle("fa-arrow-down");
	updown.classList.toggle("fa-arrow-up");
	console.log(buttons);
}

function onClickNext() {
	nowImage++;
	if(nowImage > (slides.length-1)) {
		nowImage = 0;
	}
	getImg(nowImage);
}

function onClickPrev() {
	nowImage--;
	if(nowImage < 0) {
		nowImage = 5;
	}
	getImg(nowImage);
}

function onClickPlay() {
	var PlayStop = document.querySelector('#sliderPlay .fas');
	PlayStop.classList.toggle('fa-stop');
	if(isPlaying) {
		isPlaying = false;
		clearInterval(SlideShow.Interval);
		clearInterval(SlideShow.Fade);
	}
	else {
		isPlaying = true;
		SlideShow.Interval = window.setInterval(onClickNext,1000);
		SlideShow.Fade = window.setInterval(onClickFade,1000);
	}
}
function onClickRan() {
	do  {
		var i = Math.round(Math.random()*(slides.length -1));
	} while (i == nowImage);
	nowImage = i;
	console.log(slides[nowImage]);
	getImg(nowImage);
}


function keyWork(e) {
	switch(e.keyCode) {
		case TOUCHE_ESPACE :
			onClickPlay();
			break;
		case TOUCHE_DROITE :
			onClickNext();
			break;
		case TOUCHE_GAUCHE :
			onClickPrev();
			break;
		case TOUCHE_RANDOM :
			onClickRan();
			break;		
	}
}



/*************************************************************************************************/
/* ************************************** CODE PRINCIPAL *************************************** */
/*************************************************************************************************/

document.addEventListener('DOMContentLoaded', function(){
InstallEventHandler('#toolbar-toggle','click',onClick);
InstallEventHandler("#sliderPrevious",'click',onClickPrev);
InstallEventHandler("#sliderPlay",'click',onClickPlay);
InstallEventHandler("#sliderNext",'click',onClickNext);
InstallEventHandler("#sliderRandom",'click',onClickRan);
InstallEventHandler("#sliderNext",'click',onClickFade);
InstallEventHandler("#sliderPrevious",'click',onClickFadePrev);
window.addEventListener('keydown', keyWork);
})