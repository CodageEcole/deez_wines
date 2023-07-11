function openModal(nom, id) {
    var modal = document.getElementById("modal");
    var modalTitle = document.getElementById("modal-title");
    var modalId = document.getElementById("modal-id");
    document.getElementById("modal-title").innerText = nom;
    document.getElementById("bouteille-id").value = id;
    modal.style.display = "block";
    modalId.value = id;
    modalTitle.innerText = nom;
}


function closeModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

function decrementQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

function incrementQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);

    quantityInput.value = currentQuantity + 1;
}

