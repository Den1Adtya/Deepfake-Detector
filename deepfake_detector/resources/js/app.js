import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/**
 * REALORNOT AI — NEON GLITCH INTERACTIONS
 * Lightweight, dependency-free micro-interactions. All motion respects
 * prefers-reduced-motion and is decorative only; application logic stays in Laravel.
 */
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;


/**
 * Lightweight Matrix Rain background for auth pages only.
 * Columns are generated only when the guest layout exposes data-matrix-pattern.
 */
function initAuthMatrixRain() {
    const matrix = document.querySelector('[data-matrix-pattern]');
    if (!matrix) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const characters = Array.from(
        'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲンABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
    );
    let resizeTimer = null;
    let lastColumnCount = 0;

    const buildColumns = () => {
        const mobile = window.matchMedia('(max-width: 768px)').matches;
        const spacing = mobile ? 29 : 34;
        const minimum = mobile ? 12 : 22;
        const maximum = mobile ? 20 : 48;
        const count = Math.min(maximum, Math.max(minimum, Math.ceil(window.innerWidth / spacing)));

        if (count === lastColumnCount && matrix.childElementCount) return;
        lastColumnCount = count;

        const fragment = document.createDocumentFragment();

        for (let index = 0; index < count; index += 1) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.setProperty('--matrix-left', `${(index / count) * 100}%`);

            // Slightly varied timing keeps the columns from moving in sync.
            const duration = 3.4 + ((index * 17) % 25) / 10;
            const delay = -(((index * 13) % 40) / 10);
            column.style.setProperty('--matrix-duration', `${duration.toFixed(1)}s`);
            column.style.setProperty('--matrix-delay', `${delay.toFixed(1)}s`);

            let stream = '';
            const streamLength = 58 + (index % 18);
            for (let charIndex = 0; charIndex < streamLength; charIndex += 1) {
                const charPosition = (index * 11 + charIndex * 7 + (charIndex % 5) * 3) % characters.length;
                stream += characters[charPosition];
            }
            column.dataset.stream = stream;

            if (reducedMotion) {
                column.style.animation = 'none';
                column.style.top = '0';
                column.style.opacity = '0.18';
            }

            fragment.appendChild(column);
        }

        matrix.replaceChildren(fragment);
    };

    buildColumns();

    // Rebuild only if viewport crosses a breakpoint/column-count threshold.
    window.addEventListener('resize', () => {
        window.clearTimeout(resizeTimer);
        resizeTimer = window.setTimeout(buildColumns, 180);
    }, { passive: true });

    // Pause decorative animation when the tab is hidden to reduce background work.
    document.addEventListener('visibilitychange', () => {
        if (reducedMotion) return;
        const playState = document.hidden ? 'paused' : 'running';
        matrix.querySelectorAll('.matrix-column').forEach(column => {
            column.style.animationPlayState = playState;
        });
    });
}

