// BangTanSonyeondan public UI helpers
(function () {
    'use strict';

    document.addEventListener('keydown', function (e) {
        if (e.key !== '7') return;

        const navbar = document.getElementById('secret-navbar');
        if (!navbar) return;

        navbar.style.display = navbar.style.display === 'none' ? 'block' : 'none';
    });

    document.addEventListener('DOMContentLoaded', function () {
        setupProfileAssetFilters();
        setupProfileLivePreview();
    });

    function setupProfileAssetFilters() {
        const search = document.getElementById('assetSearch');
        const filter = document.getElementById('assetFilter');
        const cards = document.querySelectorAll('.asset-card');

        if (!search || !filter || !cards.length) return;

        function runFilter() {
            const searchValue = (search.value || '').toLowerCase().trim();
            const filterValue = filter.value || 'all';

            cards.forEach(function (card) {
                const name = (card.dataset.name || '').toLowerCase();
                const type = (card.dataset.type || '').toLowerCase();
                const matchesSearch = !searchValue || name.includes(searchValue);
                const matchesType = filterValue === 'all' || type === filterValue;

                card.style.display = matchesSearch && matchesType ? '' : 'none';
            });
        }

        search.addEventListener('input', runFilter);
        filter.addEventListener('change', runFilter);
        runFilter();
    }

    function setupProfileLivePreview() {
        const form = document.getElementById('armyProfileForm');
        const previewCard = document.getElementById('profilePreviewCard');
        if (!form || !previewCard) return;

        const nameInput = document.getElementById('profileNameInput');
        const usernameInput = document.getElementById('profileUsernameInput');
        const bioInput = document.getElementById('profileBioInput');
        const bioCount = document.getElementById('bioCount');
        const previewName = document.getElementById('profilePreviewName');
        const previewBio = document.getElementById('profilePreviewBio');
        const previewAsset = document.getElementById('profilePreviewAsset');
        const previewAvatar = document.getElementById('profilePreviewAvatar');
        const choiceCards = form.querySelectorAll('.profile-choice-card');

        function assetUrl(path) {
            if (!path) return '';
            if (/^(https?:)?\/\//i.test(path) || path.startsWith('/')) return path;

            const base = document.querySelector('meta[name="app-url"]')?.content || window.location.origin;
            return base.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
        }

        const originalPreviewBio = previewBio?.textContent?.trim() || '';

        function updateTextPreview() {
            const username = (usernameInput?.value || '').trim();
            const displayName = (nameInput?.value || '').trim();
            const bio = (bioInput?.value || '').trim();

            if (previewName) {
                previewName.textContent = username || displayName || 'ARMY profile';
            }

            if (previewBio) {
                previewBio.textContent = bio || originalPreviewBio;
            }

            if (bioCount && bioInput) {
                bioCount.textContent = bioInput.value.length;
            }
        }

        function selectChoice(card) {
            choiceCards.forEach(function (item) {
                item.classList.remove('is-selected');
            });
            card.classList.add('is-selected');

            const radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            const gradient = card.dataset.gradient;
            const theme = card.dataset.theme;
            const avatar = card.dataset.avatar;
            const label = card.dataset.label || 'Selected profile vibe';

            if (gradient) previewCard.style.setProperty('--profile-card-gradient', gradient);
            if (theme) previewCard.dataset.theme = theme;
            if (previewAsset) previewAsset.textContent = label;

            if (previewAvatar && avatar) {
                previewAvatar.src = assetUrl(avatar);
                previewAvatar.alt = label;
            }
        }

        [nameInput, usernameInput, bioInput].forEach(function (input) {
            if (!input) return;
            input.addEventListener('input', updateTextPreview);
        });

        choiceCards.forEach(function (card) {
            card.addEventListener('click', function () {
                selectChoice(card);
            });

            const radio = card.querySelector('input[type="radio"]');
            if (radio && radio.checked) selectChoice(card);
        });

        updateTextPreview();
    }
})();
