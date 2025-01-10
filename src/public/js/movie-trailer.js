const modal = document.getElementById('modal');
const modalCloseButton = document.getElementById('modal-close-button');
const frame = document.getElementById('frame');
const trailerButtons = Array.from(document.getElementsByClassName('trailer-button'));
console.log(trailerButtons);

trailerButtons.forEach(button => {
    button.addEventListener('click', () => {
        modal.classList.remove('modal');
        const trailerLink = button.getAttribute('data-trailer_link');
        frame.src = `https://www.youtube.com/embed/${trailerLink}`;
    })
});

modalCloseButton.addEventListener('click', () => {
    modal.classList.add('modal');
    frame.src = '';
});
