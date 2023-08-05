window.onload = function() {
    const menuMobile = document.querySelector(".mobile-nav");
    const menuBouton = document.querySelector(".hamburger");
    const main = document.querySelector("main");
    const footer = document.querySelector("footer")
    

    menuBouton.addEventListener("click", function() {
        console.log("Allo")
        menuMobile.classList.toggle("is-active");
        main.classList.toggle("overlay");
        footer.classList.toggle("overlay");
    })
}