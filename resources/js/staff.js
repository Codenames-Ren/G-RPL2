import { apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, collection, currentResourceId, setMessage, validationMessage,
    pageMessage, getApplicationTypeLabel, getApplicationStatusLabel,
    allowedApplicationSections, syncApplicationSections
} from './utils.js';

async function loadSubmissions() {
    const target = document.querySelector('[data-submissions-body]');
    if (!target) {
        return;
    }

    try {
        const response = await apiRequest('/staff/submissions');
        const submissions = collection(response);

        target.innerHTML = submissions.length
            ? submissions.map((sub) => {
                const applicantName = sub.applicant?.user?.name || '-';
                const studyProgram = sub.study_program?.name || '-';
                const status = sub.status || 'submitted';
                const submittedAt = sub.submitted_at
                    ? new Date(sub.submitted_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(sub.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${getApplicationTypeLabel(sub.rpl_type)}</td>
                        <td><span class="status-badge" data-status="${escapeHtml(status)}">${getApplicationStatusLabel(status)}</span></td>
                        <td>${submittedAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/submissions/${sub.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="7">Tidak ada submission yang perlu direview.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="7">Gagal memuat submissions.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadSubmissionDetail() {
    const applicationId = currentResourceId();
    if (!applicationId) {
        return;
    }

    try {
        const response = await apiRequest(`/staff/submissions/${applicationId}`);
        const sub = response.data;
        const allowed = allowedApplicationSections(sub.rpl_type);

        document.querySelector('[data-submission-title]').textContent = `Submission ${sub.application_number}`;
        document.querySelector('[data-submission-number]').textContent = sub.application_number;
        document.querySelector('[data-submission-status-badge]').textContent = getApplicationStatusLabel(sub.status);

        const applicantName = sub.applicant?.user?.name || '-';
        const applicantEmail = sub.applicant?.user?.email || '-';
        const studyProgram = sub.study_program?.name || '-';
        const submittedAt = sub.submitted_at
            ? new Date(sub.submitted_at).toLocaleDateString('id-ID')
            : '-';

        document.querySelector('[data-detail-applicant-name]').textContent = applicantName;
        document.querySelector('[data-detail-applicant-email]').textContent = applicantEmail;
        document.querySelector('[data-detail-study-program]').textContent = studyProgram;
        document.querySelector('[data-detail-rpl-type]').textContent = getApplicationTypeLabel(sub.rpl_type);
        document.querySelector('[data-detail-submitted-at]').textContent = submittedAt;
        document.querySelector('[data-detail-revision-count]').textContent = sub.revision_count ?? 0;
        document.querySelector('[data-detail-review-notes]').textContent = sub.review_notes || '-';
        document.querySelector('[data-detail-assessor]').textContent =
            sub.assigned_assessor?.name || '-';

        const reviewBtn = document.querySelector('[data-review-application]');
        if (reviewBtn) {
            reviewBtn.hidden = sub.status !== 'submitted';
        }

        const returnBtn = document.querySelector('[data-return-application]');
        if (returnBtn) {
            returnBtn.hidden = sub.status !== 'under_review';
        }

        const assignBtn = document.querySelector('[data-assign-assessor]');
        if (assignBtn) {
            assignBtn.hidden = sub.status !== 'under_review';
        }

        syncApplicationSections(sub.rpl_type);

        if (allowed.a1 && sub.a1_courses) {
            renderA1Courses(sub.a1_courses);
        }
        if (allowed.a2 && sub.a2_learning_experiences) {
            renderA2Experiences(sub.a2_learning_experiences);
        }
        if (sub.documents) {
            renderDocuments(sub.documents, applicationId);
        }
    } catch (error) {
        pageMessage(validationMessage(error));
    }
}

function renderA1Courses(courses) {
    const target = document.querySelector('[data-a1-courses-body]');
    if (!target) return;

    target.innerHTML = courses.length
        ? courses.map((course) => `
            <tr>
                <td>${escapeHtml(course.course_code)}</td>
                <td>${escapeHtml(course.course_name)}</td>
                <td>${escapeHtml(course.credits)}</td>
                <td>${escapeHtml(course.grade)}</td>
                <td>${escapeHtml(course.institution_name)}</td>
            </tr>
        `).join('')
        : '<tr><td colspan="5">Tidak ada data A1 course.</td></tr>';
}

function renderA2Experiences(experiences) {
    const target = document.querySelector('[data-a2-experiences-body]');
    if (!target) return;

    target.innerHTML = experiences.length
        ? experiences.map((exp) => {
            const startDate = exp.start_date ? new Date(exp.start_date).toLocaleDateString('id-ID') : '-';
            const endDate = exp.end_date ? new Date(exp.end_date).toLocaleDateString('id-ID') : (exp.is_ongoing ? 'Ongoing' : '-');
            return `
                <tr>
                    <td>${escapeHtml(exp.title)}</td>
                    <td>${escapeHtml(exp.experience_type)}</td>
                    <td>${escapeHtml(exp.organization_name)}</td>
                    <td>${startDate} - ${endDate}</td>
                </tr>
            `;
        }).join('')
        : '<tr><td colspan="4">Tidak ada data learning experience.</td></tr>';
}

function renderDocuments(documents, applicationId) {
    const target = document.querySelector('[data-documents-body]');
    if (!target) return;

    target.innerHTML = documents.length
        ? documents.map((doc) => `
            <tr>
                <td>${escapeHtml(doc.document_name)}</td>
                <td>${escapeHtml(doc.document_type)}</td>
                <td>${escapeHtml(doc.file_size || '-')}</td>
                <td>${escapeHtml(new Date(doc.created_at).toLocaleDateString('id-ID'))}</td>
                <td class="table-actions">
                    <button class="button button-small button-muted" type="button" data-download-document="${doc.id}" data-file-name="${escapeHtml(doc.file_name || doc.document_name || 'document')}">
                        Download
                    </button>
                </td>
            </tr>
        `).join('')
        : '<tr><td colspan="5">Tidak ada dokumen.</td></tr>';

    document.addEventListener('click', async (event) => {
        const button = event.target.closest('[data-download-document]');
        if (!button) return;

        event.preventDefault();
        button.disabled = true;

        try {
            await downloadRequest(
                `/staff/submissions/${applicationId}/documents/${button.dataset.downloadDocument}/download`,
                button.dataset.fileName || 'document'
            );
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            button.disabled = false;
        }
    });
}

function bindStaffActions() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    const reviewBtn = document.querySelector('[data-review-application]');
    if (reviewBtn) {
        reviewBtn.addEventListener('click', async () => {
            if (!confirm('Mulai review aplikasi ini?')) return;
            reviewBtn.disabled = true;

            try {
                const response = await apiRequest(`/staff/submissions/${applicationId}/review`, {
                    method: 'PATCH',
                    body: JSON.stringify({})
                });
                pageMessage(response.message || 'Review dimulai.', 'success');
                setTimeout(() => loadSubmissionDetail(), 800);
            } catch (error) {
                pageMessage(validationMessage(error));
            } finally {
                reviewBtn.disabled = false;
            }
        });
    }

    const returnModal = document.querySelector('[data-modal="return-submission"]');
    const returnForm = document.querySelector('[data-return-form]');
    const submitReturnBtn = document.querySelector('[data-submit-return]');

    document.addEventListener('click', (event) => {
        const openBtn = event.target.closest('[data-return-application]');
        if (openBtn && returnModal) {
            returnModal.hidden = false;
        }
    });

    if (submitReturnBtn && returnForm) {
        submitReturnBtn.addEventListener('click', async () => {
            const notes = returnForm.elements.review_notes.value.trim();
            if (!notes) {
                setMessage(returnForm, 'Catatan review wajib diisi.', 'error');
                return;
            }

            submitReturnBtn.disabled = true;
            setMessage(returnForm, 'Mengembalikan...', 'info');

            try {
                const response = await apiRequest(`/staff/submissions/${applicationId}/return`, {
                    method: 'PATCH',
                    body: JSON.stringify({ review_notes: notes })
                });
                setMessage(returnForm, response.message || 'Aplikasi dikembalikan.', 'success');
                setTimeout(() => {
                    returnModal.hidden = true;
                    returnForm.reset();
                    loadSubmissionDetail();
                }, 800);
            } catch (error) {
                setMessage(returnForm, validationMessage(error), 'error');
            } finally {
                submitReturnBtn.disabled = false;
            }
        });
    }

    const assignModal = document.querySelector('[data-modal="assign-assessor"]');
    const assignForm = document.querySelector('[data-assign-form]');
    const submitAssignBtn = document.querySelector('[data-submit-assign]');
    const assessorSelect = document.querySelector('[data-assessor-select]');

    document.addEventListener('click', async (event) => {
        const openBtn = event.target.closest('[data-assign-assessor]');
        if (openBtn && assignModal) {
            assignModal.hidden = false;
            await loadAssessorOptions();
        }
    });

    if (submitAssignBtn && assignForm) {
        submitAssignBtn.addEventListener('click', async () => {
            const assessorId = assignForm.elements.assessor_id.value;
            if (!assessorId) {
                setMessage(assignForm, 'Pilih assessor terlebih dahulu.', 'error');
                return;
            }

            submitAssignBtn.disabled = true;
            setMessage(assignForm, 'Menugaskan...', 'info');

            try {
                const response = await apiRequest(`/staff/submissions/${applicationId}/assign-assessor`, {
                    method: 'PATCH',
                    body: JSON.stringify({ assessor_id: Number(assessorId) })
                });
                setMessage(assignForm, response.message || 'Assessor ditugaskan.', 'success');
                setTimeout(() => {
                    assignModal.hidden = true;
                    assignForm.reset();
                    loadSubmissionDetail();
                }, 800);
            } catch (error) {
                setMessage(assignForm, validationMessage(error), 'error');
            } finally {
                submitAssignBtn.disabled = false;
            }
        });
    }
}

async function loadAssessorOptions() {
    const select = document.querySelector('[data-assessor-select]');
    if (!select) return;

    try {
        const response = await apiRequest('/staff/assessors');
        const assessors = collection(response);

        select.innerHTML = assessors.length
            ? '<option value="">-- Pilih Assessor --</option>' +
            assessors.map((a) => {
                const name = a.name || '-';
                const nip = a.assessor?.nip || '';
                return `<option value="${a.id}">${escapeHtml(name)}${nip ? ' (' + escapeHtml(nip) + ')' : ''}</option>`;
            }).join('')
            : '<option value="">Tidak ada assessor tersedia</option>';
    } catch (error) {
        select.innerHTML = '<option value="">Gagal memuat assessor</option>';
    }
}

export function bootStaffPages() {
    const page = document.body.dataset.page;

    if (page === 'submissions') {
        loadSubmissions();
    }

    if (page === 'submission-detail') {
        loadSubmissionDetail();
        bindStaffActions();
    }
}
