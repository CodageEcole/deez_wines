let inputNom = document.querySelector('.input-edit-nom');
let boutonCrayon = document.querySelector('.crayon-edit-icon');
let boutonModifier = document.querySelector('.bouton-modifier');
let formModifier = document.querySelector('.form-modifier');
let nomCellier = inputNom.value;
let change = false;

inputNom.disabled = true;
boutonModifier.style.display = 'none';
inputNom.style.padding = '5px';

boutonCrayon.addEventListener('click', function() {
    boutonCrayon.disabled = true;
    inputNom.classList.add('clickable');
    inputNom.disabled = false;
    boutonModifier.style.display = 'block';
    boutonCrayon.style.display = 'none';
})  

inputNom.addEventListener('input', function() {
    change = true;
    boutonModifier.innerHTML = 'Enregistrer';
    boutonModifier.classList.add('active');

    if(inputNom.value == nomCellier) {
        change = false;
        boutonModifier.innerHTML = 'Annuler';
        boutonModifier.classList.remove('active');
    }
})

boutonModifier.addEventListener('click', function(event) {
    event.preventDefault();

    if (change) {
        formModifier.submit();
    } else {
        boutonModifier.style.display = 'none';
        boutonCrayon.style.display = 'block';
        inputNom.disabled = true;
        boutonCrayon.disabled = false;
        inputNom.classList.remove('clickable');
    }
})
