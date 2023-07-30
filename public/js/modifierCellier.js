let inputNom = document.querySelector('.input-edit-nom');
let boutonCrayon = document.querySelector('.crayon-edit-icon');
let boutonModifier = document.querySelector('.bouton-modifier');
let formModifier = document.querySelector('.form-modifier');
let change = false;

inputNom.disabled = true;
boutonModifier.style.display = 'none';
inputNom.style.padding = '5px';

boutonCrayon.addEventListener('click', function() {
    boutonCrayon.disabled = true;
    inputNom.style.border = '1px solid var(--light-brown)';
    inputNom.style.borderRadius = '5px';
    inputNom.disabled = false;
    boutonModifier.style.display = 'block';
    boutonCrayon.style.display = 'none';
})  

inputNom.addEventListener('input', function() {
    change = true;
})

boutonModifier.addEventListener('click', function(event) {
    event.preventDefault();

    if (change) {
        formModifier.submit();
    } else {
        inputNom.disabled = true;
        boutonCrayon.disabled = false;
        inputNom.style.display = '1px solid transparent';
        boutonModifier.style.display = 'none';
        boutonCrayon.style.display = 'block';
        inputNom.style.border = 'none';
    }
})
