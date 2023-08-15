const updateButtons = document.querySelectorAll('.boutonUpdate');
const updateDialog = document.getElementById('updateDialog');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const userIdInput = document.getElementById('userId');
const updateForm = document.getElementById('updateForm');

updateButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        const userId = event.target.getAttribute('data-userid');
        const username = event.target.getAttribute('data-username');
        const email = event.target.getAttribute('data-email');

        console.log(userId, username, email);
        updateForm.action = '{{ route("admin.update", ["user" => "__userId__"]) }}'.replace('__userId__', userId);
        userIdInput.value = userId;
        usernameInput.value = username;
        emailInput.value = email;
        updateDialog.showModal();
    });
});

updateForm.addEventListener('submit', (event) => {
    // Votre code pour gérer la soumission du formulaire
});

const closeDialogButton = document.getElementById('closeDialog');
closeDialogButton.addEventListener('click', () => {
    updateDialog.close();
});