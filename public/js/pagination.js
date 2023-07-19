const formulairePage = document.querySelector(".selecteurPage");
const boutonPagination = document.querySelector(".numeroPage");

boutonPagination.addEventListener("keydown", function(event) {
    console.log("test")
    if (event.key === "Enter" || event.keyCode === 13) {
        event.preventDefault();
        // attributions des valeurs dans des variables pour rendre le tout plus lisible
        numeroPage = parseInt(boutonPagination.value);
        let dernierePage = parseInt(boutonPagination.dataset.dernierePage)

        if(numeroPage >= 1 && numeroPage <= dernierePage){
            // affichage de la page ciblée
            window.location.href = window.location.origin + '/bouteilles?page=' + numeroPage;
        }
        else{
            // en cas de valeur non valide, retour à la page 1
            window.location.href = window.location.origin + '/bouteilles?page=1';
        }
    }
});