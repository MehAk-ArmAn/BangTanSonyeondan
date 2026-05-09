// OT7 hidden navbar toggle
document.addEventListener('keydown', function(e) {
    if (e.key === '7') {
        const navbar = document.getElementById('secret-navbar');
        if (!navbar) return;
        navbar.style.display = (navbar.style.display === 'none') ? 'block' : 'none';
    }
});

// BTS Profile Shop Search + Filter

document.addEventListener("DOMContentLoaded", function () {

    const search = document.getElementById("assetSearch");
    const filter = document.getElementById("assetFilter");
    const cards = document.querySelectorAll(".asset-card");

    function runFilter() {

        const searchValue = search.value.toLowerCase();
        const filterValue = filter.value;

        cards.forEach(card => {

            const name = card.dataset.name;
            const type = card.dataset.type;

            const matchesSearch = name.includes(searchValue);
            const matchesType = filterValue === "all" || type === filterValue;

            if (matchesSearch && matchesType) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }

        });

    }

    search.addEventListener("input", runFilter);
    filter.addEventListener("change", runFilter);

});
