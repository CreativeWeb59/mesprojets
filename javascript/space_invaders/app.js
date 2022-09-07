const world = document.querySelector('#gameBoard');
const c = world.getContext('2d');

// Ajout taille de l'alien pour gestion du tir
const wAlien = 32;
const hAlien = 32;

// Ajout pour déplacer vers le bas les aliens
const posAlienY = 100;


// Ajout pour l'image de l'ennemi :
const enemyLeft = './images/alien8g.png';
const enemyRight = './images/alien8.png';
var dirEnnemy = 'right';

// Ajout pour les points
var points = 0;
var incrPpoint = 10;

// Ajout pour la difficulté
var level = 1;
var speedEnnemy = 1;

world.width = world.clientWidth;
world.height = world.clientHeight;

let frames=0;
const keys = {
    ArrowLeft:{pressed:false},
    ArrowRight:{pressed:false},
    fired:{ pressed:false}
}

class Player{
    constructor(){
        this.velocity={
            x:0, // Vitesse de déplacement sur l'axe des X
            y:0 // Vitesse de déplacement sur l'axe des Y
        }
        const image= new Image();
        image.src = './images/pluto.png';
        image.onload =()=>{
            this.image = image;
            this.width=48; // Largeur du vaisseau
            this.height=48; // Hauteur du vaisseau
            this.position={
                x:world.width/2 - this.width/2, // Position sur l'axe des x
                y:world.height - this.height -10 // Position sur l'axe des Y
            }
           
        }
    }

    draw(){
        c.drawImage(this.image,
            this.position.x,
            this.position.y,
            this.width,
            this.height
        );
    }

    shoot(){
        missiles.push(new Missile({
            position:{
                x:this.position.x + this.width/2,
                y:this.position.y
            },
            
        }));
    }
  
   update(){
        if(this.image){
            if(keys.ArrowLeft.pressed && this.position.x >=0){
            this.velocity.x = -5;
        }
        else if(keys.ArrowRight.pressed && this.position.x <= world.width - this.width){
            this.velocity.x = 5;
        }
        else{this.velocity.x =0;}
        this.position.x += this.velocity.x;
        this.draw();
        }
    }
} 
class Alien{
    constructor({position}){
        this.velocity={x:0, y:0 };

        // image direction Droite
        const imgAlienD= new Image();
        imgAlienD.src = enemyRight;
        imgAlienD.onload =()=>{
            this.imgAlienD = imgAlienD;
            this.width=wAlien;
            this.height=hAlien;
            this.position= {
                x:position.x,
                y:position.y+posAlienY // Ajout pour déplacer vers le bas les aliens
            }
        }
        // image direction Gauche
        const imgAlienG= new Image();
        imgAlienG.src = enemyLeft;
        imgAlienG.onload =()=>{
            this.imgAlienG = imgAlienG;
            this.width=wAlien;
            this.height=hAlien;
            this.position= {
                x:position.x,
                y:position.y+posAlienY // Ajout pour déplacer vers le bas les aliens
            }
        }
    }
    draw(){
        
        if (dirEnnemy == 'right'){
            if(this.imgAlienD){
                c.drawImage(this.imgAlienD,this.position.x,this.position.y,this.width,this.height,);       
            }
        } else {
            if(this.imgAlienG){
                c.drawImage(this.imgAlienG,this.position.x,this.position.y,this.width,this.height,);       
            }
        }
    }
        
    update({velocity}){
        if(this.imgAlienD){
        this.position.x += velocity.x;
        this.position.y += velocity.y;
        if(this.position.y + this.height >= world.height){
            console.log('You loose - votre score : '+points);
            points = 0;
        }
        }
        this.draw();
    }
    shoot(alienMissiles){
        if(this.position){
            alienMissiles.push(new alienMissile({
                position:{
                    x:this.position.x,
                    y:this.position.y
                },
                velocity:{
                    x:0,
                    y:3
                }
            }))
        }
    }
}

