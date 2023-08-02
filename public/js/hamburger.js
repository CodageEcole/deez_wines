window.onload = function() {
    const menuMobile = document.querySelector(".mobile-nav");
    const menuBouton = document.querySelector(".hamburger")

    menuBouton.addEventListener("click", function() {
        console.log("Allo")
        menuMobile.classList.toggle("is-active");
    })
}