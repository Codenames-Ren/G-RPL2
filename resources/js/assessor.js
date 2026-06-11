import { apiRequest, downloadRequest } from './api.js';
import {
    escapeHtml, collection, currentResourceId, setMessage, validationMessage,
    pageMessage, getApplicationStatusLabel, getApplicationTypeLabel,
    allowedApplicationSections, syncApplicationSections
} from './utils.js';
import Swal from 'sweetalert2';

const assessmentState = {
    applicationId: null,
    assessmentId: null,
    rplType: null,
    a1Courses: [],
    a2Experiences: [],
    hasAssessment: false,
    usedA1SourceIds: new Set(),
    usedA2SourceIds: new Set(),
};

function currentAssessmentId() {
    const el = document.querySelector('[data-assessment-id]');
    return el ? el.dataset.assessmentId : null;
}

async function loadAssessments() {
    const target = document.querySelector('[data-assessments-body]');
    if (!target) return;

    try {
        const response = await apiRequest('/assessor/assessments');
        const assessments = collection(response);

        target.innerHTML = assessments.length
            ? assessments.map((app) => {
                const applicantName = app.applicant?.user?.name || '-';
                const studyProgram = app.study_program?.name || '-';
                const status = app.status || 'under_assessment';
                const submittedAt = app.submitted_at || app.created_at
                    ? new Date(app.submitted_at || app.created_at).toLocaleDateString('id-ID')
                    : '-';
                return `
                    <tr>
                        <td>${escapeHtml(app.application_number || '-')}</td>
                        <td>${escapeHtml(applicantName)}</td>
                        <td>${escapeHtml(studyProgram)}</td>
                        <td>${getApplicationTypeLabel(app.rpl_type)}</td>
                        <td><span class="status-badge" data-status="${escapeHtml(status)}">${getApplicationStatusLabel(status)}</span></td>
                        <td>${submittedAt}</td>
                        <td class="table-actions">
                            <a class="button button-small button-muted" href="/assessments/${app.id}">Detail</a>
                        </td>
                    </tr>
                `;
            }).join('')
            : '<tr><td colspan="7">Tidak ada assessment yang ditugaskan.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="7">Gagal memuat assessments.</td></tr>';
        pageMessage(validationMessage(error));
    }
}

