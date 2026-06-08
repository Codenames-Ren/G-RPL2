import { state, storeSession, clearSession, apiRequest } from './api.js';
import { roleOf, setMessage, validationMessage } from './utils.js';
import { syncNavigation, renderUser } from './navigation.js';

export function mergeUserProfile(profile) {
    return {
        ...(state.user || {}),
        ...profile,
        role: profile?.role || state.user?.role,
        roles: profile?.roles || state.user?.roles,
    };
}

function authPayload(mode, form) {
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    if (mode !== 'register') {
        return payload;
    }

    return {
        nik: payload.nik,
        name: payload.name,
        email: payload.email,
        phone: payload.phone,
        address: payload.address,
        password: payload.password,
        password_confirmation: payload.password_confirmation,
    };
}

function redirectToLogin() {
    const target = encodeURIComponent(window.location.pathname);
    window.location.assign(`/login?redirect=${target}`);
}

function requiredRole() {
    return document.body.dataset.roleRequired || '';
}

function isAuthorizedForPage(user) {
    const role = requiredRole();
    return !role || roleOf(user) === role;
}

function revealProtectedShell() {
    document.querySelectorAll('[data-protected-shell]').forEach((element) => {
        element.hidden = false;
    });
}

export async function hydrateAuthenticatedPage() {
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
        localStorage.setItem('grpl2_user', JSON.stringify(user));

        syncNavigation(user);
        renderUser(user);

        if (!isAuthorizedForPage(user)) {
            window.location.replace('/dashboard');
            return;
        }

        revealProtectedShell();
    } catch (error) {
        clearSession();
        redirectToLogin();
    }
}

export function bindAuthForms() {
    document.querySelectorAll('[data-auth-form]').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const mode = form.dataset.authForm;
            const button = form.querySelector('[data-submit-button]');
            const payload = authPayload(mode, form);

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
