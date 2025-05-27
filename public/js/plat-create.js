document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('modal');
    const overlay = document.getElementById('overlay');
    const errorsDiv = document.getElementById('errors');

    function openModal() {
        modal.style.display = 'block';
        overlay.style.display = 'block';
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
        modal.style.display = 'none';
        overlay.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        errorsDiv.style.display = 'none';
        errorsDiv.innerHTML = '';
        document.getElementById('platForm').reset();
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    document.getElementById('platForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let nom = this.name.value.trim();
        let description = this.description.value.trim();
        let prix = this.prix.value.trim();
        let categorie = this.categorie_id.value;

        let errors = [];

        if (!nom) errors.push("Le nom du plat est requis.");
        if (!description) errors.push("La description est requise.");
        if (!prix || isNaN(prix) || prix <= 0) errors.push("Le prix doit être un nombre positif.");
        if (!categorie) errors.push("La catégorie doit être sélectionnée.");

        if (errors.length > 0) {
            errorsDiv.style.display = 'block';
            errorsDiv.innerHTML = '<ul><li>' + errors.join('</li><li>') + '</li></ul>';
            return;
        }

        this.submit();
    });
});