function initNeonInterface() {
    initAuthMatrixRain();

    const root = document.documentElement;
    root.classList.add('neon-js-ready');

    // Reveal cards and sections as they enter the viewport.
    const revealTargets = document.querySelectorAll(
        '[data-reveal], .neon-card, .feature-card, .app-page-heading, .site-landing section'
    );

    revealTargets.forEach((element, index) => {
        if (element.classList.contains('hidden')) return;
        if (element.closest('[x-show]') && element.offsetParent === null) return;
        element.classList.add('neon-reveal');
        element.style.setProperty('--reveal-delay', `${Math.min(index % 5, 4) * 65}ms`);
    });

    if ('IntersectionObserver' in window && !prefersReducedMotion) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -35px 0px' });

        document.querySelectorAll('.neon-reveal').forEach(element => revealObserver.observe(element));
    } else {
        document.querySelectorAll('.neon-reveal').forEach(element => element.classList.add('is-visible'));
    }

    // Animate dashboard metrics from zero to their real server-rendered values.
    document.querySelectorAll('[data-count-up]').forEach(element => {
        const target = Number(element.dataset.countUp);
        if (!Number.isFinite(target)) return;
        if (prefersReducedMotion) {
            element.textContent = target.toLocaleString('id-ID');
            return;
        }

        const duration = 850;
        const startTime = performance.now();
        const tick = now => {
            const progress = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = Math.round(target * eased).toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    });

    // Add a small click ripple to primary actions.
    document.addEventListener('click', event => {
        const button = event.target.closest('.neon-button, .neon-primary-button, [data-ripple]');
        if (!button || prefersReducedMotion) return;
        const rect = button.getBoundingClientRect();
        const ripple = document.createElement('span');
        ripple.className = 'neon-ripple';
        ripple.style.left = `${event.clientX - rect.left}px`;
        ripple.style.top = `${event.clientY - rect.top}px`;
        button.appendChild(ripple);
        window.setTimeout(() => ripple.remove(), 650);
    });

    // Navbar receives a slightly stronger glass surface after scrolling.
    const navbar = document.querySelector('.site-navbar');
    const updateNavbar = () => navbar?.classList.toggle('is-scrolled', window.scrollY > 18);
    updateNavbar();
    window.addEventListener('scroll', updateNavbar, { passive: true });

    // Drag-and-drop image upload plus immediate preview on the detection workspace.
    const fileInput = document.getElementById('imageInput');
    const dropzone = document.getElementById('uploadDropzone');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('imagePreview');
    const fileName = document.getElementById('selectedFileName');

    if (fileInput && dropzone) {
        const showPreview = file => {
            if (!file || !file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = () => {
                if (previewImage) previewImage.src = reader.result;
                if (previewContainer) previewContainer.classList.remove('hidden');
                if (fileName) fileName.textContent = file.name;
                dropzone.classList.add('has-file');
                dropzone.setAttribute('data-state', 'ready');
            };
            reader.readAsDataURL(file);
        };

        fileInput.addEventListener('change', () => showPreview(fileInput.files?.[0]));
        ['dragenter', 'dragover'].forEach(type => dropzone.addEventListener(type, event => {
            event.preventDefault();
            event.stopPropagation();
            dropzone.classList.add('is-dragover');
        }));
        ['dragleave', 'dragend', 'drop'].forEach(type => dropzone.addEventListener(type, event => {
            event.preventDefault();
            event.stopPropagation();
            dropzone.classList.remove('is-dragover');
        }));
        dropzone.addEventListener('drop', event => {
            const file = event.dataTransfer?.files?.[0];
            if (!file || !file.type.startsWith('image/')) return;
            try {
                const transfer = new DataTransfer();
                transfer.items.add(file);
                fileInput.files = transfer.files;
            } catch (_) {
                // Preview still works if the browser does not allow assigning FileList.
            }
            showPreview(file);
        });
    }

    // Remove the selected file and return the upload workspace to its initial state.
    const clearUploadButton = document.getElementById('clearUploadButton');
    if (clearUploadButton && fileInput) {
        clearUploadButton.addEventListener('click', () => {
            fileInput.value = '';
            if (previewImage) previewImage.src = '';
            previewContainer?.classList.add('hidden');
            dropzone?.classList.remove('has-file');
            dropzone?.setAttribute('data-state', 'empty');
            if (fileName) fileName.textContent = 'No file selected';
        });
    }

  // Keep the upload submit state in one place.
const uploadForm = document.getElementById('uploadForm');

if (uploadForm) {
    uploadForm.addEventListener('submit', () => {
        const submitButton = document.getElementById('submitBtn');
        const loading = document.getElementById('btnLoading');

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('is-loading');
            submitButton.setAttribute('aria-busy', 'true');
        }

        // Jangan sembunyikan btnText agar animasi glitch tetap berjalan.
        if (loading) {
            loading.classList.remove('hidden');
            loading.classList.add('inline-flex');
        }
    });
}

    // Instant table filtering supplements (does not replace) the existing GET search route.
    const historySearch = document.getElementById('historyLiveSearch');
    const historyRows = [...document.querySelectorAll('[data-history-row]')];
    const noHistoryMatch = document.getElementById('historyNoMatch');
    if (historySearch && historyRows.length) {
        historySearch.addEventListener('input', () => {
            const query = historySearch.value.trim().toLocaleLowerCase();
            let visible = 0;
            historyRows.forEach(row => {
                const match = row.textContent.toLocaleLowerCase().includes(query);
                row.classList.toggle('hidden', !match);
                if (match) visible++;
            });
            noHistoryMatch?.classList.toggle('hidden', visible !== 0);
        });
    }

    // Copy-to-clipboard helper for hashes and technical identifiers.
    document.querySelectorAll('[data-copy]').forEach(button => {
        button.addEventListener('click', async () => {
            const value = button.dataset.copy || '';
            if (!value) return;
            try {
                await navigator.clipboard.writeText(value);
                const original = button.textContent;
                button.textContent = 'Copied';
                button.classList.add('is-copied');
                window.setTimeout(() => {
                    button.textContent = original;
                    button.classList.remove('is-copied');
                }, 1400);
            } catch (_) {
                button.textContent = 'Copy unavailable';
            }
        });
    });

    // Accessible image lightbox for original images and Grad-CAM visualizations.
    document.querySelectorAll('[data-image-zoom]').forEach(image => {
        image.classList.add('zoomable-image');
        image.setAttribute('tabindex', '0');
        image.setAttribute('role', 'button');
        image.setAttribute('aria-label', 'Open image preview');

        const openLightbox = () => {
            const overlay = document.createElement('div');
            overlay.className = 'neon-lightbox';
            overlay.setAttribute('role', 'dialog');
            overlay.setAttribute('aria-modal', 'true');
            overlay.setAttribute('aria-label', 'Image preview');

            const closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.className = 'neon-lightbox__close';
            closeButton.setAttribute('aria-label', 'Close image preview');
            closeButton.textContent = '×';

            const largeImage = document.createElement('img');
            largeImage.src = image.currentSrc || image.src;
            largeImage.alt = image.alt || 'Image preview';

            const caption = document.createElement('p');
            caption.textContent = `${image.alt || 'Image preview'} · Click or press Esc to close`;

            overlay.append(closeButton, largeImage, caption);
            document.body.appendChild(overlay);
            document.body.classList.add('lightbox-open');
            const close = () => {
                overlay.remove();
                document.body.classList.remove('lightbox-open');
                document.removeEventListener('keydown', onKey);
                image.focus();
            };
            overlay.addEventListener('click', event => {
                if (event.target === overlay || event.target === closeButton) close();
            });
            const onKey = event => {
                if (event.key === 'Escape') close();
            };
            document.addEventListener('keydown', onKey);
            closeButton.focus();
        };

        image.addEventListener('click', openLightbox);
        image.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openLightbox();
            }
        });
    });

    // Animate confidence / anomaly meters when their panel is revealed.
    document.querySelectorAll('[data-meter-width]').forEach(meter => {
        const width = meter.dataset.meterWidth;
        if (width) meter.style.setProperty('--meter-width', `${Math.max(0, Math.min(100, Number(width)))}%`);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNeonInterface, { once: true });
} else {
    initNeonInterface();
}