async function loadAssessmentDetail() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    try {
        const response = await apiRequest(`/assessor/assessments/${applicationId}`);
        const app = response.data;
        const allowed = allowedApplicationSections(app.rpl_type);

        assessmentState.applicationId = applicationId;
        assessmentState.assessmentId = app.assessment?.id || null;
        assessmentState.rplType = app.rpl_type;
        assessmentState.hasAssessment = Boolean(app.assessment);

        if (app.a1_courses) {
            assessmentState.a1Courses = app.a1_courses;
        }
        if (app.a2_learning_experiences) {
            assessmentState.a2Experiences = app.a2_learning_experiences;
        }

        document.querySelector('[data-assessment-title]').textContent = `Assessment ${app.application_number}`;
        document.querySelector('[data-assessment-number]').textContent = app.application_number;
        document.querySelector('[data-assessment-status-badge]').textContent = getApplicationStatusLabel(app.status);

        document.querySelector('[data-detail-applicant-name]').textContent = app.applicant?.user?.name || '-';
        document.querySelector('[data-detail-applicant-email]').textContent = app.applicant?.user?.email || '-';
        document.querySelector('[data-detail-study-program]').textContent = app.study_program?.name || '-';
        document.querySelector('[data-detail-rpl-type]').textContent = getApplicationTypeLabel(app.rpl_type);
        document.querySelector('[data-detail-total-sks]').textContent = app.assessment?.total_converted_sks ?? '-';
        document.querySelector('[data-detail-recommendation]').textContent = app.assessment?.recommendation || '-';
        document.querySelector('[data-detail-notes]').textContent = app.assessment?.notes || app.notes || '-';
        document.querySelector('[data-detail-submitted-at]').textContent = app.created_at
            ? new Date(app.created_at).toLocaleDateString('id-ID')
            : '-';

        const shell = document.querySelector('[data-protected-shell]');
        if (shell) {
            shell.dataset.assessmentId = assessmentState.assessmentId || '';
        }

        syncApplicationSections(app.rpl_type);

        const hasAssessment = assessmentState.hasAssessment;
        const canSubmit = hasAssessment && app.status === 'under_assessment';

        const createBtn = document.querySelector('[data-create-assessment]');
        if (createBtn) {
            createBtn.hidden = hasAssessment;
        }

        const submitBtn = document.querySelector('[data-submit-assessment]');
        if (submitBtn) {
            submitBtn.hidden = !canSubmit;
        }

        const shouldShowMapping = hasAssessment && app.status === 'under_assessment';
        const mappingActions = document.querySelector('[data-mapping-actions]');
        if (mappingActions) {
            mappingActions.dataset.allowMapping = shouldShowMapping ? 'true' : 'false';
            mappingActions.hidden = true;
        }

        const addA1Btn = document.querySelector('[data-add-a1-mapping]');
        if (addA1Btn) {
            addA1Btn.hidden = !hasAssessment || app.status !== 'under_assessment' || !allowed.a1;
        }

        const addA2Btn = document.querySelector('[data-add-a2-mapping]');
        if (addA2Btn) {
            addA2Btn.hidden = !hasAssessment || app.status !== 'under_assessment' || !allowed.a2;
        }

        if (allowed.a1 && app.a1_courses) {
            renderA1CoursesStatic(app.a1_courses);
        }

        if (allowed.a2 && app.a2_learning_experiences) {
            renderA2ExperiencesStatic(app.a2_learning_experiences);
        }

        if (hasAssessment) {
            loadAssessmentMappings(app.assessment.id);
        }

        if (app.documents) {
            renderAssessmentDocuments(app.documents, applicationId);
        }

        // sync visibility mapping actions berdasarkan tab aktif
        if (window.syncMappingActionsVisibility) {
            window.syncMappingActionsVisibility();
        }

    } catch (error) {

        if (
            error?.status === 404 ||
            error?.status === 403
        ) {
            Swal.fire({
                title: 'Akses Ditolak',
                text: 'Assessment tidak ditemukan',
                icon: 'error'
            }).then(() => {
                window.location.replace('/assessments');
            });

            return;
        }

        pageMessage(validationMessage(error));
    }
}

function renderA1CoursesStatic(courses) {
    const target = document.querySelector('[data-a1-courses-body]');
    if (!target) return;

    target.innerHTML = courses.length
        ? courses.map((course) => `
            <tr data-course-id="${escapeHtml(course.id)}">
                <td>${escapeHtml(course.course_code)}</td>
                <td>${escapeHtml(course.course_name)}</td>
                <td>${escapeHtml(course.credits)}</td>
                <td>${escapeHtml(course.grade)}</td>
                <td>${escapeHtml(course.institution_name)}</td>
            </tr>
        `).join('')
        : '<tr><td colspan="5">Tidak ada data A1 course.</td></tr>';
}

function renderA2ExperiencesStatic(experiences) {
    const target = document.querySelector('[data-a2-experiences-body]');
    if (!target) return;

    target.innerHTML = experiences.length
        ? experiences.map((exp) => {
            const startDate = exp.start_date ? new Date(exp.start_date).toLocaleDateString('id-ID') : '-';
            const endDate = exp.end_date ? new Date(exp.end_date).toLocaleDateString('id-ID') : (exp.is_ongoing ? 'Ongoing' : '-');
            return `
                <tr data-experience-id="${escapeHtml(exp.id)}">
                    <td>${escapeHtml(exp.title)}</td>
                    <td>${escapeHtml(exp.experience_type)}</td>
                    <td>${escapeHtml(exp.organization_name)}</td>
                    <td>${startDate} - ${endDate}</td>
                    <td>${escapeHtml(exp.description || '-')}</td>
                </tr>
            `;
        }).join('')
        : '<tr><td colspan="5">Tidak ada data learning experience.</td></tr>';
}

