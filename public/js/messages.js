// Function to remove the element from the DOM
function removeElement(element) {
    element.parentNode.removeChild(element);
}

// Function to handle the fade-out effect
function fadeOutElement(element) {
    element.style.opacity = 1;

    // Create a variable to store the current opacity value
    let currentOpacity = 1;

    // Define the duration of the fade-out animation in milliseconds
    const animationDuration = 1000; // 1 second

    // Define the time interval for updating the opacity (50 milliseconds in this case)
    const interval = 50;

    // Calculate the change in opacity for each interval
    const opacityChange = currentOpacity / (animationDuration / interval);

    // Function to update the opacity of the element at each interval
    function updateOpacity() {
        currentOpacity -= opacityChange;
        element.style.opacity = currentOpacity;

        // Check if the opacity has reached 0, and remove the element from the DOM
        if (currentOpacity <= 0) {
            removeElement(element);
        } else {
            // Continue the fade-out animation
            setTimeout(updateOpacity, interval);
        }
    }

    // Start the fade-out animation after a 3-second delay
    setTimeout(function () {
        updateOpacity();
    }, 3000); // 3 seconds
}

// Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        fadeOutElement(successMessage);
    }
});