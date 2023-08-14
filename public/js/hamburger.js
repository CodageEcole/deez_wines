// Menu options supplementaires
const menuMobile = document.querySelector(".mobile-nav");
const menuBouton = document.querySelector(".hamburger");
const overlayGrey = document.querySelector(".overlay-grey");
const overlayGreyFiltre = document.querySelector(".overlay-grey-filtre");

// menu filtre
const filtreBouton = document.querySelector(".filtres-trigger");
const menuFiltre = document.querySelector(".filtre-nav");

// fonction pour shadows (parce qu'il y a 3 possibilites, pour le menu option, filtre et sort)
function toggleShadows(element, target, classActive) {
    element.addEventListener("click", function() {
        target.classList.toggle(classActive);
        element.classList.toggle("show");
    });
}

window.onload = function() {

    // fonction options supplementaires
    menuBouton.addEventListener("click", function() {
        menuMobile.classList.toggle("is-active");
        overlayGrey.classList.toggle("show");

        // Pour empecher les overlaps de menus
        if(menuFiltre) {
            menuFiltre.classList.remove("is-active-filtre");
        }

        if(overlayGreyFiltre){
            overlayGreyFiltre.classList.remove("show");
        }

    })

    // fonction filtre
    if(filtreBouton) {
        filtreBouton.addEventListener("click", function() {
            console.log("Allo")
            menuFiltre.classList.toggle("is-active-filtre");
            overlayGreyFiltre.classList.toggle("show");
        })
    }

    // fonctions pour les shadows
    toggleShadows(overlayGrey, menuMobile, "is-active");
    toggleShadows(overlayGreyFiltre, menuFiltre, "is-active-filtre")
}