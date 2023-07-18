const modifierQuantite = document.querySelectorAll('.modifierQuantite');
const modaleModifier = document.querySelector('.changerQteBout');

let inputBouteilles = modaleModifier.querySelector('.inputQuantite');

// modifierQuantite.forEach(function(element) {
//     element.addEventListener('click', function(e) {
//         inputBouteilles.innerHTML = element.dataset.nombre;
//         console.log(inputBouteilles)
//         // inputBouteilles.value = nbBouteilles;
//         modaleModifier.showModal();
//     });
// });

modifierQuantite.forEach((bouteille) =>{
    bouteille.addEventListener('click', (e) => {
        console.log(inputBouteilles.value);
        inputBouteilles.value = bouteille.dataset.nombre;
        modaleModifier.showModal();
    })
})