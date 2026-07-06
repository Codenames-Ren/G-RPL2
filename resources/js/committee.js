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
                const reviewNotes = app.review_notes || '-';
                const rawUpdatedAt = app.updated_at || '';
                const updatedAt = app.updated_at
                    ? new Date(app.updated_at).toLocaleDateString('id-ID')
                    : '-';

                return `
                    <tr data-approved-date="${escapeHtml(rawUpdatedAt)}">
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${escapeHtml(String(totalSks))}</td>
                        <td>${escapeHtml(reviewNotes)}</td>
                        <td>${updatedAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/approvals/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="7">Belum ada pengajuan yang selesai.</td></tr>';
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
            const grade = m.grade || '-';
            const recognized = m.is_recognited ?? m.is_recognized;
            return `
                <tr>
                    <td>${escapeHtml(sourceName)}</td>
                    <td>${escapeHtml(sourceType)}</td>
                    <td>${escapeHtml(courseName)}</td>
                    <td>${escapeHtml(sks)}</td>
                    <td>${escapeHtml(grade)}</td>
                    <td><span class="status-badge" data-status="${recognized ? 'active' : 'draft'}">${recognized ? 'Ya' : 'Tidak'}</span></td>
                    <td>${escapeHtml(m.notes || '-')}</td>
                </tr>
            `;
        }).join('')
        : '<tr><td colspan="7">Tidak ada course mapping.</td></tr>';
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

    const approveBtn = document.querySelector('[data-approve-application]');

    if (approveBtn) {
        approveBtn.addEventListener('click', async () => {
            const { isConfirmed, value } = await Swal.fire({
                title: 'Tandai Pengajuan Selesai?',
                width: 460,
                padding: '1.25rem 1.5rem 1.5rem',
                customClass: { popup: 'swal-approve-popup' },
                html: `
                    <style>
                        .swal-approve-popup { font-size: 14px !important; }
                        .swal-approve-popup .swal2-title { font-size: 17px !important; padding-bottom: 0 !important; margin-bottom: 0 !important; }
                        .swal-approve-popup .swal2-html-container { margin: 0.5rem 0 0 !important; padding: 0 !important; overflow: visible !important; text-align: left !important; }
                        .sa-badge { display: inline-block; background: #f0fdf4; color: #166534; font-size: 11px; font-weight: 600; padding: 2px 10px; border-radius: 4px; margin-bottom: 12px; }
                        .sa-desc { font-size: 13px; color: #475569; margin-bottom: 12px; line-height: 1.5; }
                        .sa-field { margin-bottom: 0; }
                        .sa-label { display: block; font-size: 12px; font-weight: 500; color: #64748b; margin-bottom: 3px; }
                        .sa-textarea { width: 100%; box-sizing: border-box; margin: 0 !important; font-family: inherit; font-size: 13px !important; padding: 6px 10px !important; border: 1px solid #e2e8f0 !important; border-radius: 6px !important; background: #fff !important; color: #1e293b !important; height: auto !important; resize: none; }
                        .sa-textarea:focus { outline: none !important; border-color: #10b981 !important; box-shadow: 0 0 0 2px #f0fdf4 !important; }
                    </style>
                    <div class="sa-badge">✓ Persetujuan Akhir</div>
                    <p class="sa-desc">Pengajuan ini akan ditandai sebagai selesai dan siap untuk pencetakan SK Rektor serta Ringkasan Assessment.</p>
                    <div class="sa-field">
                        <label class="sa-label">Catatan <span style="font-weight:400;">(opsional)</span></label>
                        <textarea id="swal-approve-notes" class="sa-textarea" rows="3" placeholder="Tambahkan catatan persetujuan..."></textarea>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Ya, Tandai Selesai',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                focusConfirm: false,
                preConfirm: () => {
                    return { notes: document.getElementById('swal-approve-notes').value.trim() };
                }
            });

            if (!isConfirmed || !value) return;

            approveBtn.disabled = true;

            try {
                await apiRequest(`/committee/applications/${applicationId}/approve`, {
                    method: 'PATCH',
                    body: JSON.stringify({ notes: value.notes || undefined })
                });

                await Swal.fire({
                    icon: 'success',
                    title: 'Pengajuan Selesai',
                    text: 'Pengajuan RPL telah ditandai selesai.',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#10b981',
                });

                loadApprovalDetail();
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Pengajuan gagal ditandai selesai. Coba lagi.',
                    confirmButtonText: 'Tutup',
                });
            } finally {
                approveBtn.disabled = false;
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
            Swal.fire({ icon: 'error', title: 'Kesalahan', text: 'Pratinjau gagal.' });
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

// LOGIKA FILTER TAHUN & BULAN
let availablePeriods = {};

function getDataRows() {
    const approvedBody = document.querySelector('[data-approved-body]');
    if (!approvedBody) return [];
    return Array.from(approvedBody.querySelectorAll('tr'))
        .filter(row => !row.hasAttribute('data-search-empty-row'))
        .filter(row => !row.textContent.toLowerCase().includes('memuat'));
}

function filterApprovedTable() {
    const searchInput = document.querySelector('[data-approved-search]');
    const yearFilter = document.querySelector('[data-year-filter]');
    const monthFilter = document.querySelector('[data-month-filter]');
    const totalApproved = document.querySelector('[data-total-approved]');
    const searchCount = document.querySelector('[data-approved-search-count]');
    const approvedBody = document.querySelector('[data-approved-body]');

    if (!approvedBody) return;

    const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
    const selectedYear = yearFilter ? yearFilter.value : '';
    const selectedMonth = monthFilter && !monthFilter.disabled ? monthFilter.value : '';

    const dataRows = getDataRows();

    if (!dataRows.length) {
        if (totalApproved) totalApproved.textContent = '0';
        return;
    }

    let visibleCount = 0;

    dataRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const matchQuery = !query || text.includes(query);

        let matchPeriod = true;
        if (selectedYear) {
            const dateStr = row.getAttribute('data-approved-date');
            if (dateStr) {
                const d = new Date(dateStr);
                if (!isNaN(d.getTime())) {
                    const rowYear = String(d.getFullYear());
                    const rowMonth = String(d.getMonth() + 1).padStart(2, '0');

                    if (rowYear !== selectedYear) {
                        matchPeriod = false;
                    } else if (selectedMonth && rowMonth !== selectedMonth) {
                        matchPeriod = false;
                    }
                } else {
                    matchPeriod = false;
                }
            } else {
                matchPeriod = false;
            }
        }

        const match = matchQuery && matchPeriod;
        row.hidden = !match;

        if (match) {
            visibleCount++;
        }
    });

    if (totalApproved) totalApproved.textContent = visibleCount;

    let emptyRow = approvedBody.querySelector('[data-search-empty-row]');
    if (visibleCount === 0) {
        if (!emptyRow) {
            emptyRow = document.createElement('tr');
            emptyRow.setAttribute('data-search-empty-row', 'true');
            emptyRow.innerHTML = '<td colspan="7" style="text-align:center; padding:30px;">Data tidak ditemukan sesuai pencarian/filter.</td>';
            approvedBody.appendChild(emptyRow);
        }
    } else {
        if (emptyRow) emptyRow.remove();
    }

    if (searchCount) {
        searchCount.textContent = (query || selectedYear)
            ? visibleCount + ' / ' + dataRows.length + ' Data'
            : dataRows.length + ' Data';
    }
}

