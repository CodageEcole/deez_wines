window.onload = function() {
    const menuMobile = document.querySelector(".mobile-nav");
    const menuBouton = document.querySelector(".hamburger");
    const overlayGrey = document.querySelector(".overlay-grey");
    

    menuBouton.addEventListener("click", function() {
        console.log("Allo")
        menuMobile.classList.toggle("is-active");
        overlayGrey.classList.toggle("show");
    })
}