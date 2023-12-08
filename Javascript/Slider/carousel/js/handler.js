'use strict'; // mode strict JS (variables doivent être déclarées)

//Handler launcher
// *****************************************************************

document.addEventListener('DOMContentLoaded', function(){
    InstallEventHandler('#btn-left','click',prev, true);
    InstallEventHandler('#btn-right','click', next, true);
    InstallEventHandler('.gallery','touchstart', startTouch, false);
    InstallEventHandler('.gallery','touchmove', moveTouch, false);
    });