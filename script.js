document.getElementById('bhk').addEventListener('change', function() {
    const sizeOptions = document.getElementById('sizeOptions');
    if (this.value === '2bhk' || this.value === '3bhk') {
        sizeOptions.classList.remove('hidden');
    } else {
        sizeOptions.classList.add('hidden');
    }
});

function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function hideModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
