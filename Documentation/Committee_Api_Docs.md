# Committee Module — API Documentation

Base URL: `/api/committee`

All endpoints require:
- **Authentication**: `Bearer {token}` via Sanctum
- **Role**: `committee`

---

## Applications

### 1. List Assessed Applications

Mengembalikan semua aplikasi dengan status `ASSESSED` (belum di-approve).

```
GET /applications
```

**Request Body**: None

**Response `200`**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "application_number": "APP-2024-001",
            "status": "assessed",
            "applicant": {
                "user": {
                    "id": 1,
                    "name": "John Doe",
                    "email": "john@example.com"
                }
            },
            "study_program": {
                "id": 1,
                "name": "Teknik Informatika"
            },
            "assessment": {
                "course_mappings": [
                    {
                        "course": {
                            "id": 1,
                            "name": "Algoritma dan Pemrograman",
                            "sks": 3
                        }
                    }
                ]
            },
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

---

### 2. List Approved Applications

Mengembalikan semua aplikasi dengan status `APPROVED` (sudah final).

```
GET /applications/approved
```

**Request Body**: None

**Response `200`**
```json
{
    "success": true,
    "data": [
        {
            "id": 2,
            "application_number": "APP-2024-002",
            "status": "approved",
            "applicant": {
                "user": {
                    "id": 2,
                    "name": "Jane Doe",
                    "email": "jane@example.com"
                }
            },
            "study_program": {
                "id": 1,
                "name": "Teknik Informatika"
            },
            "assessment": {
                "course_mappings": [
                    {
                        "course": {
                            "id": 1,
                            "name": "Algoritma dan Pemrograman",
                            "sks": 3
                        }
                    }
                ]
            },
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-02T00:00:00.000000Z"
        }
    ]
}
```

---

### 3. Application Detail (Assessed & Approved)

Mengembalikan detail lengkap satu aplikasi. Bisa diakses untuk status `ASSESSED` maupun `APPROVED`.

```
GET /applications/{application}
```

**Path Parameter**

| Parameter     | Type    | Description          |
|---------------|---------|----------------------|
| `application` | integer | ID dari application  |

**Request Body**: None

**Response `200`**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "application_number": "APP-2024-001",
        "status": "assessed",
        "review_notes": null,
        "applicant": {
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "john@example.com"
            }
        },
        "study_program": {
            "id": 1,
            "name": "Teknik Informatika"
        },
        "documents": [
            {
                "id": 1,
                "file_name": "transkrip.pdf",
                "file_path": "documents/transkrip.pdf"
            }
        ],
        "assessment": {
            "total_converted_sks": 18,
            "assessor": {
                "user": {
                    "id": 3,
                    "name": "Dr. Assessor"
                }
            },
            "course_mappings": [
                {
                    "is_recognized": true,
                    "course": {
                        "id": 1,
                        "name": "Algoritma dan Pemrograman",
                        "sks": 3
                    },
                    "application_a1_course": {},
                    "application_a2_learning_experience": {}
                }
            ]
        }
    }
}
```

**Response `404`** — Application tidak ditemukan atau statusnya bukan ASSESSED/APPROVED
```json
{
    "message": "No query results for model [App\\Models\\Application] {id}"
}
```

---

### 4. Approved Application Detail

Mengembalikan detail lengkap satu aplikasi dengan status `APPROVED`.

```
GET /applications/approved/{application}
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**: None

**Response `200`**
```json
{
    "success": true,
    "data": {
        "id": 2,
        "application_number": "APP-2024-002",
        "status": "approved",
        "review_notes": "Semua dokumen lengkap dan valid.",
        "applicant": {
            "user": {
                "id": 2,
                "name": "Jane Doe",
                "email": "jane@example.com"
            }
        },
        "study_program": {
            "id": 1,
            "name": "Teknik Informatika"
        },
        "documents": [
            {
                "id": 2,
                "file_name": "transkrip.pdf",
                "file_path": "documents/transkrip.pdf"
            }
        ],
        "assessment": {
            "course_mappings": [
                {
                    "is_recognized": true,
                    "course": {
                        "id": 1,
                        "name": "Algoritma dan Pemrograman",
                        "sks": 3
                    },
                    "application_a1_course": {},
                    "application_a2_learning_experience": {}
                }
            ]
        }
    }
}
```

