import { apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, collection, currentResourceId, setMessage, validationMessage,
    pageMessage, getApplicationStatusLabel, getApplicationTypeLabel
} from './utils.js';

async function loadApprovals() {
    const target = document.querySelector('[data-approvals-body]');
    if (!target) return;

    try {
        const response = await apiRequest('/committee/applications');
        const applications = collection(response);

        target.innerHTML = applications.length
            ? applications.map((app) => {
                const applicantName = app.applicant?.user?.name || '-';
                const studyProgram = app.study_program?.name || '-';
                const totalSks = app.assessment?.total_converted_sks || '-';
                // const assessorName = app.assessment?.assessor?.user?.name || '-';
                const createdAt = app.created_at
                    ? new Date(app.created_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${escapeHtml(totalSks)}</td>
                        <td>${createdAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/approvals/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="6">Tidak ada pengajuan yang perlu disetujui.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="6">Gagal memuat data.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadApprovedApprovals() {
    const target = document.querySelector('[data-approved-body]');
    if (!target) return;

    try {
        const response = await apiRequest('/committee/applications/approved');
        const applications = collection(response);
        console.log('approved app[0]:', applications[0]?.assessment);

        target.innerHTML = applications.length
            ? applications.map((app) => {
                const applicantName = app.applicant?.user?.name || '-';
                const studyProgram = app.study_program?.name || '-';
                const totalSks = app.assessment?.total_converted_sks || '-';
                // const reviewNotes = app.review_notes || '-';
                const updatedAt = app.updated_at
                    ? new Date(app.updated_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${escapeHtml(totalSks)}</td>
                        <td>${updatedAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/approvals/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="6">Belum ada pengajuan yang disetujui.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="6">Gagal memuat data.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadApprovalDetail() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    try {
        const response = await apiRequest(`/committee/applications/${applicationId}`);
        const app = response.data;

        document.querySelector('[data-approval-title]').textContent = `Approval ${app.application_number}`;
        document.querySelector('[data-approval-number]').textContent = app.application_number;
        document.querySelector('[data-approval-status-badge]').textContent = getApplicationStatusLabel(app.status);

        document.querySelector('[data-detail-applicant-name]').textContent = app.applicant?.user?.name || '-';
        document.querySelector('[data-detail-applicant-email]').textContent = app.applicant?.user?.email || '-';
        document.querySelector('[data-detail-study-program]').textContent = app.study_program?.name || '-';
        document.querySelector('[data-detail-rpl-type]').textContent = app.rpl_type ? getApplicationTypeLabel(app.rpl_type) : '-';
        document.querySelector('[data-detail-total-sks]').textContent = app.assessment?.total_converted_sks ?? '-';
        document.querySelector('[data-detail-assessor]').textContent = app.assessment?.assessor?.user?.name || '-';
        // document.querySelector('[data-detail-review-notes]').textContent = app.review_notes || '-';
        document.querySelector('[data-detail-submitted-at]').textContent = app.created_at
            ? new Date(app.created_at).toLocaleDateString('id-ID')
            : '-';

        const approveBtn = document.querySelector('[data-approve-application]');
        if (approveBtn) {
            approveBtn.hidden = app.status !== 'assessed';
        }

        const pdfTab = document.querySelector('[data-tab-button="documents-pdf"]');
        if (pdfTab) {
            pdfTab.hidden = app.status !== 'approved';
        }

        if (app.assessment?.course_mappings) {
            renderCommitteeMappings(app.assessment.course_mappings);
        }

        if (app.documents) {
            renderCommitteeDocuments(app.documents, applicationId);
        }
    } catch (error) {
        pageMessage(validationMessage(error));
    }
}

function renderCommitteeMappings(mappings) {
    const target = document.querySelector('[data-mappings-body]');
    if (!target) return;

    target.innerHTML = mappings.length
        ? mappings.map((m) => {
            const sourceName = m.application_a1_course?.course_name
                || m.application_a2_learning_experience?.title
                || '-';
            const sourceType = m.application_a1_course ? 'A1' : (m.application_a2_learning_experience ? 'A2' : '-');
            const courseName = m.course?.name || '-';
            const sks = m.course?.sks || '-';
            const recognized = m.is_recognited ?? m.is_recognized;
            return `
                <tr>
                    <td>${escapeHtml(sourceName)}</td>
                    <td>${escapeHtml(sourceType)}</td>
                    <td>${escapeHtml(courseName)}</td>
                    <td>${escapeHtml(sks)}</td>
                    <td><span class="status-badge" data-status="${recognized ? 'active' : 'draft'}">${recognized ? 'Ya' : 'Tidak'}</span></td>
                    <td>${escapeHtml(m.notes || '-')}</td>
                </tr>
            `;
        }).join('')
        : '<tr><td colspan="6">Tidak ada course mapping.</td></tr>';
}

function renderCommitteeDocuments(documents, applicationId) {
    const target = document.querySelector('[data-documents-body]');
    if (!target) return;

    target.innerHTML = documents.length
        ? documents.map((doc) => `
            <tr>
                <td>${escapeHtml(doc.document_name || doc.file_name || '-')}</td>
                <td>${escapeHtml(doc.document_type || doc.type || '-')}</td>
                <td class="table-actions">
                    <button class="button button-small button-muted" type="button" data-download-doc="${doc.id}" data-file-name="${escapeHtml(doc.file_name || doc.document_name || 'document')}">
                        Download
                    </button>
                </td>
            </tr>
        `).join('')
        : '<tr><td colspan="3">Tidak ada dokumen.</td></tr>';

    document.addEventListener('click', async (event) => {
        const button = event.target.closest('[data-download-doc]');
        if (!button) return;

        event.preventDefault();
        button.disabled = true;

        try {
            await downloadRequest(
                `/committee/applications/${applicationId}/documents/${button.dataset.downloadDoc}/download`,
                button.dataset.fileName || 'document'
            );
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            button.disabled = false;
        }
    });
}

async function previewPdf(path) {
    const headers = { Accept: 'application/octet-stream' };
    const token = localStorage.getItem('grpl2_token');

    if (token) {
        headers.Authorization = `Bearer ${token}`;
    }

    const response = await fetch(`/api${path}`, { headers });

    if (!response.ok) {
        throw new Error('Preview gagal dimuat.');
    }

    const blob = await response.blob();
    const url = URL.createObjectURL(blob);
    window.open(url, '_blank');
}

function bindCommitteeActions() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    const approveBtn = document.querySelector('[data-approve-application]');
    const approveModal = document.querySelector('[data-modal="approve-application"]');
    const approveForm = document.querySelector('[data-approve-form]');
    const submitApproveBtn = document.querySelector('[data-submit-approve]');

    document.addEventListener('click', (event) => {
        const openBtn = event.target.closest('[data-approve-application]');
        if (openBtn && approveModal) {
            approveModal.hidden = false;
        }
    });

    if (submitApproveBtn && approveForm) {
        submitApproveBtn.addEventListener('click', async () => {
            const notes = approveForm.elements.notes.value.trim();

            submitApproveBtn.disabled = true;
            setMessage(approveForm, 'Menyetujui...', 'info');

            try {
                const response = await apiRequest(`/committee/applications/${applicationId}/approve`, {
                    method: 'PATCH',
                    body: JSON.stringify({ notes: notes || undefined })
                });
                setMessage(approveForm, response.message || 'Aplikasi disetujui.', 'success');
                setTimeout(() => {
                    approveModal.hidden = true;
                    approveForm.reset();
                    loadApprovalDetail();
                }, 800);
            } catch (error) {
                setMessage(approveForm, validationMessage(error), 'error');
            } finally {
                submitApproveBtn.disabled = false;
            }
        });
    }

    document.addEventListener('click', async (event) => {
        const previewBtn = event.target.closest('[data-preview-rector-decree]');
        if (!previewBtn) return;
        event.preventDefault();
        previewBtn.disabled = true;
        try {
            await previewPdf(`/committee/applications/${applicationId}/rector-decree/preview`);
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            previewBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const previewBtn = event.target.closest('[data-preview-assessment-summary]');
        if (!previewBtn) return;
        event.preventDefault();
        previewBtn.disabled = true;
        try {
            await previewPdf(`/committee/applications/${applicationId}/assessment-summary/preview`);
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            previewBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const downloadBtn = event.target.closest('[data-download-rector-decree]');
        if (!downloadBtn) return;
        event.preventDefault();
        downloadBtn.disabled = true;
        try {
            await downloadRequest(`/committee/applications/${applicationId}/rector-decree/download`, `SK-Rektor-${applicationId}.pdf`);
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            downloadBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const downloadBtn = event.target.closest('[data-download-assessment-summary]');
        if (!downloadBtn) return;
        event.preventDefault();
        downloadBtn.disabled = true;
        try {
            await downloadRequest(`/committee/applications/${applicationId}/assessment-summary/download`, `Assessment-Summary-${applicationId}.pdf`);
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            downloadBtn.disabled = false;
        }
    });
}

export function bootCommitteePages() {
    const page = document.body.dataset.page;

    if (page === 'approvals') {
        loadApprovals();
    }

    if (page === 'approvals-approved') {
        loadApprovedApprovals();
    }

    if (page === 'approval-detail') {
        loadApprovalDetail();
        bindCommitteeActions();
    }
}
