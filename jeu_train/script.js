// Chargement des sons
const WALL_HIT = new Audio('./sound/wall.mp3');
const PADDLE_HIT = new Audio('./sound/paddle_hit.mp3');
const BRICK_HIT = new Audio('./sound/brick_hit.mp3');
const WIN = new Audio('./sound/win.mp3');
const LIFE_LOST = new Audio('./sound/life_lost.mp3');

// Gestion des fenetres du dom
const rules = document.getElementById('rules');
const rulesBtn = document.getElementById('rules-btn');
const razBtn = document.getElementById('raz-btn');
const closeBtn = document.getElementById('close-btn');
const game_over = document.getElementById('game-over');
const restart = game_over.querySelector('#restart');
const leScore = document.querySelector('#leScore');
const containScore = document.querySelector('#contain-score');
//const pseudo =  document.querySelector('#pseudo');
const pseudo = document.getElementById('pseudo');
const jouerBtn = document.querySelector('#jouer-btn');
const ecranStart = document.querySelector('#ecran-start');

// Recuperation du score

if (!localStorage.getItem('gameHighScore1')) localStorage.setItem('gameHighScore1', 0);
if (!localStorage.getItem('gameHighScore2')) localStorage.setItem('gameHighScore2', 0);
if (!localStorage.getItem('gameHighScore3')) localStorage.setItem('gameHighScore3', 0);
if (!localStorage.getItem('gameHighScore4')) localStorage.setItem('gameHighScore4', 0);
if (!localStorage.getItem('gameHighScore5')) localStorage.setItem('gameHighScore5', 0);

if (!localStorage.getItem('gameHighPseudo1')) localStorage.setItem('gameHighPseudo1', 'Inconnu');
if (!localStorage.getItem('gameHighPseudo2')) localStorage.setItem('gameHighPseudo2', 'Inconnu');
if (!localStorage.getItem('gameHighPseudo3')) localStorage.setItem('gameHighPseudo3', 'Inconnu');
if (!localStorage.getItem('gameHighPseudo4')) localStorage.setItem('gameHighPseudo4', 'Inconnu');
if (!localStorage.getItem('gameHighPseudo5')) localStorage.setItem('gameHighPseudo5', 'Inconnu');

var highScoreBoard = [localStorage.getItem('gameHighScore1') || 0,
localStorage.getItem('gameHighScore2') || 0,
localStorage.getItem('gameHighScore3') || 0,
localStorage.getItem('gameHighScore4') || 0,
localStorage.getItem('gameHighScore5') || 0];
var highScorePseudo = [localStorage.getItem('gameHighPseudo1') || 'Inconnu',
localStorage.getItem('gameHighPseudo2') || 'Inconnu',
localStorage.getItem('gameHighPseudo3') || 'Inconnu',
localStorage.getItem('gameHighPseudo4') || 'Inconnu',
localStorage.getItem('gameHighPseudo5') || 'Inconnu'];


/*localStorage.setItem('gameHighScore1', 0);
localStorage.setItem('gameHighScore2', 0);
localStorage.setItem('gameHighScore3', 0);
localStorage.setItem('gameHighScore4', 0);
localStorage.setItem('gameHighScore5', 0);*/

// gestion du pseudo

if (localStorage.getItem('derPseudo')) {
    derPseudo = localStorage.getItem('derPseudo');
} else {
    derPseudo = 'Inconnu';
}

pseudo.value = derPseudo;


