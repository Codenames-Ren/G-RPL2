import { roleOf } from './utils.js';
import { state, apiRequest, clearSession } from './api.js';
import Swal from 'sweetalert2';

export function userRole(user) {
    return formatRole(roleOf(user));
}

export function userProfile(user) {
    if (user?.assessor) {
        return user.assessor;
    }

    if (user?.staff_rpl) {
        return user.staff_rpl;
    }

    if (user?.staffRpl) {
        return user.staffRpl;
    }

    if (user?.committee) {
        return user.committee;
    }

    return {};
}

function formatRole(role) {
    if (!role) {
        return 'No Role';
    }

    return role
        .replaceAll('_', ' ')
        .split(' ')
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}

function isActiveLink(href, currentPath) {
    if (!href) {
        return false;
    }

    if (href === '/dashboard') {
        return currentPath === href;
    }

    return currentPath === href || currentPath.startsWith(`${href}/`);
}

export function bindLogout() {
    document.querySelectorAll('[data-logout]').forEach((button) => {
        if (button.dataset.logoutBound === 'true') {
            return;
        }

        button.dataset.logoutBound = 'true';

        button.addEventListener('click', async () => {
            const confirm = await Swal.fire({
                icon: 'question',
                title: 'Keluar',
                text: 'Kamu yakin ingin keluar dari aplikasi?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
            });

            if (!confirm.isConfirmed) {
                return;
            }

            button.disabled = true;

            try {
                if (state.token) {
                    await apiRequest('/auth/logout', { method: 'POST' });
                }
            } catch {
                // Session lokal tetap dibersihkan walaupun token server sudah invalid.
            } finally {
                clearSession();
                window.location.assign('/login');
            }
        });
    });
}

function syncPublicPrivateNavigation(hasSession, currentRole) {
    document.querySelectorAll('[data-public-nav]').forEach((element) => {
        element.hidden = hasSession;
    });

    document.querySelectorAll('[data-private-nav]').forEach((element) => {
        element.hidden = !hasSession;
    });

    document.querySelectorAll('[data-role-link]').forEach((element) => {
        element.hidden = !hasSession || !currentRole || element.dataset.roleLink !== currentRole;
    });
}

function syncActiveLinks() {
    const currentPath = window.location.pathname;

    document.querySelectorAll('[data-nav-link]').forEach((element) => {
        const href = element.getAttribute('href');

        element.classList.toggle('active', isActiveLink(href, currentPath));
    });

    document.querySelectorAll('[data-admin-sidebar-link]').forEach((element) => {
        const href = element.getAttribute('href');

        element.classList.toggle('active', isActiveLink(href, currentPath));
    });
}

export function syncNavigation(user = state.user) {
    const hasSession = Boolean(state.token && user);
    const currentRole = roleOf(user);

    syncPublicPrivateNavigation(hasSession, currentRole);
    syncActiveLinks();
    bindLogout();
}

export function renderUser(user) {
    const currentRole = roleOf(user);
    const formattedRole = formatRole(currentRole);

    document.querySelectorAll('[data-user-name]').forEach((element) => {
        element.textContent = user?.name || 'User';
    });

    document.querySelectorAll('[data-user-role]').forEach((element) => {
        element.textContent = formattedRole;
    });

    document.querySelectorAll('[data-api-status]').forEach((element) => {
        element.textContent = 'Connected';
        element.dataset.status = 'connected';
    });

    document.querySelectorAll('[data-role-card]').forEach((element) => {
        element.hidden = !currentRole || element.dataset.roleCard !== currentRole;
    });

    syncNavigation(user);
}