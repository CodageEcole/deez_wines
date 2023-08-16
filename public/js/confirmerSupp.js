const boutonsSupp = document.querySelectorAll('.boutonSupp');
const boiteModale = document.querySelector('.confirmerDel');
const formulaireDel = document.querySelector('.formulaireDel');
const boutonAnnuler = boiteModale.querySelector('button:last-of-type');
const boutonConfirmer = boiteModale.querySelector('button:first-of-type');
const titreDel = document.getElementById('titreDel');
const texteDel = document.getElementById('texteDel');

// Les boutons de suppressions, unitaire ou multiples
boutonsSupp.forEach(boutonSupp => {
    boutonSupp.addEventListener("click", function(e){

        e.preventDefault();
        const text = boutonSupp.getAttribute('data-text');
        const title = boutonSupp.getAttribute('data-title');

        titreDel.textContent = title;
        texteDel.textContent = text;
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