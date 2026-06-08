// Import all modules
import { state, storeSession, clearSession, apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, toBoolean, collection, setMessage, validationMessage, pageMessage,
    formPayload, currentResourceId, getApplicationTypeLabel, getApplicationStatusLabel,
    allowedApplicationSections, syncApplicationSections, activateTab
} from './utils.js';
import {
    mergeUserProfile, hydrateAuthenticatedPage, bindAuthForms
} from './auth.js';
import {
    syncNavigation, renderUser, bindLogout
} from './navigation.js';
import { bootApplicantPages } from './applicant.js';
import { bootAdminPages } from './admin.js';
import { bootStaffPages } from './staff.js';
import { bootCommitteePages } from './committee.js';
import { bootAssessorPages } from './assessor.js';

// Re-export commonly used functions (for backwards compatibility)
export { state, storeSession, clearSession, apiRequest, downloadRequest };
export { escapeHtml, toBoolean, collection, setMessage, validationMessage, pageMessage, formPayload, currentResourceId };
export { getApplicationTypeLabel, getApplicationStatusLabel, allowedApplicationSections, syncApplicationSections, activateTab };

// Main boot function
function boot() {
    syncNavigation();
    bindAuthForms();
    bindLogout();
    hydrateAuthenticatedPage();
    bootAdminPages();
    bootApplicantPages();
    bootStaffPages();
    bootCommitteePages();
    bootAssessorPages();
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', boot);
