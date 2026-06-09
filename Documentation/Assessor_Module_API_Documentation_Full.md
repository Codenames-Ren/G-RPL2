# Assessor Module API Documentation

## Base URL

`/api/assessor/assessments`

Authentication:

`Authorization: Bearer {token}`

Role:

`assessor`

---

## 1. Get Assigned Applications

### Endpoint

`GET /api/assessor/assessments`

### Description

Returns all applications assigned to the logged-in assessor with status `under_assessment`.

### Success Response

```json
{
  "success": true,
  "data": []
}
```

---

## 2. Get Assessment Detail

### Endpoint

`GET /api/assessor/assessments/applications/{application}`

### Description

Returns:

* Applicant Information
* A1 Courses
* A2 Learning Experiences
* Uploaded Documents
* Assessment Data
* Course Mappings
* Total Converted SKS

### Success Response

```json
{
  "success": true,
  "data": {
    "id": 1,
    "application_number": "RPL-2026-WBFMDK",
    "rpl_type": "hybrid",

    "documents": [
      {
        "id": 1,
        "type": "transcript"
      },
      {
        "id": 2,
        "type": "certificate"
      }
    ],

    "assessment": {
      "id": 1,
      "recommendation": "pass",
      "total_converted_sks": 25
    }
  }
}
```

---

## 3. Create Assessment

### Endpoint

`POST /api/assessor/assessments/applications/{application}`

### Request Body

```json
{
  "notes": "Initial assessment notes"
}
```

### Success Response

```json
{
  "success": true,
  "message": "Assessment created successfully.",
  "data": {}
}
```

---

## 4. Get Course Mappings

### Endpoint

`GET /api/assessor/assessments/{assessment}/mappings`

### Success Response

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "application_a1_course_id": 1,
      "course_id": 10,
      "is_recognized": true
    }
  ]
}
```

---

## 5. Create Course Mapping

### Endpoint

`POST /api/assessor/assessments/{assessment}/mappings`

### A1 Mapping

```json
{
  "application_a1_course_id": 1,
  "course_id": 10,
  "is_recognized": true,
  "notes": "Equivalent course."
}
```

### A2 Mapping

```json
{
  "application_a2_learning_experience_id": 1,
  "course_id": 12,
  "is_recognized": true,
  "notes": "Learning experience accepted."
}
```

### Rejected Mapping

```json
{
  "application_a1_course_id": 1,
  "is_recognized": false,
  "notes": "Not eligible."
}
```

### Validation Rules

* application_a1_course_id OR application_a2_learning_experience_id wajib diisi
* course_id wajib jika is_recognized = true
* source harus milik application yang sedang dinilai
* target course tidak boleh dipakai dua kali dalam assessment yang sama
* mapping duplikat tidak diperbolehkan

### Success Response

```json
{
  "success": true,
  "message": "Course mapping created successfully.",
  "data": {}
}
```

---

## 6. Update Course Mapping

### Endpoint

`PUT /api/assessor/assessments/mappings/{mapping}`

### Request Body

```json
{
  "course_id": 10,
  "is_recognized": true,
  "notes": "Updated mapping."
}
```

### Success Response

```json
{
  "success": true,
  "message": "Course mapping updated successfully.",
  "data": {}
}
```

---

## 7. Submit Assessment

### Endpoint

`POST /api/assessor/assessments/{assessment}/submit`

### Rules

* Minimal memiliki 1 mapping
* Assessment hanya dapat disubmit satu kali
* Mapping recognized dihitung sebagai hasil konversi
* Total SKS dihitung dari seluruh course yang berhasil dikonversi
* Jika ada course yang recognized → application menjadi assessed
* Jika tidak ada yang recognized → application menjadi rejected

### Success Response

```json
{
  "success": true,
  "message": "Assessment submitted successfully.",
  "data": {
    "id": 1,
    "recommendation": "pass",
    "submitted_at": "2026-06-08T07:03:11.000000Z",
    "total_converted_sks": 25,

    "course_mappings": [
      {
        "application_a1_course": {
          "course_name": "Pemrogramman Web 1"
        },
        "course": {
          "name": "Pemrogramman Web I",
          "sks": 3
        },
        "is_recognized": true
      },
      {
        "application_a2_learning_experience": {
          "title": "Golang Backend Certification"
        },
        "course": {
          "name": "Pengantar Cloud Computing",
          "sks": 2
        },
        "is_recognized": true
      },
      {
        "application_a1_course": {
          "course_name": "Bahasa Jepang"
        },
        "course": null,
        "is_recognized": false
      }
    ],

    "application": {
      "status": "assessed"
    }
  }
}
```

---

# Business Rules

## A1

Course Lama → Course Global

Contoh:

Bahasa Inggris → Bahasa Inggris IV

## A2

Learning Experience → Course Global

Contoh:

Golang Backend Certification → Pengantar Cloud Computing

## Hybrid

A1 dan A2 dapat dipetakan secara independen.

Contoh:

Pemrogramman Web 1 → Pemrogramman Web I

Golang Backend Certification → Pengantar Cloud Computing

## Tidak Diperbolehkan

A1 Course #1 → OOP

A2 Experience #1 → OOP

(Target course yang sama dipakai dua kali dalam assessment yang sama)

---

# Status Flow

→ draft
→ submitted
→ under_review
→ under_assessment
→ assessed
