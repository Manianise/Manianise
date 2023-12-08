'Use Strict'

// var canvas = document.createElement("canvas");
// var ctx = canvas.getContext("2d");
// canvas.width = 1220;
// canvas.height = 720;
// ctx.beginPath();
// ctx.fillStyle = "green";
// ctx.fillRect(10, 10, 100, 100);

// document.body.appendChild(canvas);

// console.log(ctx);

class Particle {
    constructor(x,y,color) {
        this.x = x;
        this.y = y;
        this.color = color;
        // this.spd = Math.random() * 5;
        this.spd = 5;
        this.dir = Math.random() * 2 * Math.PI;
        this.vx = Math.cos(this.dir) * this.spd;
        this.vy = Math.sin(this.dir) * this.spd;
        this.lifeSpan = 100;

    }
    move() {
        this.x += this.vx;
        this.vy += 0.0918;
        this.y += this.vy;
        // if (this.x >= window.innerWidth || this.x <= 0) {
        //     this.dir = Math.PI - this.dir;
        //     this.vx = Math.cos(this.dir) * this.spd;
        // }
        // if (this.y >= window.innerHeight || this.y <= 0) {
        //     this.dir = 2 * Math.PI - this.dir;
        //     this.vy = Math.sin(this.dir) * this.spd;
        // }

    }

}

class Canvas {
	constructor() {
        this.btn = document.getElementById("btn");
        this.elt = document.getElementById("bg");
        this.elt.width = window.innerWidth;
        this.elt.height = window.innerHeight;
        this.ctx = this.elt.getContext('2d');

        this.tabParticles = [];
        this.nbParticles = Math.floor(Math.random() * 200 + 100);


        this.elt.addEventListener('click', this.souris.bind(this));
        this.btn.addEventListener('click', this.souris.bind(this));
        document.body.appendChild( this.elt );


        // setInterval((function () {
        //     let color = 'rgb(' + this.generateColor() + ',' + this.generateColor() + ',' + this.generateColor() + ')';
        //     for (var i = 0; i < this.nbParticles; i++) {
        //         let push = new Particle(510,330,color);
        //         this.tabParticles.push(push);
        //     }
        //   }).bind(this), 2000);

        this.update();
    }

    generateColor(offset = 30) {
        return Math.floor(Math.random() * (255 - offset)) + offset
    }

    souris (event) {
        let x = event.clientX;
        let y = event.clientY;
        let color = 'rgb(' + this.generateColor() + ',' + this.generateColor() + ',' + this.generateColor() + ')';

        for (var i = 0; i < this.nbParticles; i++) {
            let push = new Particle(x,y,color);
            this.tabParticles.push(push);
        }
        this.btn.style.display="none";

    }

    render() {

        this.ctx.fillStyle = 'rgb(0, 0, 0, 0.1)';
        this.ctx.fillRect(0, 0, this.elt.width,this.elt.height);
        // this.ctx.clearRect(0, 0, this.elt.width,this.elt.height);
        for(let p of this.tabParticles) {
        this.ctx.beginPath();
        this.ctx.arc(p.x, p.y, 2, 0, 2 * Math.PI);
        this.ctx.closePath();
        this.ctx.fillStyle = p.color;
        this.ctx.fill();
        }
        // this.ctx.fillStyle = 'rgb(170,170,15)';
        // this.ctx.fillRect(x-10,y-10, 15,15);
    }


    update() {

    for(let p = 0 ; p < this.tabParticles.length; p++) {
        this.tabParticles[p].move();
        this.tabParticles[p].lifeSpan--;
        if (this.tabParticles[p].lifeSpan <= 0) {
            this.tabParticles.splice(p,1);
        }

    }
    this.render();
    requestAnimationFrame(this.update.bind(this));
    }

}


class App {
	constructor( name ){
    	this.name = name;

        this.canvas = new Canvas();

    }
}

let app = new App( "Fireworks" );
