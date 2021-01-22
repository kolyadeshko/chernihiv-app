var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-100%";
    }
    prevScrollpos = currentScrollPos;
}

window.onload = function (){
    document.getElementById("headerimg__img").style.filter = "blur(2px)";
    document.getElementById("headerimg__body").style.opacity = "1";
}