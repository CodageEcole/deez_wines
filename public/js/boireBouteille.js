const boutonBoire = document.querySelector('.boireBouteille');
let bouteilleNom = boutonBoire.dataset.nom;
let bouteilleId = boutonBoire.dataset.id;
let nombreBouteilles = document.querySelector('.nombreBouteilles').innerText;

boutonBoire.addEventListener('click', function(e){
    console.log('success!', bouteilleId, bouteilleNom, nombreBouteilles);
})