const boutonPage = document.querySelector(".boutonPage");
const modalePage = document.querySelector(".modalePage");
const formulairePage = document.querySelector(".formulairePage");
let numeroPage = document.querySelector(".numeroPage");

boutonPage.addEventListener("click", function() {
    // affichage de la boîte modale
    modalePage.showModal();
});

window.addEventListener("click", function(event) {

    if (event.target === modalePage) {
        // fermeture de la boîte modale
        modalePage.close();
    }
});



formulairePage.addEventListener("submit", function(event) {
    event.preventDefault();
    
    // attributions des valeurs dans des variables pour rendre le tout plus lisible
    numeroPage = numeroPage.value;
    let dernierePage = boutonPage.dataset.dernierePage

    if(numeroPage >= 1 && numeroPage <= dernierePage ){
        // affichage de la page ciblée
        window.location.href = window.location.origin + '/bouteilles?page=' + numeroPage;
    }
    else{
        // en cas de valeur non valide, retour à la page 1
        window.location.href = window.location.origin + '/bouteilles?page=1';
    }
});