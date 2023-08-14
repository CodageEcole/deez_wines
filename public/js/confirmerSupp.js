const boutonsSupp = document.querySelectorAll('.boutonSupp');
const boiteModale = document.querySelector('.confirmerDel');
const formulaireDel = document.querySelector('.formulaireDel');
const boutonAnnuler = boiteModale.querySelector('button:last-of-type');
const boutonConfirmer = boiteModale.querySelector('button:first-of-type');

// Les boutons de suppressions, unitaire ou multiples
boutonsSupp.forEach(boutonSupp => {
    boutonSupp.addEventListener("click", function(e){

        e.preventDefault();
        boiteModale.showModal();

        boutonConfirmer.addEventListener("click", function(e){

            formulaireDel.submit();
        });
    });
});

boutonAnnuler.addEventListener("click", function(e){

    boiteModale.close();
});

window.addEventListener("click", function(event) {

    if (event.target === boiteModale) {

        boiteModale.close();
    }
});