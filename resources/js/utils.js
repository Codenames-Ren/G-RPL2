export function roleOf(user) {
    const firstRole = user?.roles?.[0];

    if (typeof user?.role === 'string') {
        return user.role;
    }

    if (typeof firstRole === 'string') {
        return firstRole;
    }

    return firstRole?.name || '';
}

export function setMessage(form, message, type = 'error') {
    const target = form.querySelector('[data-form-message]');
    if (!target) {
        return;
    }

    target.textContent = message;
    target.dataset.type = type;
}

export function validationMessage(error) {
    const errors = error?.payload?.errors;
    if (!errors) {
        return error.message || 'Request failed';
    }

    return Object.values(errors)
        .flat()
        .filter(Boolean)
        .join(' ');
}

export function pageMessage(message, type = 'error') {
    const target = document.querySelector('[data-page-message]');
    if (!target) {
        return;
    }

    target.textContent = message;
    target.dataset.type = type;
}

export function escapeHtml(value) {
    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

export function toBoolean(value) {
    return value === true || value === '1' || value === 1;
}

export function collection(payload) {
    if (Array.isArray(payload?.data)) {
        return payload.data;
    }

    if (Array.isArray(payload?.data?.data)) {
        return payload.data.data;
    }

    return [];
}

export function getApplicationTypeLabel(type) {
    const labels = {
        'a1': 'A1 - Formal',
        'a2': 'A2 - Informal/Nonformal',
        'hybrid': 'Hybrid'
    };
    return labels[type] || type;
}

export function getApplicationStatusLabel(status) {
    const labels = {
        'draft': 'Draft',
        'submitted': 'Submitted',
        'under_review': 'Under Review',
        'returned': 'Returned',
        'under_assessment': 'Under Assessment',
        'assessed': 'Assessed',
        'approved': 'Approved',
        'rejected': 'Rejected'
    };
    return labels[status] || status;
}

export function allowedApplicationSections(type) {
    return {
        a1: type === 'a1' || type === 'hybrid',
        a2: type === 'a2' || type === 'hybrid',
    };
}

export function activateTab(tab) {
    document.querySelectorAll('[data-tab-content]').forEach((content) => {
        content.classList.toggle('active', content.dataset.tabContent === tab);
    });
    document.querySelectorAll('[data-tab-button]').forEach((button) => {
        button.classList.toggle('active', button.dataset.tabButton === tab);
    });
}

export function syncApplicationSections(type) {
    const allowed = allowedApplicationSections(type);

    document.querySelectorAll('[data-rpl-section]').forEach((element) => {
        const section = element.dataset.rplSection;
        element.hidden = section === 'a1' ? !allowed.a1 : !allowed.a2;
    });

    const activeTab = document.querySelector('[data-tab-button].active:not([hidden])');
    if (activeTab) {
        return;
    }

    const firstVisibleTab = document.querySelector('[data-tab-button]:not([hidden])');
    if (firstVisibleTab) {
        activateTab(firstVisibleTab.dataset.tabButton);
    }
}

export function formPayload(form, options = {}) {
    const payload = {};

    form.querySelectorAll('input, select, textarea').forEach((field) => {
        if (!field.name || field.disabled) {
            return;
        }

        if (field.multiple) {
            payload[field.name] = Array.from(field.selectedOptions).map((option) => Number(option.value));
            return;
        }

        if (field.type === 'number') {
            payload[field.name] = field.value === '' ? '' : Number(field.value);
            return;
        }

        if (options.booleanFields?.includes(field.name)) {
            payload[field.name] = toBoolean(field.value);
            return;
        }

        if (options.skipEmpty?.includes(field.name) && field.value === '') {
            return;
        }

        payload[field.name] = field.value;
    });

    return payload;
}

export function currentResourceId() {
    const parts = window.location.pathname.split('/').filter(Boolean);
    const lastPart = parts.at(-1);

    if (['create', 'edit'].includes(lastPart)) {
        return parts.at(-2);
    }

    return lastPart;
}
