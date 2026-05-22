const TOKEN_KEY = 'grpl2_token';
const USER_KEY = 'grpl2_user';

const state = {
    token: localStorage.getItem(TOKEN_KEY),
    user: readStoredUser(),
};

function readStoredUser() {
    try {
        return JSON.parse(localStorage.getItem(USER_KEY) || 'null');
    } catch {
        return null;
    }
}

function storeSession(token, user) {
    state.token = token;
    state.user = user;
    localStorage.setItem(TOKEN_KEY, token);
    localStorage.setItem(USER_KEY, JSON.stringify(user));
}

function clearSession() {
    state.token = null;
    state.user = null;
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(USER_KEY);
}

async function apiRequest(path, options = {}) {
    const headers = {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        ...(options.headers || {}),
    };

    if (state.token) {
        headers.Authorization = `Bearer ${state.token}`;
    }

    const response = await fetch(`/api${path}`, {
        ...options,
        headers,
    });

    const contentType = response.headers.get('content-type') || '';
    const payload = contentType.includes('application/json')
        ? await response.json()
        : {};

    if (!response.ok) {
        const error = new Error(payload.message || 'Request failed');
        error.status = response.status;
        error.payload = payload;
        throw error;
    }

    return payload;
}

function roleOf(user) {
    const firstRole = user?.roles?.[0];

    if (typeof user?.role === 'string') {
        return user.role;
    }

    if (typeof firstRole === 'string') {
        return firstRole;
    }

    return firstRole?.name || '';
}

function mergeUserProfile(profile) {
    return {
        ...(state.user || {}),
        ...profile,
        role: profile?.role || state.user?.role,
        roles: profile?.roles || state.user?.roles,
    };
}

function setMessage(form, message, type = 'error') {
    const target = form.querySelector('[data-form-message]');
    if (!target) {
        return;
    }

    target.textContent = message;
    target.dataset.type = type;
}

function validationMessage(error) {
    const errors = error?.payload?.errors;
    if (!errors) {
        return error.message || 'Request failed';
    }

    return Object.values(errors)
        .flat()
        .filter(Boolean)
        .join(' ');
}

function syncNavigation(user = state.user) {
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
        element.hidden = !hasSession || (userRole && element.dataset.roleLink !== userRole);
    });

    document.querySelectorAll('[data-nav-link]').forEach((element) => {
        element.classList.toggle('active', element.getAttribute('href') === currentPath);
    });
}

function renderUser(user) {
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
        element.hidden = Boolean(currentRole) && element.dataset.roleCard !== currentRole;
    });
}

function redirectToLogin() {
    const target = encodeURIComponent(window.location.pathname);
    window.location.assign(`/login?redirect=${target}`);
}

async function hydrateAuthenticatedPage() {
    if (!document.body.dataset.authRequired || document.body.dataset.authRequired !== 'true') {
        syncNavigation();
        return;
    }

    if (!state.token) {
        redirectToLogin();
        return;
    }

    try {
        const response = await apiRequest('/auth/me');
        const user = mergeUserProfile(response.data);
        state.user = user;
        localStorage.setItem(USER_KEY, JSON.stringify(user));

        syncNavigation(user);
        renderUser(user);
    } catch (error) {
        clearSession();
        redirectToLogin();
    }
}

function bindAuthForms() {
    document.querySelectorAll('[data-auth-form]').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const mode = form.dataset.authForm;
            const button = form.querySelector('[data-submit-button]');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());

            button.disabled = true;
            setMessage(form, 'Memproses...', 'info');

            try {
                if (mode === 'login') {
                    const response = await apiRequest('/auth/login', {
                        method: 'POST',
                        body: JSON.stringify(payload),
                    });

                    if (!response.success || !response.token) {
                        setMessage(form, response.message || 'Login gagal', 'error');
                        return;
                    }

                    storeSession(response.token, response.user);
                    const redirect = new URLSearchParams(window.location.search).get('redirect') || '/dashboard';
                    window.location.assign(redirect);
                    return;
                }

                const response = await apiRequest('/auth/register', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                });

                if (response.success) {
                    form.reset();
                    setMessage(
                        form,
                        `${response.message}. Silakan cek email verifikasi sebelum login.`,
                        'success'
                    );
                    return;
                }

                setMessage(form, response.message || 'Register gagal', 'error');
            } catch (error) {
                setMessage(form, validationMessage(error), 'error');
            } finally {
                button.disabled = false;
            }
        });
    });
}

function bindLogout() {
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

function boot() {
    syncNavigation();
    bindAuthForms();
    bindLogout();
    hydrateAuthenticatedPage();
}

document.addEventListener('DOMContentLoaded', boot);
