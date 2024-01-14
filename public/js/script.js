
var MainImg = document.getElementById("MainImg");
var smalling = document.getElementsByClassName("small-img");

for (var i = 0; i < smalling.length; i++) {
    smalling[i].onclick = function() {
        MainImg.src = this.src;
    }
}

const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}