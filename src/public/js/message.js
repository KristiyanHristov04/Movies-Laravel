const message = document.getElementById('message');
if (message) {
    message.addEventListener('click', () => {
        message.remove();
    });
}