function bindApprovedPrintAction() {
    const printPdfBtn = document.querySelector('[data-print-pdf]');
    const yearFilter = document.querySelector('[data-year-filter]');
    const monthFilter = document.querySelector('[data-month-filter]');
    const searchInput = document.querySelector('[data-approved-search]');

    if (!printPdfBtn) return;

    printPdfBtn.addEventListener('click', () => {
        const selectedYear = yearFilter ? yearFilter.value : '';
        const selectedMonth = monthFilter && !monthFilter.disabled ? monthFilter.value : '';
        const query = searchInput ? searchInput.value : '';

        let periodParam = '';
        let periodLabel = 'Semua Periode';

        if (selectedYear) {
            if (selectedMonth) {
                periodParam = `${selectedYear}-${selectedMonth}`;
                periodLabel = `${monthFilter.options[monthFilter.selectedIndex].text} ${selectedYear}`;
            } else {
                periodParam = selectedYear;
                periodLabel = `Tahun ${selectedYear}`;
            }
        }

        Swal.fire({
            title: 'Cetak Rekap PDF',
            text: `Apakah Anda ingin mencetak rekap pendaftaran untuk ${periodLabel}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Cetak',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#10b981',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    await previewPdf(`/committee/applications/approved/print-pdf?period=${periodParam}&search=${query}`);
                } catch (error) {
                    Swal.showValidationMessage('Gagal memuat PDF. Coba beberapa saat lagi.');
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });
}

function initFilters() {
    const dataRows = getDataRows();
    if (dataRows.length === 0) return;

    availablePeriods = {};

    dataRows.forEach(row => {
        const dateStr = row.getAttribute('data-approved-date');
        if (dateStr) {
            const d = new Date(dateStr);
            if (!isNaN(d.getTime())) {
                const year = String(d.getFullYear());
                const month = String(d.getMonth() + 1).padStart(2, '0');

                if (!availablePeriods[year]) {
                    availablePeriods[year] = new Set();
                }
                availablePeriods[year].add(month);
            }
        }
    });

    const yearFilter = document.querySelector('[data-year-filter]');
    const monthFilter = document.querySelector('[data-month-filter]');

    if (yearFilter && Object.keys(availablePeriods).length > 0) {
        yearFilter.innerHTML = '<option value="">Semua Tahun</option>';
        Object.keys(availablePeriods).sort((a, b) => b.localeCompare(a)).forEach(y => {
            const opt = document.createElement('option');
            opt.value = y;
            opt.textContent = y;
            yearFilter.appendChild(opt);
        });

        yearFilter.addEventListener('change', () => {
            const y = yearFilter.value;
            if (!y) {
                monthFilter.innerHTML = '<option value="">Semua Bulan</option>';
                monthFilter.disabled = true;
            } else {
                monthFilter.innerHTML = '<option value="">Semua Bulan</option>';
                const months = Array.from(availablePeriods[y]).sort();
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

                months.forEach(m => {
                    const opt = document.createElement('option');
                    opt.value = m;
                    opt.textContent = monthNames[parseInt(m) - 1];
                    monthFilter.appendChild(opt);
                });
                monthFilter.disabled = false;
            }
            filterApprovedTable();
        });
    }

    if (monthFilter) {
        monthFilter.addEventListener('change', filterApprovedTable);
    }

    const searchInput = document.querySelector('[data-approved-search]');
    if (searchInput) {
        searchInput.addEventListener('input', filterApprovedTable);
    }
}

export function bootCommitteePages() {
    const page = document.body.dataset.page;

    if (page === 'approvals') {
        loadApprovals();
    }

    if (page === 'approvals-approved') {
        loadApprovedApprovals();

        let tries = 0;
        const interval = setInterval(() => {
            if (getDataRows().length > 0) {
                initFilters();
                filterApprovedTable();
                clearInterval(interval);
            }
            tries++;
            if (tries > 15) clearInterval(interval);
        }, 400);

        bindApprovedPrintAction();
    }

    if (page === 'approval-detail') {
        loadApprovalDetail();
        // Fungsi bindCommitteeActions aslinya dipanggil di sini. Aku letakkan ulang sesuai kode awal kamu.
        const approveBtn = document.querySelector('[data-approve-application]');
        if (approveBtn) {
            bindCommitteeActions();
        } else {
            // Kalau ga ada tombol approve (status approved), binding download/preview tetep jalan
            bindCommitteeActions();
        }
    }
}