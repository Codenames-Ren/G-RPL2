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
  "name": "Ren",
  "email": "ren@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Notes

- Applicant role assigned automatically
- Email verification required before login

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

### Success Response

```json
{
  "success": true,
  "token": "sanctum_token"
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

### Middleware

```txt
auth:sanctum
```

---

## Logout

```http
POST /api/auth/logout
```

### Middleware

```txt
auth:sanctum
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

### Query Params (Optional)

```txt
search
role
is_active
per_page
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

### Allowed Roles

```txt
assessor
staff_rpl
committee
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

### Notes

- Internal account auto verified
- Master data created automatically
- System admin cannot be created

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

### Notes

- Password optional (only for update)
- Empty password keeps old password

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

### Notes

- Status synchronized automatically
- System admin cannot be modified
- Admin cannot deactivate own account

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