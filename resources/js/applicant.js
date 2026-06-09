import { apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, collection, currentResourceId, setMessage, validationMessage,
    pageMessage, getApplicationTypeLabel, getApplicationStatusLabel,
    allowedApplicationSections, syncApplicationSections, formPayload
} from './utils.js';

const profileLabels = {
    gender: {
        male: 'Laki-laki',
        female: 'Perempuan',
    },
    marital_status: {
        single: 'Belum Kawin',
        married: 'Kawin',
        divorced: 'Cerai',
    },
};

const requiredProfileFields = [
    'birth_place',
    'birth_date',
    'gender',
    'marital_status',
    'nationality',
    'last_education',
    'institution_name',
    'graduation_year',
];

function formatProfileValue(key, value) {
    if (value === null || value === undefined || value === '') {
        return '-';
    }

    return profileLabels[key]?.[value] || value;
}

function isProfileComplete(profile) {
    return requiredProfileFields.every((field) => Boolean(profile?.[field]));
}

async function loadStudyProgramsForApplication() {
    const select = document.querySelector('[name="study_program_id"]');
    if (!select) {
        return;
    }

    try {
        const response = await apiRequest('/study-programs');
        const programs = collection(response);
        const selectedValue = select.value;

        select.innerHTML = programs.map((program) => `
            <option value="${program.id}" ${program.id == selectedValue ? 'selected' : ''}>
                ${escapeHtml(program.code)} - ${escapeHtml(program.name)}
            </option>
        `).join('');
    } catch (error) {
        console.error('Failed to load study programs:', error);
    }
}

function bindCreateApplication() {
    loadStudyProgramsForApplication();

    const button = document.querySelector('[data-create-application]');
    if (!button) {
        return;
    }

    button.addEventListener('click', async () => {
        const form = button.closest('form') || document.querySelector('.form-grid');
        const studyProgramId = form.querySelector('[name="study_program_id"]')?.value;
        const rplType = form.querySelector('[name="rpl_type"]')?.value;

        if (!studyProgramId || !rplType) {
            setMessage(form, 'Silakan isi semua field', 'error');
            return;
        }

        button.disabled = true;
        setMessage(form, 'Membuat aplikasi...', 'info');

        try {
            const path = rplType === 'hybrid'
                ? '/applicant/applications/hybrid'
                : '/applicant/applications';

            const response = await apiRequest(path, {
                method: 'POST',
                body: JSON.stringify({ study_program_id: Number(studyProgramId), rpl_type: rplType })
            });

            setMessage(form, response.message || 'Aplikasi berhasil dibuat', 'success');

            setTimeout(() => {
                window.location.assign(`/applications/${response.data.id}`);
            }, 1000);
        } catch (error) {
            setMessage(form, validationMessage(error), 'error');
            button.disabled = false;
        }
    });
}

