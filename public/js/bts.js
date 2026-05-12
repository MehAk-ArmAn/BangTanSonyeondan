// BangTanSonyeondan public UI helpers
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        setupFlashAlerts();
        setupProfileLivePreview();
        setupProfileSharing();
        setupNavDropdownClose();
        setupSmartNavbar();
        setupUpdateSharing();
    });

    function setupFlashAlerts() {
        const flash = document.getElementById('flashData');
        if (!flash || typeof Swal === 'undefined') return;

        const success = (flash.dataset.success || '').trim();
        const error = (flash.dataset.error || '').trim();

        if (success) {
            Swal.fire({
                icon: 'success',
                title: 'Saved',
                text: success,
                confirmButtonText: 'Okay',
                background: '#120724',
                color: '#fff7ff',
                confirmButtonColor: '#a855f7'
            });
            return;
        }

        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: error,
                confirmButtonText: 'Fix it',
                background: '#120724',
                color: '#fff7ff',
                confirmButtonColor: '#ec4899'
            });
        }
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
        const previewAvatar = document.getElementById('profilePreviewAvatar');
        const previewAsset = document.getElementById('profilePreviewAsset');

        const searchInput = document.getElementById('assetSearch');
        const filterSelect = document.getElementById('assetFilter');
        const cards = Array.from(form.querySelectorAll('.profile-choice-card'));

        const originalPreviewBio = previewBio?.textContent?.trim() || '';

        function assetUrl(path) {
            if (!path) return '';

            if (/^(https?:)?\/\//i.test(path) || path.startsWith('/')) {
                return path;
            }

            const base = document.querySelector('meta[name="app-url"]')?.content || window.location.origin;

            return base.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
        }

        function cleanName(value) {
            return (value || '').trim() || 'ARMY profile';
        }

        function updateTextPreview() {
            const username = (usernameInput?.value || '').trim();
            const displayName = (nameInput?.value || '').trim();
            const bio = (bioInput?.value || '').trim();

            if (previewName) {
                previewName.textContent = cleanName(username || displayName);
            }

            if (previewBio) {
                previewBio.textContent = bio || originalPreviewBio;
            }

            if (bioCount && bioInput) {
                bioCount.textContent = bioInput.value.length;
            }
        }

        function selectCard(card) {
            cards.forEach(item => item.classList.remove('is-selected'));
            card.classList.add('is-selected');

            const radio = card.querySelector('input[type="radio"]');

            if (radio) {
                radio.checked = true;
            }

            const label = card.dataset.label || 'Selected profile vibe';
            const avatar = card.dataset.avatar || '';
            const theme = card.dataset.theme || '';
            const gradient = card.dataset.gradient || '';

            if (previewAsset) {
                previewAsset.textContent = label;
            }

            if (gradient) {
                previewCard.style.setProperty('--profile-card-gradient', gradient);
            }

            if (theme) {
                previewCard.className = previewCard.className
                    .split(' ')
                    .filter(className => !['galaxy-purple', 'galaxy-stage', 'night-black', 'crimson-stage'].includes(className))
                    .join(' ');

                previewCard.classList.add(theme);
            }

            if (avatar && previewAvatar) {
                previewAvatar.src = assetUrl(avatar);
                previewAvatar.style.display = 'block';
            }
        }

        function filterCards() {
            const query = (searchInput?.value || '').trim().toLowerCase();
            const type = (filterSelect?.value || 'all').toLowerCase();

            cards.forEach(card => {
                const cardText = (card.dataset.name || '').toLowerCase();
                const cardType = (card.dataset.type || '').toLowerCase();

                const matchesSearch = query === '' || cardText.includes(query);
                const matchesType = type === 'all' || cardType === type;

                card.style.display = matchesSearch && matchesType ? '' : 'none';
            });
        }

        [nameInput, usernameInput, bioInput].forEach(input => {
            if (input) {
                input.addEventListener('input', updateTextPreview);
                input.addEventListener('keyup', updateTextPreview);
                input.addEventListener('change', updateTextPreview);
            }
        });

        cards.forEach(card => {
            card.addEventListener('click', function () {
                selectCard(card);
            });

            const radio = card.querySelector('input[type="radio"]');

            if (radio) {
                radio.addEventListener('change', function () {
                    selectCard(card);
                });

                if (radio.checked) {
                    selectCard(card);
                }
            }
        });

        if (searchInput) {
            searchInput.addEventListener('input', filterCards);
        }

        if (filterSelect) {
            filterSelect.addEventListener('change', filterCards);
        }

        updateTextPreview();
        filterCards();
    }

    function setupProfileSharing() {
        document.querySelectorAll('.js-share-profile').forEach(function (button) {
            button.addEventListener('click', async function () {
                const url = button.dataset.shareUrl || window.location.href;
                const title = button.dataset.shareTitle || document.title;

                try {
                    if (navigator.share) {
                        await navigator.share({ title, url });
                    } else if (navigator.clipboard) {
                        await navigator.clipboard.writeText(url);
                        showToast('Profile link copied.');
                    } else {
                        window.prompt('Copy this profile link:', url);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') showToast('Could not share right now.');
                }
            });
        });
    }

    function setupNavDropdownClose() {
        document.addEventListener('click', function (event) {
            document.querySelectorAll('.nav-more[open]').forEach(function (dropdown) {
                if (!dropdown.contains(event.target)) dropdown.removeAttribute('open');
            });
        });
    }

    function showToast(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1800,
                background: '#120724',
                color: '#fff7ff'
            });
            return;
        }

        alert(message);
    }

    function setupSmartNavbar() {
        const header = document.getElementById('smartSiteHeader');
        const nav = document.getElementById('smartSiteNav');
        const visible = document.getElementById('smartNavVisible');
        const hidden = document.getElementById('smartNavHidden');
        const more = document.getElementById('smartNavMore');

        if (!header || !nav || !visible || !hidden || !more) return;

        const safeGap = 10;
        let allItems = Array.from(visible.querySelectorAll('.smart-nav-item'));

        allItems.forEach(function (item, index) {
            item.dataset.navOrder = item.dataset.navOrder || index;
        });

        function sortItems() {
            Array.from(visible.querySelectorAll('.smart-nav-item'))
                .sort(function (a, b) {
                    return Number(a.dataset.navOrder) - Number(b.dataset.navOrder);
                })
                .forEach(function (item) {
                    visible.appendChild(item);
                });

            Array.from(hidden.querySelectorAll('.smart-nav-item'))
                .sort(function (a, b) {
                    return Number(a.dataset.navOrder) - Number(b.dataset.navOrder);
                })
                .forEach(function (item) {
                    hidden.appendChild(item);
                });
        }

        function restoreAllItems() {
            allItems
                .sort(function (a, b) {
                    return Number(a.dataset.navOrder) - Number(b.dataset.navOrder);
                })
                .forEach(function (item) {
                    visible.appendChild(item);
                });

            hidden.innerHTML = '';
            more.hidden = true;
            more.removeAttribute('open');
        }

        function isCramped() {
            const navRect = nav.getBoundingClientRect();
            const visibleRect = visible.getBoundingClientRect();
            const moreRect = more.hidden ? { width: 0 } : more.getBoundingClientRect();

            const totalNeeded = visible.scrollWidth + moreRect.width + safeGap;
            const available = navRect.width;

            if (totalNeeded > available) {
                return true;
            }

            const nextElement = nav.nextElementSibling;
            if (nextElement) {
                const nextRect = nextElement.getBoundingClientRect();
                const distance = nextRect.left - navRect.right;

                if (distance < safeGap && window.innerWidth > 1180) {
                    return true;
                }
            }

            if (visibleRect.right > navRect.right - safeGap) {
                return true;
            }

            return false;
        }

        function moveLastVisibleToMore() {
            const items = Array.from(visible.querySelectorAll('.smart-nav-item'));
            const last = items[items.length - 1];

            if (!last) return false;

            more.hidden = false;
            hidden.prepend(last);
            sortItems();

            return true;
        }

        function moveFirstHiddenBack() {
            const hiddenItems = Array.from(hidden.querySelectorAll('.smart-nav-item'))
                .sort(function (a, b) {
                    return Number(a.dataset.navOrder) - Number(b.dataset.navOrder);
                });

            const firstHidden = hiddenItems[0];

            if (!firstHidden) return false;

            visible.appendChild(firstHidden);
            sortItems();

            if (hidden.querySelectorAll('.smart-nav-item').length === 0) {
                more.hidden = true;
                more.removeAttribute('open');
            }

            return true;
        }

        function balanceNavbar() {
            restoreAllItems();

            more.hidden = false;

            let guard = 0;

            while (isCramped() && visible.querySelectorAll('.smart-nav-item').length > 0 && guard < 80) {
                moveLastVisibleToMore();
                guard++;
            }

            let movedBack = true;
            guard = 0;

            while (movedBack && hidden.querySelectorAll('.smart-nav-item').length > 0 && guard < 80) {
                movedBack = moveFirstHiddenBack();

                if (isCramped()) {
                    moveLastVisibleToMore();
                    movedBack = false;
                }

                guard++;
            }

            if (hidden.querySelectorAll('.smart-nav-item').length === 0) {
                more.hidden = true;
                more.removeAttribute('open');
            }

            sortItems();
        }

        const debouncedBalance = debounce(balanceNavbar, 80);

        window.addEventListener('resize', debouncedBalance);
        window.addEventListener('orientationchange', debouncedBalance);

        if ('ResizeObserver' in window) {
            const observer = new ResizeObserver(debouncedBalance);
            observer.observe(header);
            observer.observe(nav);
        }

        balanceNavbar();
        setTimeout(balanceNavbar, 150);
        setTimeout(balanceNavbar, 600);
    }

    function debounce(callback, delay) {
        let timer = null;

        return function () {
            clearTimeout(timer);
            timer = setTimeout(callback, delay);
        };
    }

    function setupUpdateSharing() {
        document.querySelectorAll('.js-share-update').forEach(function (button) {
            button.addEventListener('click', async function () {
                const url = button.dataset.shareUrl || window.location.href;
                const title = button.dataset.shareTitle || document.title;

                try {
                    if (navigator.share) {
                        await navigator.share({ title, url });
                    } else if (navigator.clipboard) {
                        await navigator.clipboard.writeText(url);

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Update link copied',
                                showConfirmButton: false,
                                timer: 1800,
                                background: '#120724',
                                color: '#fff7ff'
                            });
                        } else {
                            alert('Update link copied');
                        }
                    } else {
                        window.prompt('Copy this update link:', url);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        alert('Could not share right now.');
                    }
                }
            });
        });
    }

})();
