const modifierQuantite = document.querySelectorAll('.modifierQuantite');
const modaleModifier = document.querySelector('.modalePage');
const fermerModale = modaleModifier.querySelector('button:last-of-type');

let inputBouteilles = modaleModifier.querySelector('.inputQuantite');
let formulaire = modaleModifier.querySelector('form');

let ajout = modaleModifier.querySelector('.plus');
let retrait = modaleModifier.querySelector('.moins');

modifierQuantite.forEach((bouteille) =>{
    bouteille.addEventListener('click', (e) => {
        inputBouteilles.value = bouteille.dataset.nombre;
        formulaire.action = formulaire.action.replace('id-bouteille', bouteille.dataset.id)
        modaleModifier.showModal();
    })
})

ajout.addEventListener('click', (e) => {
    inputBouteilles.value = parseInt(inputBouteilles.value) + 1;
})

retrait.addEventListener('click', (e) => {
    if(parseInt(inputBouteilles.value) - 1 == 0){
        inputBouteilles.value = 1;
    }
    else{
        inputBouteilles.value = parseInt(inputBouteilles.value) - 1;
    }
})

fermerModale.addEventListener('click', (e) => {
    modaleModifier.close();
})

window.addEventListener('click', (e) => {
    if(e.target === modaleModifier){
        modaleModifier.close();
    }
})
