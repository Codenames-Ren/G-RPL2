export const TOKEN_KEY = 'grpl2_token';
export const USER_KEY = 'grpl2_user';

export const state = {
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

export function storeSession(token, user) {
    state.token = token;
    state.user = user;
    localStorage.setItem(TOKEN_KEY, token);
    localStorage.setItem(USER_KEY, JSON.stringify(user));
}

export function clearSession() {
    state.token = null;
    state.user = null;
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(USER_KEY);
}

export async function apiRequest(path, options = {}) {
    const hasFormData = options.body instanceof FormData;
    const headers = {
        Accept: 'application/json',
        ...(hasFormData ? {} : { 'Content-Type': 'application/json' }),
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

export async function downloadRequest(path, fallbackName = 'document') {
    const headers = {
        Accept: 'application/octet-stream',
    };

    if (state.token) {
        headers.Authorization = `Bearer ${state.token}`;
    }

    const response = await fetch(`/api${path}`, {
        headers,
    });

    if (!response.ok) {
        const error = new Error('Download failed');
        error.status = response.status;
        throw error;
    }

    const blob = await response.blob();
    const disposition = response.headers.get('content-disposition') || '';
    const match = disposition.match(/filename="?([^"]+)"?/);
    const fileName = match?.[1] || fallbackName;
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');

    link.href = url;
    link.download = fileName;
    document.body.appendChild(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(url);
}
