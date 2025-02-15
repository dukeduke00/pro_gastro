const toggleSearch = (search, button) => {
    const searchBar = document.getElementById(search),
        searchButton = document.getElementById(button),
        headerH1 = document.getElementById('header_h1');

    searchButton.addEventListener('click', () => {
        // Dodajemo klasu show-search kako bismo proširili polje za pretragu
        searchBar.classList.toggle('show-search');
        // Dodajemo klasu hidden kako bismo sakrili naslov
        headerH1.classList.toggle('hidden');
    });
}
toggleSearch('search-bar', 'search-button');


const toggleProfileInfo = (profileInfoId, openButtonId, closeButtonId) => {
    const profileInfo = document.getElementById(profileInfoId),
        openButton = document.getElementById(openButtonId),
        closeButton = document.getElementById(closeButtonId);

    openButton.addEventListener('click', () => {
        profileInfo.classList.add('show_profile_info');
    });

    closeButton.addEventListener('click', () => {
        profileInfo.classList.remove('show_profile_info');
    });
}
toggleProfileInfo('profile-info', 'open-profile-info', 'close-profile-info');

document.addEventListener('DOMContentLoaded', function() {
    var pagination = document.querySelector('.pagination');
    if (pagination && pagination.children.length === 0) {
        pagination.classList.add('hidden');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const quantityForms = document.querySelectorAll('.quantity_form');

    quantityForms.forEach(form => {
        const minusBtn = form.querySelector('.minus');
        const plusBtn = form.querySelector('.plus');
        const quantityInput = form.querySelector('.quantity_input');

        // Generisanje jedinstvenog ključa za količinu svakog proizvoda
        const storageKey = 'quantity_' + quantityInput.dataset.productId;

        // Učitavanje sačuvane količine iz localStorage
        if (localStorage.getItem(storageKey)) {
            quantityInput.value = localStorage.getItem(storageKey);
        }

        minusBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                value--;
                quantityInput.value = value;
                localStorage.setItem(storageKey, value); // Čuvamo ažuriranu količinu
            }
        });

        plusBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            value++;
            quantityInput.value = value;
            localStorage.setItem(storageKey, value); // Čuvamo ažuriranu količinu
        });

        // Ažuriranje količine pri promeni vrednosti u input polju
        quantityInput.addEventListener('change', () => {
            localStorage.setItem(storageKey, quantityInput.value); // Čuvamo ažuriranu količinu
        });
    });
});