async function loadApplications() {
    const target = document.querySelector('[data-applications-body]');
    if (!target) {
        return;
    }

    try {
        const response = await apiRequest('/applicant/applications');
        const applications = collection(response);

        target.innerHTML = applications.length
            ? applications.map((app) => {
                const status = app.status || 'draft';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(app.study_program?.name || '-')}</td>
                        <td>${getApplicationTypeLabel(app.rpl_type)}</td>
                        <td><span class="status-badge" data-status="${escapeHtml(status)}">${getApplicationStatusLabel(status)}</span></td>
                        <td>${escapeHtml(new Date(app.created_at).toLocaleDateString('id-ID'))}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/applications/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="6">Belum ada aplikasi.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="6">Gagal memuat aplikasi.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadA1Courses(applicationId) {
    const target = document.querySelector('[data-a1-courses-body]');
    if (!target) {
        return;
    }
    const editable = document.body.dataset.page === 'application-edit';

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}/a1-courses`);
        const courses = collection(response);

        target.innerHTML = courses.length
            ? courses.map((course) => `
                <tr>
                    <td>${escapeHtml(course.course_code)}</td>
                    <td>${escapeHtml(course.course_name)}</td>
                    <td>${escapeHtml(course.credits)}</td>
                    <td>${escapeHtml(course.grade)}</td>
                    <td>${escapeHtml(course.institution_name)}</td>
                    ${editable ? `
                        <td class="table-actions">
                            <button
                                class="button button-small button-muted"
                                type="button"
                                data-edit-a1-course="${course.id}"
                                data-course-code="${escapeHtml(course.course_code)}"
                                data-course-name="${escapeHtml(course.course_name)}"
                                data-credits="${escapeHtml(course.credits)}"
                                data-grade="${escapeHtml(course.grade)}"
                                data-institution-name="${escapeHtml(course.institution_name)}"
                            >
                                Edit
                            </button>
                        </td>
                    ` : ''}
                </tr>
            `).join('')
            : `<tr><td colspan="${editable ? 6 : 5}">Belum ada data A1 course.</td></tr>`;
    } catch (error) {
        target.innerHTML = `<tr><td colspan="${editable ? 6 : 5}">Gagal memuat A1 courses.</td></tr>`;
        pageMessage(validationMessage(error));
    }
}

async function loadA2LearningExperiences(applicationId) {
    const target = document.querySelector('[data-a2-experiences-body]');
    if (!target) {
        return;
    }

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}/a2-learning-experiences`);
        const experiences = collection(response);

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
            : '<tr><td colspan="4">Belum ada data learning experience.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="4">Gagal memuat learning experiences.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadDocuments(applicationId) {
    const target = document.querySelector('[data-documents-body]');
    if (!target) {
        return;
    }

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}/documents`);
        const documents = collection(response);

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
            : '<tr><td colspan="5">Belum ada dokumen.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="5">Gagal memuat dokumen.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

function bindDocumentDownload(applicationId) {
    document.addEventListener('click', async (event) => {
        const button = event.target.closest('[data-download-document]');
        if (!button) {
            return;
        }

        event.preventDefault();
        button.disabled = true;

        try {
            await downloadRequest(
                `/applicant/applications/${applicationId}/documents/${button.dataset.downloadDocument}/download`,
                button.dataset.fileName || 'document'
            );
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            button.disabled = false;
        }
    });
}

function bindDocumentUpload(applicationId) {
    const form = document.querySelector('[data-upload-form]');
    if (!form) {
        return;
    }

    const button = form.querySelector('[data-upload-document]');
    if (!button) {
        return;
    }

    button.addEventListener('click', async () => {
        const formData = new FormData(form);
        formData.append('application_id', applicationId);

        button.disabled = true;
        setMessage(form, 'Mengupload...', 'info');

        try {
            const response = await apiRequest(`/applicant/applications/${applicationId}/documents`, {
                method: 'POST',
                body: formData
            });

            setMessage(form, response.message || 'Dokumen berhasil diupload', 'success');
            form.reset();
            loadDocuments(applicationId);
        } catch (error) {
            setMessage(form, validationMessage(error), 'error');
        } finally {
            button.disabled = false;
        }
    });
}

async function submitApplication(applicationId) {
    if (!confirm('Submit aplikasi ini? Tidak dapat diubah setelah submit.')) {
        return;
    }

    const button = document.querySelector('[data-submit-application]');
    if (button) {
        button.disabled = true;
    }

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}/submit`, {
            method: 'POST',
            body: JSON.stringify({})
        });

        pageMessage(response.message || 'Aplikasi berhasil disubmit', 'success');

        setTimeout(() => {
            window.location.assign('/applications');
        }, 1500);
    } catch (error) {
        pageMessage(validationMessage(error));
        if (button) {
            button.disabled = false;
        }
    }
}