async function loadAssessmentMappings(assessmentId) {
    const target = document.querySelector('[data-assessment-mappings-body]');
    if (!target) return;

    try {
        const response = await apiRequest(`/assessor/assessments/${assessmentId}/mappings`);
        const mappings = collection(response);

        assessmentState.usedA1SourceIds = new Set(
            mappings
                .filter(m => m.application_a1_course_id)
                .map(m => String(m.application_a1_course_id))
        );

        assessmentState.usedA2SourceIds = new Set(
            mappings
                .filter(m => m.application_a2_learning_experience_id)
                .map(m => String(m.application_a2_learning_experience_id))
        );

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
            : '<tr><td colspan="6">Belum ada mapping.</td></tr>';
    } catch (error) {
        target.innerHTML = '<tr><td colspan="6">Gagal memuat mapping.</td></tr>';
    }
}

function renderAssessmentDocuments(documents, applicationId) {
    const target = document.querySelector('[data-documents-body]');
    if (!target) return;

    target.innerHTML = documents.length
        ? documents.map((doc) => `
            <tr>
                <td>${escapeHtml(doc.document_name || doc.file_name || '-')}</td>
                <td>${escapeHtml(doc.document_type || doc.type || '-')}</td>
                <td class="table-actions">
                    <button class="button button-small button-muted" type="button" data-download-assessment-doc="${doc.id}" data-file-name="${escapeHtml(doc.file_name || doc.document_name || 'document')}">
                        Download
                    </button>
                </td>
            </tr>
        `).join('')
        : '<tr><td colspan="3">Tidak ada dokumen.</td></tr>';

    document.addEventListener('click', async (event) => {
        const button = event.target.closest('[data-download-assessment-doc]');
        if (!button) return;

        event.preventDefault();
        button.disabled = true;

        try {
            await downloadRequest(
                `/assessor/assessments/${applicationId}/documents/${button.dataset.downloadAssessmentDoc}/download`,
                button.dataset.fileName || 'document'
            );
        } catch (error) {
            pageMessage(validationMessage(error));
        } finally {
            button.disabled = false;
        }
    });
}