**Response `422`** — Application ditemukan tapi statusnya bukan APPROVED
```json
{
    "message": "Application is not approved."
}
```

---

### 5. Approve Application

Mengubah status aplikasi dari `ASSESSED` menjadi `APPROVED`.

```
PATCH /applications/{application}/approve
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**

| Field   | Type   | Required | Description                      |
|---------|--------|----------|----------------------------------|
| `notes` | string | No       | Catatan review dari committee    |

```json
{
    "notes": "Semua dokumen lengkap dan valid."
}
```

**Response `200`**
```json
{
    "success": true,
    "message": "Application approved successfully.",
    "data": {
        "id": 1,
        "application_number": "APP-2024-001",
        "status": "approved",
        "review_notes": "Semua dokumen lengkap dan valid.",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-02T00:00:00.000000Z"
    }
}
```

**Response `422`** — Application sudah pernah di-approve sebelumnya
```json
{
    "message": "Application has already been approved."
}
```

**Response `404`** — Application tidak ditemukan atau statusnya bukan ASSESSED/APPROVED
```json
{
    "message": "No query results for model [App\\Models\\Application] {id}"
}
```

---

## Documents

> Semua endpoint dokumen bisa diakses untuk aplikasi dengan status `ASSESSED` maupun `APPROVED`.

### 6. Preview Rector Decree (SK Rektor)

Menampilkan PDF SK Rektor langsung di browser.

```
GET /applications/{application}/rector-decree/preview
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**: None

**Response `200`** — PDF stream (inline)

```
Content-Type: application/pdf
Content-Disposition: inline; filename="sk-rektor.pdf"
```

**Response `404`** — Application tidak ditemukan atau status tidak valid

---

### 7. Download Rector Decree (SK Rektor)

Mendownload PDF SK Rektor.

```
GET /applications/{application}/rector-decree/download
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**: None

**Response `200`** — PDF download

```
Content-Type: application/pdf
Content-Disposition: attachment; filename="SK-Rektor-APP-2024-001.pdf"
```

**Response `404`** — Application tidak ditemukan atau status tidak valid

---

### 8. Preview Assessment Summary

Menampilkan PDF Assessment Summary langsung di browser.

```
GET /applications/{application}/assessment-summary/preview
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**: None

**Response `200`** — PDF stream (inline)

```
Content-Type: application/pdf
Content-Disposition: inline; filename="assessment-summary.pdf"
```

**Response `404`** — Application tidak ditemukan atau status tidak valid

---

### 9. Download Assessment Summary

Mendownload PDF Assessment Summary.

```
GET /applications/{application}/assessment-summary/download
```

**Path Parameter**

| Parameter     | Type    | Description         |
|---------------|---------|---------------------|
| `application` | integer | ID dari application |

**Request Body**: None

**Response `200`** — PDF download

```
Content-Type: application/pdf
Content-Disposition: attachment; filename="Assessment-Summary-APP-2024-001.pdf"
```

**Response `404`** — Application tidak ditemukan atau status tidak valid

---

## Status Reference

| Status     | Keterangan                                          |
|------------|-----------------------------------------------------|
| `assessed` | Sudah dinilai oleh assessor, menunggu approval committee |
| `approved` | Sudah di-approve oleh committee, status final       |

---

## Error Reference

| HTTP Code | Keterangan                                               |
|-----------|----------------------------------------------------------|
| `401`     | Unauthenticated — token tidak ada atau tidak valid       |
| `403`     | Unauthorized — role bukan `committee`                    |
| `404`     | Application tidak ditemukan atau status tidak sesuai     |
| `422`     | Validasi gagal — lihat `message` untuk detail            |