async function loadApplicationDetail() {
    const applicationId = currentResourceId();
    if (!applicationId) {
        return;
    }

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}`);
        const app = response.data;
        const allowed = allowedApplicationSections(app.rpl_type);

        document.querySelector('[data-application-title]').textContent = `Application ${app.application_number}`;
        document.querySelector('[data-application-number]').textContent = app.application_number;
        document.querySelector('[data-application-status-badge]').textContent = getApplicationStatusLabel(app.status);
        syncApplicationSections(app.rpl_type);

        if (allowed.a1) {
            loadA1Courses(applicationId);
        }

        if (allowed.a2) {
            loadA2LearningExperiences(applicationId);
        }

        loadDocuments(applicationId);
        bindDocumentDownload(applicationId);
        bindSubmitApplication();
    } catch (error) {
        pageMessage(validationMessage(error));
    }
}

async function loadApplicationEdit() {
    const applicationId = currentResourceId();
    if (!applicationId) {
        return;
    }

    try {
        const response = await apiRequest(`/applicant/applications/${applicationId}`);
        const app = response.data;
        const allowed = allowedApplicationSections(app.rpl_type);

        document.querySelector('[data-application-title]').textContent = `Edit ${app.application_number}`;
        document.querySelector('[data-application-number]').textContent = app.application_number;
        document.querySelector('[data-application-status-badge]').textContent = getApplicationStatusLabel(app.status);
        syncApplicationSections(app.rpl_type);

        if (allowed.a1) {
            loadA1Courses(applicationId);
        }

        if (allowed.a2) {
            loadA2LearningExperiences(applicationId);
        }

        loadDocuments(applicationId);
        bindDocumentUpload(applicationId);
        bindDocumentDownload(applicationId);
        bindSubmitApplication();

        const submitSection = document.querySelector('[data-submit-section]');
        if (submitSection) {
            submitSection.hidden = app.status !== 'draft';
        }
    } catch (error) {
        pageMessage(validationMessage(error));
    }
}

function bindSubmitApplication() {
    const button = document.querySelector('[data-submit-application]');
    if (!button) {
        return;
    }

    button.addEventListener('click', () => {
        const applicationId = currentResourceId();
        if (applicationId) {
            submitApplication(applicationId);
        }
    });
}

async function loadApplicantProfile() {
    const profileCard = document.querySelector('[data-profile-card]');
    const form = document.querySelector('[data-profile-form]');

    if (!profileCard && !form) {
        return;
    }

    try {
        const response = await apiRequest('/applicant/profile');
        const profile = response.data || {};

        if (profileCard) {
            Object.entries({
                nik: profile.nik,
                phone: profile.phone,
                address: profile.address,
                'birth-place': profile.birth_place,
                'birth-date': profile.birth_date,
                gender: formatProfileValue('gender', profile.gender),
                'marital-status': formatProfileValue('marital_status', profile.marital_status),
                nationality: profile.nationality,
                'postal-code': profile.postal_code,
                'last-education': profile.last_education,
                'institution-name': profile.institution_name,
                'study-program': profile.study_program,
                'graduation-year': profile.graduation_year,
            }).forEach(([key, value]) => {
                profileCard.querySelectorAll(`[data-profile-${key}]`).forEach((target) => {
                    target.textContent = formatProfileValue(key, value);
                });
            });

            const complete = isProfileComplete(profile);
            const badge = profileCard.querySelector('[data-profile-completeness-badge]');
            const note = profileCard.querySelector('[data-profile-completeness-note]');

            if (badge) {
                badge.textContent = complete ? 'Lengkap' : 'Belum lengkap';
                badge.dataset.status = complete ? 'active' : 'draft';
            }

            if (note) {
                note.textContent = complete
                    ? 'Profil sudah siap untuk membuat pengajuan RPL.'
                    : 'Lengkapi field wajib sebelum membuat pengajuan RPL.';
            }
        }

        if (form) {
            Object.entries({
                phone: profile.phone,
                address: profile.address,
                birth_place: profile.birth_place,
                birth_date: profile.birth_date,
                gender: profile.gender,
                marital_status: profile.marital_status,
                nationality: profile.nationality || 'Indonesia',
                postal_code: profile.postal_code,
                last_education: profile.last_education,
                institution_name: profile.institution_name,
                study_program: profile.study_program,
                graduation_year: profile.graduation_year,
            }).forEach(([key, value]) => {
                if (form.elements[key]) {
                    form.elements[key].value = value || '';
                }
            });
        }
    } catch (error) {
        pageMessage(validationMessage(error));
    }
}

function bindApplicantProfileForm() {
    const form = document.querySelector('[data-profile-form]');
    if (!form) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const button = form.querySelector('[data-save-profile]');
        const payload = formPayload(form);

        button.disabled = true;
        setMessage(form, 'Menyimpan...', 'info');

        try {
            const response = await apiRequest('/applicant/profile', {
                method: 'PUT',
                body: JSON.stringify(payload),
            });

            setMessage(form, response.message || 'Profil berhasil disimpan.', 'success');

            setTimeout(() => {
                window.location.assign('/profile');
            }, 1000);
        } catch (error) {
            setMessage(form, validationMessage(error), 'error');
        } finally {
            button.disabled = false;
        }
    });
}

function bindModalHandlers() {
    document.addEventListener('click', (event) => {
        const closeBtn = event.target.closest('[data-close-modal]');
        if (closeBtn) {
            const modalName = closeBtn.dataset.closeModal;
            const modal = document.querySelector(`[data-modal="${modalName}"]`);
            if (modal) {
                modal.hidden = true;
            }
        }
    });
}

function bindA1CourseModal() {
    const addButton = document.querySelector('[data-add-a1-course]');
    const modal = document.querySelector('[data-modal="a1-course"]');
    const form = document.querySelector('[data-a1-course-form]');
    const saveButton = document.querySelector('[data-save-a1-course]');
    const title = document.querySelector('[data-a1-course-modal-title]');

    if (!addButton || !modal || !form || !saveButton) {
        return;
    }

    const openCreateModal = () => {
        form.reset();
        delete form.dataset.courseId;
        if (title) {
            title.textContent = 'Add A1 Course';
        }
        saveButton.textContent = 'Save';
        setMessage(form, '', 'info');
        modal.hidden = false;
    };

    const openEditModal = (button) => {
        form.reset();
        form.dataset.courseId = button.dataset.editA1Course;
        form.elements.course_code.value = button.dataset.courseCode || '';
        form.elements.course_name.value = button.dataset.courseName || '';
        form.elements.credits.value = button.dataset.credits || '';
        form.elements.grade.value = button.dataset.grade || '';
        form.elements.institution_name.value = button.dataset.institutionName || '';
        if (title) {
            title.textContent = 'Edit A1 Course';
        }
        saveButton.textContent = 'Update';
        setMessage(form, '', 'info');
        modal.hidden = false;
    };

    addButton.addEventListener('click', () => {
        openCreateModal();
    });

    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-edit-a1-course]');
        if (!button) {
            return;
        }

        event.preventDefault();
        openEditModal(button);
    });

    saveButton.addEventListener('click', async () => {
        const applicationId = currentResourceId();
        if (!applicationId) {
            return;
        }

        const payload = formPayload(form);

        saveButton.disabled = true;
        setMessage(form, 'Menyimpan...', 'info');

        try {
            const courseId = form.dataset.courseId;
            const response = await apiRequest(
                courseId
                    ? `/applicant/applications/${applicationId}/a1-courses/${courseId}`
                    : `/applicant/applications/${applicationId}/a1-courses`,
                {
                    method: courseId ? 'PUT' : 'POST',
                    body: JSON.stringify(payload)
                }
            );

            setMessage(form, response.message || 'A1 course berhasil disimpan', 'success');
            form.reset();
            delete form.dataset.courseId;

            setTimeout(() => {
                modal.hidden = true;
                loadA1Courses(applicationId);
            }, 1000);
        } catch (error) {
            setMessage(form, validationMessage(error), 'error');
        } finally {
            saveButton.disabled = false;
        }
    });
}

function bindA2ExperienceModal() {
    const addButton = document.querySelector('[data-add-a2-experience]');
    const modal = document.querySelector('[data-modal="a2-experience"]');
    const form = document.querySelector('[data-a2-experience-form]');
    const saveButton = document.querySelector('[data-save-a2-experience]');
    const isOngoingCheckbox = form?.querySelector('[data-is-ongoing]');
    const endDateInput = form?.querySelector('[data-end-date]');

    if (!addButton || !modal || !form || !saveButton) {
        return;
    }

    if (isOngoingCheckbox && endDateInput) {
        isOngoingCheckbox.addEventListener('change', () => {
            endDateInput.disabled = isOngoingCheckbox.checked;
            if (isOngoingCheckbox.checked) {
                endDateInput.value = '';
            }
        });
    }

    addButton.addEventListener('click', () => {
        form.reset();
        setMessage(form, '', 'info');
        if (endDateInput) {
            endDateInput.disabled = false;
        }
        modal.hidden = false;
    });

    saveButton.addEventListener('click', async () => {
        const applicationId = currentResourceId();
        if (!applicationId) {
            return;
        }

        const payload = formPayload(form, {
            booleanFields: ['is_ongoing']
        });

        saveButton.disabled = true;
        setMessage(form, 'Menyimpan...', 'info');

        try {
            const response = await apiRequest(`/applicant/applications/${applicationId}/a2-learning-experiences`, {
                method: 'POST',
                body: JSON.stringify(payload)
            });

            setMessage(form, response.message || 'Learning experience berhasil ditambahkan', 'success');
            form.reset();

            setTimeout(() => {
                modal.hidden = true;
                loadA2LearningExperiences(applicationId);
            }, 1000);
        } catch (error) {
            setMessage(form, validationMessage(error), 'error');
        } finally {
            saveButton.disabled = false;
        }
    });
}

export function bootApplicantPages() {
    const page = document.body.dataset.page;

    bindModalHandlers();
    bindApplicantProfileForm();

    if (page === 'profile' || page === 'profile-edit') {
        loadApplicantProfile();
    }

    if (page === 'applications') {
        loadApplications();
    }

    if (page === 'applications-create') {
        bindCreateApplication();
    }

    if (page === 'application-detail') {
        loadApplicationDetail();
    }

    if (page === 'application-edit') {
        loadApplicationEdit();
        bindA1CourseModal();
        bindA2ExperienceModal();
    }
}