class Missile{
    constructor({position}){
        this.position = position;
        this.velocity ={x:0,y:-5} ;
        this.width = 5;
        this.height =10;
    }
    draw(){
        c.save();
        c.fillStyle='white';
        c.fillRect(this.position.x,this.position.y,this.width,this.height)
       c.fill()
    c.restore()
      
   
    }
    update(){
        this.position.y += this.velocity.y;
        this.draw();
    }
} 
class Grid{
    constructor(){
        this.position={ x:0,y:0}

        // calcul de la vitesse des ennemies par rapport au level de la partie
        if (level<5){
            speedEnnemy = speedEnnemy;
        } else if (level >= 5 && level < 10) {
            speedEnnemy = speedEnnemy +1 ;
        } else if (level >= 10 && level < 15) {
            speedEnnemy = speedEnnemy +2 ;
        }

        this.velocity={x:speedEnnemy,y:0}
        this.invaders = [ ]
        
        // Gestion du nombre d'alliens en ligne et en colonne
        // let rows = Math.floor((world.height/(hAlien + 2))*(3/5));
        // const colums = Math.floor((world.width/(wAlien + 2))*(2 /5));

        let rows = 4 + level;
        let colums = 9 + level;

        this.height=rows*(hAlien + 2);
        this.width = colums *(wAlien + 2);
        for (let x=0;x<colums;x++){
			for(let y =0;y<rows;y++){
                this.invaders.push(new Alien({
                    position:{
                        x:x * (wAlien + 2),
                        y:y * (hAlien + 2)
                    }
                }))
            }
        }
    }
    update(){
        this.position.x += this.velocity.x;
        this.position.y += this.velocity.y;
        this.velocity.y =0;
        if(this.position.x + this.width  >= world.width || this.position.x == 0){
            this.velocity.x = -this.velocity.x ;
            this.velocity.y = wAlien +2;
            //switch de l'image içi
            dirEnnemy = dirEnnemy == 'right' ? 'left' : 'right';
        }
        
        
    }
}
class Particule{
    constructor({position,velocity,radius,color}){
        this.position = position
        this.velocity = velocity
        this.radius = radius
        this.color = color
        this.opacity = 1
    }
    draw(){
        c.save();
        c.globalAlpha = this.opacity;                         
        c.beginPath();
        c.fillStyle=this.color;
        c.arc(this.position.x,this.position.y, this.radius,0,Math.PI *2)
        c.fill()
        c.closePath()
        c.restore();
    }
    update(){
        this.position.x += this.velocity.x;
        this.position.y += this.velocity.y;
        if(this.opacity > 0){
            this.opacity -=0.01;
        }
        this.draw()
    }
 }

class alienMissile{
    constructor({position,velocity}){
        this.position = position;
        this.velocity = velocity;
        this.width = 5;
        this.height =10;
    }
    draw(){
        c.save();
        c.fillStyle='red';
        c.fillRect(this.position.x + (wAlien/2),this.position.y+hAlien,this.width,this.height)
        c.fill()
        c.restore()
    }
    update(){
        this.draw()
        this.position.x += this.velocity.x;
        this.position.y += this.velocity.y;
    }
}

// Tableau d'affichage
class Textetitre{
    constructor(){
        this.position={ x:240,y:20}
    }
    draw(){
        c.save();
        c.font = "16pt Calibri,Geneva,Arial";
        c.fillStyle='white';
        c.fillText("Points : "+points+" 💪", world.width - this.position.x, this.position.y);
        c.fillText("Vies : "+lifes+" ❤️", world.width - this.position.x, this.position.y + 30);
        c.fillText("Level : "+level+" ⚔️", world.width - this.position.x, this.position.y + 60);
        c.fill()
        c.restore()
    }
    update(){
        this.draw();
    }
}

let missiles ;
let alienMissiles; 
let grids;
let player; 
let particules;
let lifes;
let textetitre;

const init =()=>{
    missiles =[] ;
    alienMissiles= []; 
    grids  = [new Grid()];
    player= new Player(); 
    particules=[];
    lifes =3;
    keys.ArrowLeft.pressed = false;
    keys.ArrowRight.pressed = false;
    keys.fired.pressed = false;
    textetitre= new Textetitre;
    points = 0;
    level = 1;
    speedEnnemy = 1;
    dirEnnemy = 'right';
}

