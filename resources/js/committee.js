import { apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, collection, currentResourceId, setMessage, validationMessage,
    pageMessage, getApplicationStatusLabel, getApplicationTypeLabel
} from './utils.js';
import Swal from 'sweetalert2';

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
                const totalSks = app.assessment?.total_converted_sks ?? '-';
                const assessorName = app.assessment?.assessor?.user?.name || '-';
                const createdAt = app.created_at
                    ? new Date(app.created_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${escapeHtml(String(totalSks))}</td>
                        <td>${escapeHtml(assessorName)}</td>
                        <td>${createdAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/approvals/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="7">Tidak ada pengajuan yang perlu disetujui.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="7">Gagal memuat data.</td></tr>';
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data pengajuan tidak dapat dimuat. Periksa koneksi Anda dan coba lagi.',
            confirmButtonText: 'Tutup',
        });
    }
}

async function loadApprovedApprovals() {
    const target = document.querySelector('[data-approved-body]');
    if (!target) return;

    try {
        const response = await apiRequest('/committee/applications/approved');
        const applications = collection(response);

        target.innerHTML = applications.length
            ? applications.map((app) => {
                const applicantName = app.applicant?.user?.name || '-';
                const studyProgram = app.study_program?.name || '-';
                const totalSks = app.assessment?.total_converted_sks ?? '-';
                const updatedAt = app.updated_at
                    ? new Date(app.updated_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${escapeHtml(String(totalSks))}</td>
                        <td>${updatedAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/approvals/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="6">Belum ada pengajuan yang selesai.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="6">Gagal memuat data.</td></tr>';
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Data pengajuan tidak dapat dimuat. Periksa koneksi Anda dan coba lagi.',
            confirmButtonText: 'Tutup',
        });
    }
}

async function loadApprovalDetail() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    try {
        const response = await apiRequest(`/committee/applications/${applicationId}`);
        const app = response.data;

        document.querySelector('[data-approval-title]').textContent = `Nomor Pengajuan : ${app.application_number}`;
        document.querySelector('[data-approval-number]').textContent = app.application_number;
        document.querySelector('[data-approval-status-badge]').textContent = getApplicationStatusLabel(app.status);

        document.querySelector('[data-detail-applicant-name]').textContent = app.applicant?.user?.name || '-';
        document.querySelector('[data-detail-applicant-email]').textContent = app.applicant?.user?.email || '-';
        document.querySelector('[data-detail-study-program]').textContent = app.study_program?.name || '-';
        document.querySelector('[data-detail-rpl-type]').textContent = app.rpl_type ? getApplicationTypeLabel(app.rpl_type) : '-';
        document.querySelector('[data-detail-total-sks]').textContent = app.assessment?.total_converted_sks ?? '-';
        document.querySelector('[data-detail-assessor]').textContent = app.assessment?.assessor?.user?.name || '-';
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
        if (error?.status === 404 || error?.status === 403) {
            Swal.fire({
                title: 'Akses Ditolak',
                text: 'Pengajuan tidak ditemukan.',
                icon: 'error',
            }).then(() => {
                window.location.replace('/approvals');
            });

            return;
        }

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
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Dokumen gagal diunduh. Coba beberapa saat lagi.',
                confirmButtonText: 'Tutup',
            });
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

            const confirmed = await Swal.fire({
                icon: 'question',
                title: 'Tandai Pengajuan Selesai?',
                text: 'Pengajuan ini akan ditandai sebagai selesai dan siap untuk pencetakan SK Rektor serta Ringkasan Assessment.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tandai Selesai',
                cancelButtonText: 'Batal',
            });

            if (!confirmed.isConfirmed) return;

            submitApproveBtn.disabled = true;
            setMessage(approveForm, 'Memproses...', 'info');

            try {
                await apiRequest(`/committee/applications/${applicationId}/approve`, {
                    method: 'PATCH',
                    body: JSON.stringify({ notes: notes || undefined })
                });

                approveModal.hidden = true;
                approveForm.reset();

                await Swal.fire({
                    icon: 'success',
                    title: 'Pengajuan Selesai',
                    text: 'Pengajuan RPL telah ditandai selesai. SK Rektor dan Ringkasan Assessment kini dapat dicetak.',
                    confirmButtonText: 'Tutup',
                });

                loadApprovalDetail();
            } catch (error) {
                setMessage(approveForm, '', '');
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Pengajuan gagal ditandai selesai. Pastikan status pengajuan masih valid dan coba lagi.',
                    confirmButtonText: 'Tutup',
                });
            } finally {
                submitApproveBtn.disabled = false;
            }
        });
    }

    document.addEventListener('click', async (event) => {
        const previewBtn = event.target.closest('[data-preview-rector-decree]');
        if (!previewBtn) return;
        event.preventDefault();

        const confirmed = await Swal.fire({
            icon: 'question',
            title: 'Pratinjau SK Rektor?',
            text: 'Dokumen SK Rektor akan dibuka di tab baru.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Buka',
            cancelButtonText: 'Batal',
        });
        if (!confirmed.isConfirmed) return;

        previewBtn.disabled = true;
        try {
            await previewPdf(`/committee/applications/${applicationId}/rector-decree/preview`);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Pratinjau SK Rektor tidak dapat dibuka. Coba beberapa saat lagi.',
                confirmButtonText: 'Tutup',
            });
        } finally {
            previewBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const previewBtn = event.target.closest('[data-preview-assessment-summary]');
        if (!previewBtn) return;
        event.preventDefault();

        const confirmed = await Swal.fire({
            icon: 'question',
            title: 'Pratinjau Ringkasan Assessment?',
            text: 'Dokumen Ringkasan Assessment akan dibuka di tab baru.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Buka',
            cancelButtonText: 'Batal',
        });
        if (!confirmed.isConfirmed) return;

        previewBtn.disabled = true;
        try {
            await previewPdf(`/committee/applications/${applicationId}/assessment-summary/preview`);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Pratinjau Ringkasan Assessment tidak dapat dibuka. Coba beberapa saat lagi.',
                confirmButtonText: 'Tutup',
            });
        } finally {
            previewBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const downloadBtn = event.target.closest('[data-download-rector-decree]');
        if (!downloadBtn) return;
        event.preventDefault();

        const confirmed = await Swal.fire({
            icon: 'question',
            title: 'Unduh SK Rektor?',
            text: 'File SK Rektor akan diunduh ke perangkat Anda.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Unduh',
            cancelButtonText: 'Batal',
        });
        if (!confirmed.isConfirmed) return;

        downloadBtn.disabled = true;
        try {
            await downloadRequest(`/committee/applications/${applicationId}/rector-decree/download`, `SK-Rektor-${applicationId}.pdf`);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Diunduh',
                text: 'SK Rektor berhasil diunduh.',
                confirmButtonText: 'Tutup',
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Unduhan SK Rektor gagal. Coba beberapa saat lagi.',
                confirmButtonText: 'Tutup',
            });
        } finally {
            downloadBtn.disabled = false;
        }
    });

    document.addEventListener('click', async (event) => {
        const downloadBtn = event.target.closest('[data-download-assessment-summary]');
        if (!downloadBtn) return;
        event.preventDefault();

        const confirmed = await Swal.fire({
            icon: 'question',
            title: 'Unduh Ringkasan Assessment?',
            text: 'File Ringkasan Assessment akan diunduh ke perangkat Anda.',
            showCancelButton: true,
            confirmButtonText: 'Ya, Unduh',
            cancelButtonText: 'Batal',
        });
        if (!confirmed.isConfirmed) return;

        downloadBtn.disabled = true;
        try {
            await downloadRequest(`/committee/applications/${applicationId}/assessment-summary/download`, `Assessment-Summary-${applicationId}.pdf`);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Diunduh',
                text: 'Ringkasan Assessment berhasil diunduh.',
                confirmButtonText: 'Tutup',
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Unduhan Ringkasan Assessment gagal. Coba beberapa saat lagi.',
                confirmButtonText: 'Tutup',
            });
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
