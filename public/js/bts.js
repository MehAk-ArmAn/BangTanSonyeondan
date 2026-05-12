// BangTanSonyeondan public UI helpers
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        setupFlashAlerts();
        setupProfileLivePreview();
        setupProfileSharing();
        setupNavDropdownClose();
        setupSmartNavbar();
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
        const previewBadge = document.getElementById('profilePreviewBadge');
        const previewAvatar = document.getElementById('profilePreviewAvatar');
        const choiceCards = form.querySelectorAll('.profile-choice-card');
        const originalPreviewBio = previewBio?.textContent?.trim() || '';

        function assetUrl(path) {
            if (!path) return '';
            if (/^(https?:)?\/\//i.test(path) || path.startsWith('/')) return path;
            const base = document.querySelector('meta[name="app-url"]')?.content || window.location.origin;
            return base.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
        }

        function profileName(value) {
            return (value || '').trim() || 'ARMY profile';
        }

        function updateTextPreview() {
            const username = (usernameInput?.value || '').trim();
            const displayName = (nameInput?.value || '').trim();
            const bio = (bioInput?.value || '').trim();

            if (previewName) previewName.textContent = profileName(username || displayName);
            if (previewBio) previewBio.textContent = bio || originalPreviewBio;
            if (bioCount && bioInput) bioCount.textContent = bioInput.value.length;
        }

        function clearSelected(role) {
            choiceCards.forEach(function (item) {
                if (item.dataset.previewRole === role) item.classList.remove('is-selected');
            });
        }

        function selectChoice(card) {
            const role = card.dataset.previewRole || 'asset';
            clearSelected(role);
            card.classList.add('is-selected');

            const radio = card.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            const gradient = card.dataset.gradient;
            const theme = card.dataset.theme;
            const avatar = card.dataset.avatar;
            const badge = card.dataset.badge;

            if (role === 'theme' && gradient) previewCard.style.setProperty('--profile-card-gradient', gradient);
            if (role === 'theme' && theme) previewCard.dataset.theme = theme;
            if (role === 'avatar' && previewAvatar && avatar) previewAvatar.src = assetUrl(avatar);
            if (role === 'badge' && previewBadge && badge) previewBadge.textContent = badge;
        }

        [nameInput, usernameInput, bioInput].forEach(function (input) {
            if (input) input.addEventListener('input', updateTextPreview);
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

})();
