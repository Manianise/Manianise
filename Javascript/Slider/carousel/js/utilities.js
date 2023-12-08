function InstallEventHandler(selector, type, eventHandler, boolean) {
    var domObject = document.querySelector(selector);
    domObject.addEventListener(type, eventHandler, boolean);
}

//callback functions related to screen positionning
// *******************************************************************

function getCtnBounds(selector) {

    let elt = document.querySelector(selector);
    let side = elt.getBoundingClientRect();
    return {left:side.left,top:side.top,right:side.right,bottom:side.bottom};
  
  }
  
function getCtnSize(selector) {
  
    let elt = document.querySelector(selector);
    return {w:elt.clientWidth,h:elt.clientHeight};
  
  }

function getMousePos(e) {

    return {x:e.pageX,y:e.pageY};

  }