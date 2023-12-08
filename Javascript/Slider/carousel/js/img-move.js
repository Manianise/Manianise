
// Functions on mouseEvents
//*************************************************** */

function imgMove(e, selector) {

    let pos = getMousePos(e);
    let elt = document.querySelector(selector);
    let valueX = (pos.x * -1 / 50);
    let valueY = (pos.y * -1 / 50);
  
    elt.style.position = "relative";
    elt.style.left = valueX + "px";
    elt.style.top = valueY + "px";
  
  }

function imgSideSmoothMvt(e, selector, selectorImg) {

    // find the necessary coordinates of container
    // *************************************************
    let pos = getMousePos(e);
    let size = getCtnSize(selector);
    let ctnBounds = getCtnBounds(selector);

    // Find the image that needs to receive holy js
    // *************************************************
    let img = document.querySelector(selectorImg);
    let container = document.querySelector(selector);

    // Add necessary css that wouldnt make it work otherwise
    // **************************************************

    // on Image
    img.style.scale = '1.5';
    img.style.transition = 'transform 0.7s ease-in-out';
    // on Container
    container.style.overflow = 'hidden';

    // image move left and right
  if(pos.x < ctnBounds.left + (size.w/5)) {
    img.style.transform = 'translateX(5%)';
  } else if(pos.x > (size.w + ctnBounds.left) - (size.w/5)) {
    img.style.transform = 'translateX(-5%)';
  } else {
    img.style.removeProperty('transform');
  }

}

function imgVerticalSmoothMvt(e, selector, selectorImg) {

    // find the necessary coordinates of container
    // *************************************************
    let pos = getMousePos(e);
    let size = getCtnSize(selector);
    let ctnBounds = getCtnBounds(selector);

    // Find the image that needs to receive holy js
    // *************************************************
    let img = document.querySelector(selectorImg);
    let container = document.querySelector(selector);

    // Add necessary css that wouldnt make it work otherwise
    // **************************************************

    // on Image
    img.style.scale = '1.5';
    img.style.transition = 'transform 0.7s ease-in-out';
    // on Container
    container.style.overflow = 'hidden';

    //  image move up and down
  if(pos.y < ctnBounds.top + (size.h/5)) {
    img.style.transform = 'translateY(5%)';
  } else if(pos.y > (size.h + ctnBounds.top) - (size.h/5)) {
    img.style.transform = 'translateY(-5%)';
  }
  else {
    img.style.removeProperty('transform');
  }
}

