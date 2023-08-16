// Menu options supplementaires
const menuMobile = document.querySelector(".mobile-nav");
const menuBouton = document.querySelector(".hamburger");
const overlayGrey = document.querySelector(".overlay-grey");
const overlayGreyFiltre = document.querySelector(".overlay-grey-filtre");

// menu filtre
const filtreBouton = document.querySelector(".filtres-trigger");
const menuFiltre = document.querySelector(".filtre-nav");
const menuIcon = menuBouton.querySelector("img");

// fonction pour shadows (parce qu'il y a 3 possibilites, pour le menu option, filtre et sort)
function toggleShadows(element, target, classActive) {
    element.addEventListener("click", function() {
        target.classList.toggle(classActive);
        element.classList.toggle("show");
        if(menuIcon) {
            menuIcon.src = window.location.origin + "/icons/more_icon.svg";
        }
    });
}

window.onload = function() {
    // Fonction pour le bouton de menu
    if(menuBouton) {
        menuBouton.addEventListener("click", function() {
            if (menuFiltre && menuFiltre.classList.contains("is-active-filtre")) {
                menuFiltre.classList.remove("is-active-filtre");
                overlayGreyFiltre.classList.remove("show");
                menuIcon.src = window.location.origin + "/icons/more_icon.svg";
            } else if (menuMobile.classList.contains("is-active")) {
                menuMobile.classList.remove("is-active");
                overlayGrey.classList.remove("show");
                menuIcon.src = window.location.origin + "/icons/more_icon.svg";
            } else {
                menuMobile.classList.toggle("is-active");
                overlayGrey.classList.toggle("show");
                menuIcon.src = window.location.origin + "/icons/right_arrow.svg";
            }
        });
    }

    // Fonction pour le menu filtre
    if (filtreBouton) {
        filtreBouton.addEventListener("click", function() {
            if (menuMobile.classList.contains("is-active")) {
                menuMobile.classList.remove("is-active");
                overlayGrey.classList.remove("show");
                menuIcon.src = window.location.origin + "/icons/more_icon.svg";
            }
            menuFiltre.classList.toggle("is-active-filtre");
            overlayGreyFiltre.classList.toggle("show");

            if (menuFiltre.classList.contains("is-active-filtre")) {
                menuIcon.src = window.location.origin + "/icons/left_arrow.svg";
            } else {
                menuIcon.src = window.location.origin + "/icons/more_icon.svg";
            }
        });
    }

    // Fonctions pour les ombres
    toggleShadows(overlayGrey, menuMobile, "is-active");
    toggleShadows(overlayGreyFiltre, menuFiltre, "is-active-filtre");
}