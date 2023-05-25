document.addEventListener('DOMContentLoaded', inici);
let posbuscador = 0;
let posicionActual = 0;
let posicionActual2 = 0;
let posicionActual3 = 0;
let posicionActual4 = 0;
function inici() {

    var buscar = document.getElementById("buscador");
    var section2 = document.getElementById('section1_2');
    var lupa = document.getElementById('lupa');
    var section2_2 = document.getElementById('section2_2');
    var overlay = document.getElementById('overlay');
    var creu = document.getElementById('creueta');
    var blocllista = document.getElementById('blocllista');
    var llista = document.getElementById('llista');



    section2.style.display = "none";
    section2_2.style.display = "none";


    blocllista.classList.add('hidden');
    llista.classList.add('hidden');
    buscar.classList.add('hidden');
    overlay.classList.add('hidden');


    let boto = document.getElementById('left');
    let boto2 = document.getElementById('right');
    let boto3 = document.getElementById('left2');
    let boto4 = document.getElementById('right2');


    creu.addEventListener('click', buscador);
    lupa.addEventListener('click', buscador);
    boto.addEventListener('click', retrocederFoto);
    boto2.addEventListener('click', pasarFoto);
    boto3.addEventListener('click', retrocederFoto2);
    boto4.addEventListener('click', pasarFoto2);

}

function buscador() {

    var lupa = document.getElementById("buscador");
    var overlay = document.getElementById('overlay');



    setTimeout(function () {
        lupa.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
        body.classList.toggle('noscroll');
        document.body.classList.toggle('menu-open');
    }, 100);


}

function pasarFoto() {


    var section1 = document.getElementById('section1_1');
    var section2 = document.getElementById('section1_2');

    if (posicionActual === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual++;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual = 0;
    }
}

function retrocederFoto() {


    var section1 = document.getElementById('section1_1');
    var section2 = document.getElementById('section1_2');

    if (posicionActual === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual = 1;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual--;
    }
}

function pasarFoto2() {

    var section1 = document.getElementById('section2_1');
    var section2 = document.getElementById('section2_2');

    if (posicionActual2 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual2++;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual2 = 0;
    }
}

function retrocederFoto2() {


    var section1 = document.getElementById('section2_1');
    var section2 = document.getElementById('section2_2');

    if (posicionActual2 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual2 = 1;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual2--;
    }
}

function pasarFoto3() {


    var section1 = document.getElementById('section3_1');
    var section2 = document.getElementById('section3_2');

    if (posicionActual3 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual3++;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual3 = 0;
    }
}

function retrocederFoto3() {


    var section1 = document.getElementById('section3_1');
    var section2 = document.getElementById('section3_2');

    if (posicionActual3 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual3 = 1;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual3--;
    }
}

function pasarFoto4() {


    var section1 = document.getElementById('section4_1');
    var section2 = document.getElementById('section4_2');

    if (posicionActual4 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual4++;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual4 = 0;
    }
}

function retrocederFoto4() {


    var section1 = document.getElementById('section4_1');
    var section2 = document.getElementById('section4_2');

    if (posicionActual4 === 0) {
        section1.style.display = "none";
        section2.style.display = "flex";
        posicionActual4 = 1;
    } else {
        section1.style.display = "flex";
        section2.style.display = "none";
        posicionActual4--;
    }
}

function desplegar() {

    var blocllista = document.getElementById('blocllista');
    var llista = document.getElementById('llista');


    llista.classList.toggle('hidden');
    blocllista.classList.toggle('hidden');

}

function perfil() {

    var plan = document.getElementById('plan');
    var cartera = document.getElementById('cartera');
    var perfil = document.getElementById('formulari');


    perfil.style.display = "flex";
    cartera.style.display = "none";
    plan.style.display = "none";

}

function cartera() {

    var plan = document.getElementById('plan');
    var cartera = document.getElementById('cartera');
    var perfil = document.getElementById('formulari');


    perfil.style.display = "none";
    cartera.style.display = "flex";
    plan.style.display = "none";

}

function plan() {

    var plan = document.getElementById('plan');
    var cartera = document.getElementById('cartera');
    var perfil = document.getElementById('formulari');


    perfil.style.display = "none";
    cartera.style.display = "none";
    plan.style.display = "flex";

}