document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('canvas1');
    const ctx = canvas.getContext('2d');
    canvas.width = 800;
    canvas.height = 600;

    const frameRatio = 1;

    var points = 0;
    var lives = 3;
    var level = 0;
    var gameOver = false;
    var isPaused = false;

    var stopKeyPress = false;
    var stopCollision = false;

    var numFrame = 0; // sert pour le stop et redemarrage du train

    var heightRoad = [120, 220, 320, 420];
    // const playerPosX = [canvas.width/2 + 40, canvas.width/2 -40, canvas.width/2 -0, canvas.width/2 - 40];
    const playerPosX = [canvas.width / 2, canvas.width / 2 + 20, canvas.width / 2 - 40, canvas.width / 2 - 100, canvas.width / 2 - 60, canvas.width / 2 - 60];
    const playerPosY = [510, 410, 310, 210, 110, 30];

    // gestion difficulte
    const nbVoitures = [2400, 1600, 1300, 1100, 900, 800, 700];
    const vxVoitures = [0.05, 0.07, 0.09, 0.11, 0.13, 0.15, 0.17];

    const keys = {
        ArrowUp: { pressed: false },
        ArrowDown: { pressed: false },
    }

    class Game {
        constructor(ctx, width, height) {
            this.ctx = ctx;
            this.width = width;
            this.height = height;
            this.car = [];
            this.enemyInterval = nbVoitures[0];
            this.enemyTimer = 0;
            this.roadNum = [1, 2, 3, 4];
            this.lastRoad = 0;

            console.log(this.car);
        }

        update(deltaTime) {

            // Gestion difficulté
            if (points >= 500 && points < 1000) this.enemyInterval = nbVoitures[1];
            if (points >= 1000 && points < 1500) this.enemyInterval = nbVoitures[2];
            if (points >= 1500 && points < 2000) this.enemyInterval = nbVoitures[3];
            if (points >= 2000 && points < 2500) this.enemyInterval = nbVoitures[4];
            if (points >= 2500 && points < 3000) this.enemyInterval = nbVoitures[5];
            if (points >= 3000 && points < 3500) this.enemyInterval = nbVoitures[6];

            this.car = this.car.filter(Object => !Object.markedForDeletion);
            if (this.enemyTimer > this.enemyInterval) {
                this.#addCar();
                this.enemyTimer = 0;
                numFrame++;
                console.log(this.car);
            } else {
                this.enemyTimer += deltaTime;
            }
            this.car.forEach(Object => Object.update(deltaTime));
        }

        draw() {
            this.car.forEach(Object => Object.draw(this.ctx));
        }

        #addCar() {
            //aleatoire entre les 4 routes
            const randomEnemy = this.roadNum[Math.floor(Math.random() * this.roadNum.length)];

            switch (randomEnemy) {
                case 1:
                    this.car.push(new Road1(this));
                    break;
                case 2:
                    this.car.push(new Road2(this));
                    break;
                case 3:
                    this.car.push(new Road3(this));
                    break;
                case 4:
                    this.car.push(new Road4(this));
                    break;
                default:
                    console.log('cas defaut');
            }


            // aleatoire entre les 4 routes
            /*
            const randomEnemy = this.roadNum[Math.floor(Math.random() * this.roadNum.length)];
            if (randomEnemy == 1) this.car.push(new Road1(this));
            else if (randomEnemy == 2) this.car.push(new Road2(this));
            else if (randomEnemy == 3) this.car.push(new Road3(this));
            else if (randomEnemy == 4) this.car.push(new Road4(this));
            */

            // cycle sur les 4 routes
            /*
            if (this.lastRoad == 0) this.car.push(new Road1(this));
            else if (this.lastRoad == 1) this.car.push(new Road3(this));
            else if (this.lastRoad == 2) this.car.push(new Road2(this));
            else if (this.lastRoad == 3) this.car.push(new Road4(this));

            if (this.lastRoad == 4) {
                this.car.push(new Road1(this));
                this.lastRoad = 0;
            }
            */
            this.lastRoad++;

        }
    }

    class Car {
        constructor(game) {
            this.game = game;
            this.markedForDeletion = false;
            this.frameX;
            this.maxFrame = 1;
            this.frameInterval = 100;
            this.frameTimer = 0;
            /* vitesse de la voiture
            /*this.vx = Math.random() * 0.1 + 0.1;*/
            this.spriteWidth = 90;
            this.spriteHeight = 60;
            this.width = this.spriteWidth * frameRatio;
            this.height = this.spriteHeight * frameRatio;
            this.x = 0;
            this.y = 100;
            this.NumFrame = Math.floor(Math.random() * (6));
            this.image = carLeft;
            this.vx = vxVoitures[0];
        }
        update(deltaTime) {
            // Gestion difficulté
            if (points >= 500 && points < 1000) this.vx = vxVoitures[1];
            if (points >= 1000 && points < 1500) this.vx = vxVoitures[2];
            if (points >= 1500 && points < 2000) this.vx = vxVoitures[3];
            if (points >= 2000 && points < 2500) this.vx = vxVoitures[4];
            if (points >= 2500 && points < 3000) this.vx = vxVoitures[5];
            if (points >= 3000 && points < 3500) this.vx = vxVoitures[6];

            if (this.frameTimer > this.frameInterval) {
                if (this.frameX < this.maxFrame) this.frameX++
                else this.frameX = 0;
                this.frameTimer = 0;
            } else {
                this.frameTimer += deltaTime;
            }
        }
        draw(ctx) {
            /*ctx.drawImage(this.image,this.spriteWidth*this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);*/
        }
    }

    class Road1 extends Car {
        constructor(game) {
            super(game); // recupere les parametres du parent avec les fonctions update, draw...
            this.x = 0 - this.spriteWidth;
            this.y = heightRoad[0];
        }
        update(deltaTime) {
            if (this.x < player.x + player.width &&
                this.x + this.width > player.x &&
                this.y < player.y + player.height &&
                this.y + this.height > player.y) {
                stopCollision = true;
                console.log('route1');
            }
            this.x += this.vx * deltaTime;
            if (this.x > canvas.width) this.markedForDeletion = true;
            super.update(deltaTime);
        }

        draw(ctx) {
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
        }
    }

    class Road2 extends Car {
        constructor(game) {
            super(game); // recupere les parametres du parent avec les fonctions update, draw...
            this.x = 0 - this.spriteWidth;
            this.y = heightRoad[1];
        }

        update(deltaTime) {
            if (this.x < player.x + player.width &&
                this.x + this.width > player.x &&
                this.y < player.y + player.height &&
                this.y + this.height > player.y) {
                stopCollision = true;
                console.log('route2');
            }
            this.x += this.vx * deltaTime;
            if (this.x > canvas.width) this.markedForDeletion = true;
            super.update(deltaTime);
        }

        draw() {
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
            /*ctx.save(); // on sauvegarde le canva
            ctx.globalAlpha = 0.7; // Opacite
            super.draw(ctx);
            ctx.restore(); // on restaure le canva
            ctx.drawImage(this.image,this.x, this.y, this.width, this.height);*/
        }
    }

    class Road3 extends Car {
        constructor(game) {
            super(game); // recupere les parametres du parent avec les fonctions update, draw...
            this.x = canvas.width;
            this.y = heightRoad[2];
            this.image = carRight;
        }
        update(deltaTime) {
            if (this.x < player.x + player.width &&
                this.x + this.width > player.x &&
                this.y < player.y + player.height &&
                this.y + this.height > player.y) {
                stopCollision = true;
                console.log('route3');
            }
            this.x -= this.vx * deltaTime;
            if (this.x < 0 - this.width) this.markedForDeletion = true;
            super.update(deltaTime);
        }
        draw(ctx) {
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
        }
    }

    class Road4 extends Car {
        constructor(game) {
            super(game); // recupere les parametres du parent avec les fonctions update, draw...
            this.x = canvas.width;
            this.y = heightRoad[3];
            this.image = carRight;
        }
        update(deltaTime) {
            if (this.x < player.x + player.width &&
                this.x + this.width > player.x &&
                this.y < player.y + player.height &&
                this.y + this.height > player.y) {
                stopCollision = true;
                console.log('route4');
            }
            this.x -= this.vx * deltaTime;
            if (this.x + this.width < 0 - this.width) this.markedForDeletion = true;
            super.update(deltaTime);
        }
        draw(ctx) {
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
        }
    }

    class Train {
        constructor() {
            this.width = 216;
            this.height = 54;
            this.x = 0 - this.width - 100;
            this.y = 38;
            this.vx = 0.05;
            this.image = monTrain;
            this.frame = -1;
            this.frameStop = false;
            this.frameInterval = 6;
        }
        update(deltaTime) {

            if (this.x >= (canvas.width / 2 - this.width) - 100) {
                if (this.frameStop == false) {
                    // sauvegarde frame en cours
                    this.frame = numFrame;
                    this.frameStop = true;
                } else if (numFrame >= this.frame + this.frameInterval) {
                    this.x += this.vx * deltaTime;
                }
            } else {
                // Le train repart
                this.x += this.vx * deltaTime;
                this.frameStop = false;
            }

            if (this.x > canvas.width + this.width) {
                this.x = -this.width;
            }

            // if (this.x + this.width > canvas.width) this.markedForDeletion = true;

        }

        draw() {
            ctx.drawImage(this.image, this.x, this.y, this.width, this.height);
        }
    }

    class Player {
        constructor() {
            this.width = 64;
            this.height = 80;
            this.x = playerPosX[0];
            this.y = playerPosY[0];
            this.image = monPlayer;
            this.indexPressArrow = 1;
            this.indexRefPressArrow = 0;
            this.spriteWidth = 646;
            this.spriteHeight = 800;
            this.frameRatio = 0.10;
            this.width = this.spriteWidth * this.frameRatio;
            this.height = this.spriteHeight * this.frameRatio;
            this.NumFrame = 5;
            this.frame = -1;
            this.frameStop = false;
            this.frameInterval = 2;
        }
        update() {
            // rappel poition du joueur
            // const playerPosX = [canvas.width/2 - 40, canvas.width/2 - 80, canvas.width/2 - 40, canvas.width/2 + 40];
            // const playerPosY = [500, 350, 250, 100];

            // test collision
            
            if (stopCollision == true) {
                // stop du jeu 
                lives--;
                // retour du personnage au début
                this.x = playerPosX[0];
                this.y = playerPosY[0];
                // incremente le point
                this.indexPressArrow = 1;
                this.indexRefPressArrow = 0;

                // debloquage du clavier
                stopKeyPress = false;
                stopCollision = false;


            } else {
                if (keys.ArrowUp.pressed) {
                    if (this.indexPressArrow == playerPosY.length - 1) {
                        stopKeyPress = true;
                        keys.ArrowUp.pressed = false;
                        // on position le personnage à la gare
                        this.x = playerPosX[this.indexPressArrow];
                        this.y = playerPosY[this.indexPressArrow];
                        // fait une pause de 2 secondes
                        setTimeout(() => {
                            // reset de la position
                            // positionne le personnage en bas
                            this.x = playerPosX[0];
                            this.y = playerPosY[0];
                            // incremente le point
                            if (train.frameStop == true && ((train.x + train.width) < playerPosX[this.indexPressArrow])) {
                                points += 100;
                            } else {
                                points += 10;
                            }
                            this.indexPressArrow = 1;
                            this.indexRefPressArrow = 0;

                            // debloquage du clavier
                            stopKeyPress = false;
                        }, 1000);

                    } else if (this.y == playerPosY[this.indexRefPressArrow]) {
                        this.x = playerPosX[this.indexPressArrow];
                        this.y = playerPosY[this.indexPressArrow];
                        this.indexPressArrow++;
                        this.indexRefPressArrow++;
                        keys.ArrowUp.pressed = false;
                    }
                }
                if (keys.ArrowDown.pressed) {
                    // on bloque le retour au point de depart
                    if (this.indexRefPressArrow == 0 || this.indexRefPressArrow == 1) {
                        keys.ArrowDown.pressed = false;
                    } else
                        if (this.y == playerPosY[this.indexRefPressArrow]) {
                            this.indexPressArrow -= 2;
                            this.x = playerPosX[this.indexPressArrow];
                            this.y = playerPosY[this.indexPressArrow];
                            this.indexPressArrow++;
                            this.indexRefPressArrow--;
                            keys.ArrowDown.pressed = false;
                        }
                }
            }
        }

        draw() {
            //determination de la frame à afficher
            if (this.indexRefPressArrow == 0) this.NumFrame = 4;
            else if (this.indexRefPressArrow == 1) this.NumFrame = 0;
            else if (this.indexRefPressArrow == 2) this.NumFrame = 1;
            else if (this.indexRefPressArrow == 3) this.NumFrame = 0;
            else if (this.indexRefPressArrow == 4) this.NumFrame = 1;
            else if (this.indexRefPressArrow == 5) this.NumFrame = 5;
            //ctx.drawImage(this.image, this.x, this.y, this.width, this.height);
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
            // test rectangle
        }
        drawCollision() {
            // frame =2 = crash
            this.NumFrame = 2;
            ctx.drawImage(this.image, this.spriteWidth * this.NumFrame, 0, this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);

        }
    }

    // Fonds de l'ecran
    class Textetitre {
        constructor(ctx) {
            this.x = 20;
            this.y = 20;
        }

        draw() {
            ctx.font = "16pt Calibri,Geneva,Arial";
            ctx.fillStyle = 'white';
            ctx.fillText("Points : " + points + " 💪", this.x, this.y);
            ctx.fillText("Vies : " + lives + " ❤️", this.x + 200, this.y);
            ctx.fillText("Level : " + level + " ⚔️", this.x + 400, this.y);
            ctx.fillStyle = "white";
            ctx.fillRect(0, (30), canvas.width, 4); // ligne du haut
            ctx.fillRect(0, (100) - 4, canvas.width / 2 - 80, 4); // sous le train
            ctx.fillRect(canvas.width / 2, (100) - 4, canvas.width / 2, 4); // sous le train
            ctx.fillRect(0, (canvas.height / 2) - 4, canvas.width, 4); // ligne du centre haut
            ctx.fillRect(0, (canvas.height / 2) + 4, canvas.width, 4); // ligne du centre bas
            ctx.fillRect(0, (canvas.height) - 100, canvas.width / 2, 4); // ligne du bas
            ctx.fillRect(canvas.width / 2 + 80, (canvas.height) - 100, canvas.width / 2, 4); // ligne du bas
            //ctx.fillRect(0,(canvas.height)-100,canvas.width,4); // ligne du bas

            let lineWidth = 40;
            let lineLeft = 0;

            for (let i = 1; i < 13; i++) {
                ctx.fillRect(lineLeft, (canvas.height / 4) + 48, lineWidth, 4); // ligne du centre haut
                ctx.fillRect(lineLeft, (canvas.height / 4) + 252, lineWidth, 4); // ligne du centre bas
                lineLeft += 70;
            }

            // tracé position joueur

            ctx.strokeStyle = "lightgrey";
            // posisiton 1
            // exemple de cercle
            /*ctx.beginPath();
            ctx.arc(canvas.width / 2 - 40, 100 + 50, 40, 0, Math.PI * 2, true);
            ctx.stroke();*/

            // tracé croix
            ctx.save(); // on sauvegarde le canva
            ctx.globalAlpha = 0.3; // Opacite
            ctx.strokeStyle = "lightgrey";

            for (let i = 1; i < 6; i++) {
                ctx.beginPath();      // Début du chemin
                ctx.moveTo(playerPosX[i] + player.width / 4, playerPosY[i] + player.height / 8 * 3);    // Le tracé part du point 50,50
                ctx.lineTo(playerPosX[i] + player.width / 4 + 20, playerPosY[i] + player.height / 8 * 3 + 20);  // Un segment est ajouté vers 200,200
                ctx.moveTo(playerPosX[i] + player.width / 4 + 20, playerPosY[i] + player.height / 8 * 3);   // Puis on saute jusqu'à 200,50
                ctx.lineTo(playerPosX[i] + player.width / 4, playerPosY[i] + player.height / 8 * 3 + 20);   // Puis on trace jusqu'à 50,200
                ctx.closePath();      // fermeture du chemin
                ctx.stroke();
            }
            ctx.restore(); // on restaure le canva

            // affichage du colis en bas du canvas
            let imageColis = monColis;
            ctx.drawImage(imageColis, canvas.width / 2 - 30, canvas.height - 70, 50, 50);
        }

        update() {
            this.draw();
        }
    }

    // Fonds de l'ecran
    class Tableau {
        constructor(ctx) {
            this.x = 60;
            this.y = 60;
            this.width = canvas.width - 120;
            this.height = canvas.height - 120;
        }

        draw() {
            ctx.fillStyle = "white";
            ctx.font = "38pt Calibri,Geneva,Arial";
            ctx.fillText("Vous avez perdu", 300, 200);
            ctx.strokeRect(this.x, this.y, this.width, this.height);
        }
    }

    const game = new Game(ctx, canvas.width, canvas.height);
    const train = new Train(ctx);
    const player = new Player(ctx);
    const textetitre = new Textetitre(ctx);
    const tableau = new Tableau(ctx);

    // event du player
    addEventListener('keydown', (event) => {
        switch (event.key) {
            case 'ArrowUp':
                if (stopKeyPress == false) keys.ArrowUp.pressed = true;
                break;
            case 'ArrowDown':
                keys.ArrowDown.pressed = true;
                break;
        }
    })

    addEventListener('keyup', (event) => {
        switch (event.key) {
            case 'ArrowUp':
                keys.ArrowUp.pressed = false;
                break;
            case 'ArrowDown':
                keys.ArrowDown.pressed = false;
                break;
        }
    })

    //Affichage des règles du jeu
    rulesBtn.addEventListener('click', () => {
        rules.classList.add('show');
        isPaused = true;
        canvas.style.opacity = '0.2';
    });

    closeBtn.addEventListener('click', () => {
        rules.classList.remove('show');
        canvas.style.opacity = '1';
        isPaused = false;
        animate(0);
    });

    // Inscription du pseudo dans le localstorage
    pseudo.addEventListener('change', () => {
        localStorage.setItem('derPseudo', pseudo.value);
    })

    // Efface le contenu du pseudo si 'Inconnu'
    pseudo.addEventListener('click', () => {
        if (pseudo.value == 'Inconuu') pseudo.value = '';
    })

    // Affichage des info de fin de partie (Victoire ou echec)
    function showEndInfo() {
        canvas.style.opacity = '0.2';
        game_over.style.visibility = 'visible';
        game_over.style.opacity = '1';
        let textcontent = 'Votre score est de ' + points;
        let classementScore;

        // Gestion de l'enregistrement du score     highScorePseudo
        if (points > localStorage.getItem('gameHighScore5')) {
            classementScore = 5;
            textResultat = '<br>C\'est bien ' + pseudo.value + ' tu es le cinquième !';
            console.log(1);
            if (points > localStorage.getItem('gameHighScore4')) {
                localStorage.setItem('gameHighScore5', localStorage.getItem('gameHighScore4'));
                localStorage.setItem('gameHighPseudo5', localStorage.getItem('gameHighPseudo5'));
                classementScore = 4;
                textResultat = '<br>Très bien ' + pseudo.value + ' tu es le quatrième !';
            } if (points > localStorage.getItem('gameHighScore3')) {
                localStorage.setItem('gameHighScore5', localStorage.getItem('gameHighScore4'));
                localStorage.setItem('gameHighScore4', localStorage.getItem('gameHighScore3'));
                localStorage.setItem('gameHighPseudo5', localStorage.getItem('gameHighPseudo4'));
                localStorage.setItem('gameHighPseudo4', localStorage.getItem('gameHighPseudo3'));
                classementScore = 3;
                textResultat = '<br>Très bien ' + pseudo.value + ' tu es le troisième !';
            } if (points > localStorage.getItem('gameHighScore2')) {
                localStorage.setItem('gameHighScore5', localStorage.getItem('gameHighScore4'));
                localStorage.setItem('gameHighScore4', localStorage.getItem('gameHighScore3'));
                localStorage.setItem('gameHighScore3', localStorage.getItem('gameHighScore2'));
                localStorage.setItem('gameHighPseudo5', localStorage.getItem('gameHighPseudo5'));
                localStorage.setItem('gameHighPseudo4', localStorage.getItem('gameHighPseudo4'));
                localStorage.setItem('gameHighPseudo3', localStorage.getItem('gameHighPseudo3'));
                classementScore = 2;
                textResultat = '<br>Bravo ' + pseudo.value + ' tu es le deuxième !';

            } if (points > localStorage.getItem('gameHighScore1')) {
                localStorage.setItem('gameHighScore5', localStorage.getItem('gameHighScore4'));
                localStorage.setItem('gameHighScore4', localStorage.getItem('gameHighScore3'));
                localStorage.setItem('gameHighScore3', localStorage.getItem('gameHighScore2'));
                localStorage.setItem('gameHighScore2', localStorage.getItem('gameHighScore1'));
                localStorage.setItem('gameHighPseudo5', localStorage.getItem('gameHighPseudo4'));
                localStorage.setItem('gameHighPseudo4', localStorage.getItem('gameHighPseudo3'));
                localStorage.setItem('gameHighPseudo3', localStorage.getItem('gameHighPseudo2'));
                localStorage.setItem('gameHighPseudo2', localStorage.getItem('gameHighPseudo1'));
                classementScore = 1;
                textResultat = '<br>Bravo ' + pseudo.value + ' tu es le meilleur !';
            }
            // mise a jour du score
            if (classementScore == 1) {
                localStorage.setItem('gameHighScore1', points);
                localStorage.setItem('gameHighPseudo1', pseudo.value);
            } else if (classementScore == 2) {
                localStorage.setItem('gameHighScore2', points);
                localStorage.setItem('gameHighPseudo2', pseudo.value);
            }
            else if (classementScore == 3) {
                localStorage.setItem('gameHighScore3', points);
                localStorage.setItem('gameHighPseudo3', pseudo.value);

            } else if (classementScore == 4) {
                localStorage.setItem('gameHighScore4', points);
                localStorage.setItem('gameHighPseudo4', pseudo.value);

            } else if (classementScore == 5) {
                localStorage.setItem('gameHighScore5', points);
                localStorage.setItem('gameHighPseudo5', pseudo.value);
            }
        } else {
            textResultat = '<br>Dommage ' + pseudo.value + '...';
        }
        leScore.innerHTML = textcontent + textResultat;
    }

    // affichage du tableau des scores en page d'accueil
    let nbScore = 5;
    let rankScore = 'ème';

    function tableauScoreAccueil() {
        for (i = 0; i < nbScore; i++) {
            // gestion du texte 1er, 2ème...
            if (i == 0) {
                rankScore = 'er';
            } else {
                rankScore = 'ème';
            }

            let myClassDIV = document.createElement("div"); // crée la div de div pour "1er..."
            let mySPseudoDIV = document.createElement("div"); // crée la div de div pour inscire le pseudo
            let myScoreDIV2 = document.createElement("div"); // crée la div de div pour inscire le score

            myScoreDIV2.classList.add('.le.score'); // ajoute une classe

            myClassDIV.innerHTML = (i + 1) + ' ' + rankScore;
            mySPseudoDIV.innerHTML = highScorePseudo[i];
            myScoreDIV2.innerHTML = highScoreBoard[i];

            document.querySelector("#contain-score").appendChild(myClassDIV); // ajoute la div dans le dom
            document.querySelector("#contain-score").appendChild(mySPseudoDIV); // ajoute la div dans le dom
            document.querySelector("#contain-score").appendChild(myScoreDIV2); // ajoute la div dans le dom  
        }
    }
    tableauScoreAccueil();

    // Relancer le jeu
    restart.addEventListener('click', () => { location.reload(); });
    razBtn.addEventListener('click', () => { location.reload(); });

    // Premier lancement du jeu
    // On enleve l'ecran de départ
    jouerBtn.addEventListener('click', () => {
        ecranStart.classList.add('invisible');
        canvas.style.backgroundImage = 'none';
        animate(0);
    });

    let lastTime = 1;
    function animate(timeStamp) {
        if (stopCollision == true) {
            // Affichage du crash
            player.NumFrame = 2;
            player.drawCollision(); 

            // stop du jeu 
            lives--;
        }

        if (lives >= 0) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            /*const deltaTime = timeStamp - lastTime;*/
            const deltaTime = 16;
            lastTime = timeStamp;
            game.update(deltaTime);
            game.draw();
            train.update(deltaTime);
            train.draw();
            textetitre.update();
            player.update();
            player.draw();
            // some code
            // gestion des collisions

            if (isPaused == false) {
                requestAnimationFrame(animate);
            }

        } else {
            // ecran de fin de partie
            // tableau.draw();
            // affichage de la div perdu avec le score
            showEndInfo();
        }
    };

    //animate(0);

});