init();
   

const animationLoop= ()=>{
    c.clearRect(0,0,world.width,world.height);
    player.update();
    textetitre.update();
    requestAnimationFrame(animationLoop);
    
    missiles.forEach((missile,index) =>{
        if(missile.position.y + missile.height <=0) { 
            setTimeout(() =>{
                missiles.splice(index,1)} 
				,0)}
        else{missile.update();}
    }) 
    grids.forEach((grid,indexGrid) =>{
        grid.update();
        if(frames %50 ===0 && grid.invaders.length >0){
            grid.invaders[Math.floor(Math.random()*(grid.invaders.length))].shoot(alienMissiles)
        }
        grid.invaders.forEach((invader,indexI)=>{
            invader.update({velocity:grid.velocity});
            missiles.forEach((missile,indexM)=>{
                if(missile.position.y  <=  invader.position.y + invader.height &&
                   missile.position.y  >=  invader.position.y  &&
                   missile.position.x + missile.width >= invader.position.x &&
                   missile.position.x - missile.width <= invader.position.x + invader.width){
                    for(let i=0; i <12;i++){
                        particules.push(new Particule({
                            position:{
                                x:invader.position.x + invader.width/2,
                                y:invader.position.y + invader.height/2
                            },
                            velocity:{x:(Math.random()-0.5)*2,y:(Math.random()-0.5)*2},
                            radius:Math.random()*5+1,
                            color:'red'
                        }))
                    }
                    // Alien tué incrementation du score :
                    points = points + incrPpoint;

                setTimeout(()=>{
                    grid.invaders.splice(indexI,1);
                       
                    missiles.splice(indexM,1)
                    if(grid.invaders.length === 0 && grids.length ==1 ){
                        grids.splice(indexGrid,1);
                        
                        setTimeout(()=>{
                            level++ ; // grille finie / incrementation du niveau
                            grids.push(new Grid());
                            console.log (level);
                        },5000)
                    }
                },0)
                }
            })
        })
      
    })
    alienMissiles.forEach((alienMissile,index) =>{
        if(alienMissile.position.y + alienMissile.height >=world.height){ 
            setTimeout(() =>{
                alienMissiles.splice(index,1)} ,0);
                    
            }
        else{alienMissile.update();}
        if(alienMissile.position.y + alienMissile.height >= player.position.y  && 
            alienMissile.position.y  <= player.position.y +player.height  && 
            alienMissile.position.x  >= player.position.x  && 
            alienMissile.position.x + alienMissile.width <= player.position.x + player.width){
            alienMissiles.splice(index,1);
                for(let i=0; i <22;i++){
                    particules.push(new Particule({
                        position:{
                            x:player.position.x + player.width/2,
                            y:player.position.y + player.height/2
                        },
                        velocity:{x:(Math.random()-0.5)*2,y:(Math.random()-0.5)*2},
                        radius:Math.random()*5,
                        color:'white'
                    }))
                }
                lostLife();
            }
        }) 

    particules.forEach((particule,index)=>{
        if(particule.opacity <=0){
            particules.splice(index,1)
        }else{
            particule.update();
        }
    }) 

    
    
 frames++;
}

animationLoop();

const  lostLife= ()=>{
    lifes--;
    if(lifes <= 0 ){
        alert('perdu\nvotre score : '+points+' points');
        init();
    }
}

addEventListener('keydown',(event)=>{
    switch(event.key){
        case 'ArrowLeft':
            keys.ArrowLeft.pressed = true;
        break;
        case 'ArrowRight':
            keys.ArrowRight.pressed = true;
        break;
    } 
})    
 
addEventListener('keyup',(event)=>{
    switch(event.key){
        case 'ArrowLeft':
            keys.ArrowLeft.pressed = false;
        break;
        case 'ArrowRight':
            keys.ArrowRight.pressed = false;
        break;
        case ' ':
            player.shoot();
        break;
    }
})



