import { roleOf, escapeHtml } from './utils.js';
import { state, apiRequest, clearSession } from './api.js';

export function userRole(user) {
    return roleOf(user).replaceAll('_', ' ');
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

function navigationItemsForRole(role) {
    const shared = [
        { href: '/dashboard', label: 'Dashboard' },
    ];

    const roleItems = {
        applicant: [
            { href: '/profile', label: 'Profile' },
            { href: '/applications', label: 'Applications' },
            { href: '/applications/create', label: 'Create Application' },
        ],
        assessor: [
            { href: '/assessments', label: 'Assessments' },
        ],
        committee: [
            { href: '/approvals', label: 'Approvals' },
            { href: '/approvals/approved', label: 'Approved' },
        ],
        staff_rpl: [
            { href: '/submissions', label: 'Submissions' },
        ],
        system_admin: [
            { href: '/admin/users', label: 'Users' },
            { href: '/admin/master-data', label: 'Master Data' },
            { href: '/admin/study-programs', label: 'Study Programs' },
            { href: '/admin/courses', label: 'Courses' },
        ],
    };

    return [
        ...shared,
        ...(roleItems[role] || []),
    ];
}

function isActiveSidebarItem(href, currentPath) {
    if (href === '/dashboard') {
        return currentPath === href;
    }

    return currentPath === href || currentPath.startsWith(`${href}/`);
}

export function bindLogout() {
    document.querySelectorAll('[data-logout]').forEach((button) => {
        button.addEventListener('click', async () => {
            button.disabled = true;

            try {
                if (state.token) {
                    await apiRequest('/auth/logout', { method: 'POST' });
                }
            } catch {
                // Local session is cleared even if the token is already invalid server-side.
            } finally {
                clearSession();
                window.location.assign('/login');
            }
        });
    });
}

function renderSidebarNavigation(user) {
    const role = roleOf(user);
    const currentPath = window.location.pathname;
    const items = navigationItemsForRole(role);
    const activeItem = items
        .filter((item) => isActiveSidebarItem(item.href, currentPath))
        .sort((a, b) => b.href.length - a.href.length)[0];

    document.querySelectorAll('.sidebar').forEach((sidebar) => {
        sidebar.querySelector('[data-sidebar-nav]')?.remove();

        if (!state.token || !user || !items.length) {
            return;
        }

        const nav = document.createElement('nav');
        nav.className = 'sidebar-nav';
        nav.dataset.sidebarNav = '';
        nav.setAttribute('aria-label', 'Role navigation');

        nav.innerHTML = `
            <span class="sidebar-nav-label">Menu</span>
            ${items.map((item) => `
                <a href="${item.href}" class="${activeItem?.href === item.href ? 'active' : ''}" data-nav-link>
                    ${item.label}
                </a>
            `).join('')}
            <button type="button" data-logout>Logout</button>
        `;

        sidebar.appendChild(nav);
    });

    bindLogout();
}

export function syncNavigation(user = state.user) {
    const hasSession = Boolean(state.token && user);
    const currentPath = window.location.pathname;
    const userRole = roleOf(user);

    document.querySelectorAll('[data-public-nav]').forEach((element) => {
        element.hidden = hasSession;
    });

    document.querySelectorAll('[data-private-nav], [data-logout]').forEach((element) => {
        element.hidden = !hasSession;
    });

    document.querySelectorAll('[data-role-link]').forEach((element) => {
        element.hidden = !hasSession || !userRole || element.dataset.roleLink !== userRole;
    });

    document.querySelectorAll('[data-nav-link]').forEach((element) => {
        element.classList.toggle('active', element.getAttribute('href') === currentPath);
    });

    renderSidebarNavigation(user);
}

export function renderUser(user) {
    const currentRole = roleOf(user);

    document.querySelectorAll('[data-user-name]').forEach((element) => {
        element.textContent = user?.name || 'User';
    });

    document.querySelectorAll('[data-user-role]').forEach((element) => {
        element.textContent = currentRole || 'No role';
    });

    document.querySelectorAll('[data-api-status]').forEach((element) => {
        element.textContent = 'Connected';
        element.dataset.status = 'connected';
    });

    document.querySelectorAll('[data-role-card]').forEach((element) => {
        element.hidden = !currentRole || element.dataset.roleCard !== currentRole;
    });
}
