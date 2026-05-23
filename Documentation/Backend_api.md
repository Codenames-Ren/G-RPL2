# G-RPL2 Backend API Documentation

## Base URL

```txt
http://(your_ip_network):8000/api
```

---

# Required Headers

```http
Accept: application/json
Content-Type: application/json
```

Protected routes:

```http
Authorization: Bearer TOKEN
```

---

# Authentication

## Register Applicant

```http
POST /api/auth/register
```

### Request Body

```json
{
  "nik": "327xxxxxxxxx",
  "name": "Ren",
  "email": "ren@example.com",
  "phone": "08123456789",
  "address": "Jakarta",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Notes

- Applicant role assigned automatically
- Email verification required

---

## Login

```http
POST /api/auth/login
```

### Request Body

```json
{
  "email": "ren@example.com",
  "password": "password123"
}
```

---

## Verify Email

```http
GET /api/auth/email/verify/{id}/{hash}
```

---

## Current User

```http
GET /api/auth/me
```

---

## Logout

```http
POST /api/auth/logout
```

---

# Admin - Study Programs

### Middleware

```txt
auth:sanctum
role:system_admin
```

---

## Get All Study Programs

```http
GET /api/admin/study-programs
```

---

## Get Detail Study Program

```http
GET /api/admin/study-programs/{studyProgram}
```

---

## Create Study Program

```http
POST /api/admin/study-programs
```

### Request Body

```json
{
  "code": "TI",
  "name": "Teknik Informatika",
  "total_sks": 144,
  "max_convertible_sks": 100,
  "supports_a1": true,
  "supports_a2": true,
  "is_hybrid_allowed": true,
  "status": "active"
}
```

---

## Update Study Program

```http
PUT /api/admin/study-programs/{studyProgram}
```

### Request Body

```json
{
  "code": "TI",
  "name": "Teknik Informatika Updated",
  "total_sks": 144,
  "max_convertible_sks": 100,
  "supports_a1": true,
  "supports_a2": true,
  "is_hybrid_allowed": false,
  "status": "inactive"
}
```

---

# Admin - User Management

### Middleware

```txt
auth:sanctum
role:system_admin
```

---

## Get All Users

```http
GET /api/admin/users
```

---

## Get User Detail

```http
GET /api/admin/users/{user}
```

---

## Create User

```http
POST /api/admin/users
```

### Request Body

```json
{
  "name": "Sirius",
  "email": "sirius@grpl.com",
  "password": "Seadragon555",
  "password_confirmation": "Seadragon555",
  "nip": "198812347",
  "phone": "08222222222",
  "role": "committee"
}
```

---

## Update User

```http
PUT /api/admin/users/{user}
```

### Request Body

```json
{
  "name": "Updated User",
  "email": "updated@grpl.com",
  "password": "NewPassword123",
  "password_confirmation": "NewPassword123",
  "nip": "198812347",
  "phone": "08123456789"
}
```

---

## Toggle User Status

```http
PATCH /api/admin/users/{user}/status
```

### Request Body

```json
{
  "is_active": false
}
```

---

# Admin - Course Management

### Middleware

```txt
auth:sanctum
role:system_admin
```

---

## Get All Courses

```http
GET /api/admin/courses
```

---

## Get Detail Course

```http
GET /api/admin/courses/{course}
```

---

## Create Course

```http
POST /api/admin/courses
```

### Request Body

```json
{
  "study_program_ids": [1, 2],
  "code": "MKU101",
  "name": "Pengantar Teknologi Informasi",
  "semester": 1,
  "sks": 2,
  "rpl_type": "hybrid"
}
```

---

## Update Course

```http
PUT /api/admin/courses/{course}
```

### Request Body

```json
{
  "study_program_ids": [1],
  "code": "MKU101",
  "name": "Pengantar Teknologi Informasi Updated",
  "semester": 2,
  "sks": 3,
  "rpl_type": "a1"
}
```

---

## Toggle Course Status

```http
PATCH /api/admin/courses/{course}/status
```

### Request Body

```json
{
  "is_active": false
}
```

---

# General Error Response

## 401 Unauthenticated

```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

---

## 403 Forbidden

```json
{
  "success": false,
  "message": "Forbidden access"
}
```

---

## 422 Validation Error

```json
{
  "message": "The given data was invalid.",
  "errors": {}
}
```