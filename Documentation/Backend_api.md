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

# Authentication Flow

```txt
Register
→ Verification Email
→ Verify Email
→ Login
→ Get Sanctum Token
→ Access Protected API
→ Logout
```

---

# 1. Register Applicant

## Endpoint

```http
POST /api/auth/register
```

## Request Body

```json
{
  "name": "Ren",
  "email": "ren@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

## Success Response

```json
{
  "success": true,
  "message": "Verification email sent successfully",
  "user": {
    "id": 1,
    "name": "Ren",
    "email": "ren@example.com",
    "status": "active"
  }
}
```

## Notes

* Applicant role assigned automatically
* Verification email required before login
* No token returned on register

---

# 2. Login

## Endpoint

```http
POST /api/auth/login
```

## Request Body

```json
{
  "email": "ren@example.com",
  "password": "password123"
}
```

## Success Response

```json
{
  "success": true,
  "message": "Login success",
  "token": "1|sanctum_token_here",
  "user": {
    "id": 1,
    "name": "Ren",
    "email": "ren@example.com"
  }
}
```

## Email Not Verified

```json
{
  "success": false,
  "message": "Email not verified"
}
```

---

# 3. Email Verification

## Endpoint

```http
GET /api/auth/email/verify/{id}/{hash}
```

## Success Response

```json
{
  "success": true,
  "message": "Email verified successfully"
}
```

---

# 4. Current User

## Endpoint

```http
GET /api/auth/me
```

## Middleware

```txt
auth:sanctum
```

## Success Response

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Ren",
    "email": "ren@example.com"
  }
}
```

---

# 5. Logout

## Endpoint

```http
POST /api/auth/logout
```

## Middleware

```txt
auth:sanctum
```

## Success Response

```json
{
  "success": true,
  "message": "Logout success"
}
```

---

# Rate Limit

| Endpoint    | Limit     |
| ----------- | --------- |
| Login       | 5/minute  |
| Register    | 3/minute  |
| General API | 60/minute |

---

# Queue Worker

```bash
php artisan queue:work
```

---

# 6. Get All Study Programs

## Endpoint

```http
GET /api/admin/study-programs
```

## Middleware

```txt
auth:sanctum
role:system_admin
```

## Headers

```http
Authorization: Bearer TOKEN
```

## Success Response

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "code": "TI",
      "name": "Teknik Informatika",
      "total_sks": 144,
      "max_convertible_sks": 100,
      "supports_a1": true,
      "supports_a2": true,
      "is_hybrid_allowed": true,
      "status": "active",
      "created_at": "2026-05-22T10:00:00.000000Z",
      "updated_at": "2026-05-22T10:00:00.000000Z"
    }
  ]
}
```

---

# 7. Get Detail Study Program

## Endpoint

```http
GET /api/admin/study-programs/{studyProgram}
```

## Middleware

```txt
auth:sanctum
role:system_admin
```

## Headers

```http
Authorization: Bearer TOKEN
```

## Success Response

```json
{
  "success": true,
  "data": {
    "id": 1,
    "code": "TI",
    "name": "Teknik Informatika",
    "total_sks": 144,
    "max_convertible_sks": 100,
    "supports_a1": true,
    "supports_a2": true,
    "is_hybrid_allowed": true,
    "status": "active",
    "created_at": "2026-05-22T10:00:00.000000Z",
    "updated_at": "2026-05-22T10:00:00.000000Z"
  }
}
```

---

# 8. Create Study Program

## Endpoint

```http
POST /api/admin/study-programs
```

## Middleware

```txt
auth:sanctum
role:system_admin
```

## Headers

```http
Authorization: Bearer TOKEN
```

## Request Body

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

## Success Response

```json
{
  "success": true,
  "message": "Study program created successfully",
  "data": {
    "id": 1,
    "code": "TI",
    "name": "Teknik Informatika",
    "total_sks": 144,
    "max_convertible_sks": 100,
    "supports_a1": true,
    "supports_a2": true,
    "is_hybrid_allowed": true,
    "status": "active",
    "created_at": "2026-05-22T10:00:00.000000Z",
    "updated_at": "2026-05-22T10:00:00.000000Z"
  }
}
```

## Validation Notes

- `code` must be unique
- `max_convertible_sks` cannot exceed `total_sks`

---

# 9. Update Study Program

## Endpoint

```http
PUT /api/admin/study-programs/{studyProgram}
```

## Middleware

```txt
auth:sanctum
role:system_admin
```

## Headers

```http
Authorization: Bearer TOKEN
```

## Request Body

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

## Success Response

```json
{
  "success": true,
  "message": "Study program updated successfully",
  "data": {
    "id": 1,
    "code": "TI",
    "name": "Teknik Informatika Updated",
    "total_sks": 144,
    "max_convertible_sks": 100,
    "supports_a1": true,
    "supports_a2": true,
    "is_hybrid_allowed": false,
    "status": "inactive",
    "created_at": "2026-05-22T10:00:00.000000Z",
    "updated_at": "2026-05-22T11:00:00.000000Z"
  }
}
```

---

# 10. Unauthorized Response

## 401 Unauthenticated

```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

---

# 11. Forbidden Response

## 403 Forbidden

```json
{
  "success": false,
  "message": "Forbidden access"
}
```

---

# 12. Validation Error Response

## 422 Validation Error

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "code": [
      "The code field is required."
    ]
  }
}
```

---

# Admin Study Program Flow

```txt
System Admin
→ Create Study Program
→ Configure RPL Support
→ Configure SKS Conversion Limit
→ Activate / Deactivate Study Program
```

---

# Study Program Business Rules

- Study program code must be unique
- Study program cannot be hard deleted
- Deactivation is done using status field
- Maximum convertible SKS cannot exceed total SKS
- RPL support can be configured per study program
- Hybrid submission availability depends on study program configuration
