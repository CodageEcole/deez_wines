document.addEventListener("DOMContentLoaded", function() {
    let filtreButtonCouleurs = document.querySelector(".filtre-button-couleurs");
    let filtreDropdownCouleurs = document.querySelector(".filtre-dropdown-couleurs");

    // let filtreButtonPays = document.querySelector(".filtre-button-pays");
    // let filtreDropdownPays = document.querySelector(".filtre-dropdown-pays");

    filtreButtonCouleurs.addEventListener("click", function(event) {
        event.preventDefault(); // Pour empêcher que la page reload
        filtreDropdownCouleurs.classList.toggle("show");
    });

    // filtreButtonPays.addEventListener("click", function(event) {
    //     event.preventDefault(); // Pour empêcher que la page reload
    //     filtreDropdownPays.classList.toggle("show");
    // });
});