function bindAssessorActions() {
    const applicationId = currentResourceId();
    if (!applicationId) return;

    const createBtn = document.querySelector('[data-create-assessment]');
    if (createBtn) {
        createBtn.addEventListener('click', async () => {
            const confirm = await Swal.fire({
                title: 'Mulai Penilaian?',
                text: 'Penilaian untuk aplikasi ini akan dimulai. Lanjutkan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Mulai',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
            });

            if (!confirm.isConfirmed) return;
            createBtn.disabled = true;

            try {
                await apiRequest(`/assessor/assessments/${applicationId}`, {
                    method: 'POST',
                    body: JSON.stringify({ notes: '' })
                });

                await Swal.fire({
                    title: 'Penilaian Dimulai',
                    text: 'Penilaian berhasil dibuat. Silakan tambahkan mapping mata kuliah.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#2563eb',
                });

                loadAssessmentDetail();
            } catch (error) {
                Swal.fire({
                    title: 'Gagal Memulai Penilaian',
                    text: 'Penilaian untuk aplikasi ini sudah pernah dibuat sebelumnya.',
                    icon: 'error',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#2563eb',
                });
            } finally {
                createBtn.disabled = false;
            }
        });
    }

    const submitBtn = document.querySelector('[data-submit-assessment]');
    if (submitBtn) {
        submitBtn.addEventListener('click', async () => {
            const confirm = await Swal.fire({
                title: 'Submit Penilaian?',
                text: 'Penilaian akan difinalisasi dan tidak dapat diubah setelah ini. Pastikan semua mapping sudah benar.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Submit',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
            });

            if (!confirm.isConfirmed) return;
            submitBtn.disabled = true;

            try {
                const response = await apiRequest(`/assessor/assessments/${assessmentState.assessmentId}/submit`, {
                    method: 'POST',
                    body: JSON.stringify({})
                });

                const recommendation = response.data?.recommendation;
                const totalSks = response.data?.total_converted_sks ?? 0;

                if (recommendation === 'pass') {
                    await Swal.fire({
                        title: 'Penilaian Disetujui',
                        text: `Penilaian berhasil disubmit. Total ${totalSks} SKS berhasil dikonversi.`,
                        icon: 'success',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#2563eb',
                    });
                } else {
                    await Swal.fire({
                        title: 'Penilaian Tidak Lolos',
                        text: 'Tidak ada mata kuliah yang diakui dalam penilaian ini. Aplikasi dikembalikan ke pemohon.',
                        icon: 'info',
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#2563eb',
                    });
                }

                window.location.replace('/assessments');
            } catch (error) {
                const status = error?.status;

                const message = status === 422
                    ? 'Penilaian tidak dapat disubmit. Pastikan minimal ada satu mapping dan penilaian belum pernah disubmit sebelumnya.'
                    : 'Terjadi kesalahan saat mengsubmit penilaian. Silakan coba beberapa saat lagi.';

                Swal.fire({
                    title: 'Gagal Submit Penilaian',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#2563eb',
                });
            } finally {
                submitBtn.disabled = false;
            }
        });
    }

    const addA1Btn = document.querySelector('[data-add-a1-mapping]');
    const addA2Btn = document.querySelector('[data-add-a2-mapping]');
    const mappingModal = document.querySelector('[data-modal="create-mapping"]');
    const mappingForm = document.querySelector('[data-mapping-form]');
    const submitMappingBtn = document.querySelector('[data-submit-mapping]');
    const courseSelect = document.querySelector('[data-course-select]');
    const sourceSelect = document.querySelector('[name="source_id"]');
    const sourceNameDisplay = mappingForm?.querySelector('[data-mapping-source-name]');

    if (addA1Btn) {
        addA1Btn.addEventListener('click', () => openMappingModal('a1'));
    }

    if (addA2Btn) {
        addA2Btn.addEventListener('click', () => openMappingModal('a2'));
    }

    function openMappingModal(sourceType) {
        if (!mappingModal || !mappingForm) return;

        mappingForm.reset();
        mappingForm.querySelector('[data-source-type]').value = sourceType;
        setMessage(mappingForm, '', 'info');

        const title = mappingForm.querySelector('[data-mapping-modal-title]');
        if (title) {
            title.textContent = sourceType === 'a1' ? 'Mapping Matakuliah A1' : 'Mapping Matakuliah A2';
        }

        const sources = sourceType === 'a1' ? assessmentState.a1Courses : assessmentState.a2Experiences;
        const labelKey = sourceType === 'a1' ? 'course_name' : 'title';
        const idAttr = sourceType === 'a1' ? 'course_code' : 'experience_type';

        const usedIds = sourceType === 'a1' ? assessmentState.usedA1SourceIds : assessmentState.usedA2SourceIds;
        const availableSources = sources.filter(s => !usedIds.has(String(s.id)));

        if (sourceSelect) {
            sourceSelect.innerHTML = availableSources.length
                ? '<option value="">-- Pilih Sumber --</option>' +
                availableSources.map((s) => `<option value="${s.id}">${escapeHtml(s[labelKey] || s[idAttr] || 'Item ' + s.id)}</option>`).join('')
                : '<option value="">Semua sumber sudah mapping</option>';
        }

        if (sourceNameDisplay) {
            sourceNameDisplay.textContent = sourceType === 'a1' ? 'A1 Course' : 'A2 Learning Experience';
        }

        const recognizedSelect = mappingForm.querySelector('[data-recognized-select]');
        const courseWrapper = mappingForm.querySelector('[data-course-select-wrapper]');

        if (recognizedSelect && courseWrapper) {
            courseWrapper.hidden = recognizedSelect.value !== '1';

            recognizedSelect.onchange = function () {
                courseWrapper.hidden = this.value !== '1';
                if (this.value !== '1') {
                    mappingForm.elements.course_id.value = '';
                }
            };
        }

        const studyProgramSelect = mappingForm.querySelector('[data-study-program-select]');
        const semesterSelect = mappingForm.querySelector('[data-semester-select]');

        if (studyProgramSelect) {
            studyProgramSelect.innerHTML = '<option value="">Memuat prodi...</option>';

            apiRequest('/study-programs').then((response) => {
                const programs = collection(response);
                studyProgramSelect.innerHTML = '<option value="">-- Semua Prodi --</option>' +
                    programs.map((p) => `<option value="${p.id}">${escapeHtml(p.name)}</option>`).join('');

                // default ke semua prodi, langsung load semua course
                loadCourseOptions(null, null);
            }).catch(() => {
                studyProgramSelect.innerHTML = '<option value="">Gagal memuat prodi</option>';
                loadCourseOptions();
            });

            studyProgramSelect.onchange = function () {
                loadCourseOptions(this.value || null, semesterSelect?.value || null);
            };
        } else {
            loadCourseOptions();
        }

        if (semesterSelect) {
            semesterSelect.onchange = function () {
                loadCourseOptions(studyProgramSelect?.value || null, this.value || null);
            };
        }

        mappingModal.hidden = false;
    }

    function loadCourseOptions(studyProgramId = null, semester = null) {
        if (!courseSelect) return;

        courseSelect.innerHTML = '<option value="">Memuat course...</option>';

        const params = new URLSearchParams();
        if (studyProgramId) params.set('study_program_id', studyProgramId);
        if (semester) params.set('semester', semester);

        const url = '/courses' + (params.toString() ? '?' + params.toString() : '');

        apiRequest(url).then((response) => {
            const courses = collection(response);

            courseSelect.innerHTML = courses.length
                ? '<option value="">-- Pilih Mata Kuliah Tujuan --</option>' +
                courses.map((c) => `<option value="${c.id}">${escapeHtml(c.code || '')} ${escapeHtml(c.name)} - Sem ${escapeHtml(String(c.semester))} (${escapeHtml(String(c.sks))} SKS)</option>`).join('')
                : '<option value="">Tidak ada course untuk filter ini</option>';
        }).catch(() => {
            courseSelect.innerHTML = '<option value="">Gagal memuat course</option>';
        });
    }

    if (submitMappingBtn && mappingForm) {
        submitMappingBtn.addEventListener('click', async () => {
            const sourceType = mappingForm.querySelector('[data-source-type]').value;
            const sourceId = mappingForm.elements.source_id?.value;
            const courseId = mappingForm.elements.course_id.value;
            const isRecognized = mappingForm.querySelector('[data-recognized-select]').value === '1';
            const notes = mappingForm.elements.notes.value.trim();

            if (!assessmentState.assessmentId) {
                setMessage(mappingForm, 'Assessment belum dibuat.', 'error');
                return;
            }

            if (!sourceId) {
                setMessage(mappingForm, 'Pilih sumber terlebih dahulu.', 'error');
                return;
            }

            if (isRecognized && !courseId) {
                setMessage(mappingForm, 'Pilih mata kuliah tujuan untuk mapping yang diakui.', 'error');
                return;
            }

            const payload = {};
            if (sourceType === 'a1') {
                payload.application_a1_course_id = Number(sourceId);
            } else {
                payload.application_a2_learning_experience_id = Number(sourceId);
            }

            if (isRecognized) {
                payload.course_id = Number(courseId);
            }
            payload.is_recognized = isRecognized;
            payload.notes = notes;

            submitMappingBtn.disabled = true;
            setMessage(mappingForm, 'Menyimpan...', 'info');

            try {
                await apiRequest(`/assessor/assessments/${assessmentState.assessmentId}/mappings`, {
                    method: 'POST',
                    body: JSON.stringify(payload)
                });

                mappingModal.hidden = true;
                mappingForm.reset();

                await Swal.fire({
                    title: 'Mapping Tersimpan',
                    text: 'Mapping mata kuliah berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#2563eb',
                });

                loadAssessmentMappings(assessmentState.assessmentId);
            } catch (error) {
                const status = error?.status;

                const message = status === 422
                    ? 'Mapping gagal disimpan. Kemungkinan mata kuliah tujuan sudah dipakai di mapping lain, atau sumber tidak valid.'
                    : 'Terjadi kesalahan saat menyimpan mapping. Silakan coba beberapa saat lagi.';

                setMessage(mappingForm, message, 'error');
            } finally {
                submitMappingBtn.disabled = false;
            }
        });
    }
}

export function bootAssessorPages() {
    const page = document.body.dataset.page;

    if (page === 'assessments') {
        loadAssessments();
    }

    if (page === 'assessment-detail') {
        loadAssessmentDetail();
        bindAssessorActions();
    }
}
