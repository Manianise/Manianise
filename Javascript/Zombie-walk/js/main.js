let zombie = document.getElementById('zombie-img');
let movement = document.getElementById('move-box');
let canvas = document.getElementById('canvas');
const incr = 30;


setTimeout(() => {
    zombie.classList.add('img-timer');
}, 1000);

window.onload = function() {
    movement.style.position = 'relative';
    movement.style.left = '60px';
    movement.style.top = '60px';
}

window.onkeydown = function(e) {
    let key = e.key;
    switch (key) {
        case 'ArrowUp' :
            if ( parseInt(movement.style.top) <= 30) {
                break;
            }
            else {
                movement.style.top = parseInt(movement.style.top) - incr + 'px';
            }
            break;
        case 'ArrowDown' :
            if (parseInt(movement.style.top) >= canvas.offsetHeight - 150 ) {
                break;
            }
            else {
                movement.style.top = parseInt(movement.style.top) + incr + 'px';
            }
            break;
        
        case 'ArrowLeft' :
            movement.style.transform = 'scaleX(1)';
            if ( movement.style.left <= '0px' ) {

                break;
            }
            else {
                movement.style.left = parseInt(movement.style.left) - incr + 'px';
            }            
            
            break;
        
        case 'ArrowRight' :
            movement.style.transform = 'scaleX(-1)';
            if ( parseInt(movement.style.left) >= canvas.offsetWidth - 100) {
                break;
            }
            else {
                movement.style.left = parseInt(movement.style.left) + incr + 'px';
            }
            
            break;
        default : console.log(key); 
    }
}

