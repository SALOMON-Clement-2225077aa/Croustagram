document.addEventListener('DOMContentLoaded', function() {
    var button = document.querySelector('button');
    var popup = document.getElementById('popup');

    button.addEventListener('click', function() {
        popup.style.display = 'block';
    });
});

// Fonction pour fermer le popup
function fermerPopup() {
    document.getElementById('popup').style.display = 'none';
}