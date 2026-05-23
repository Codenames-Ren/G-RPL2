# G-RPL2 Frontend Static Routing

## Base URL

```txt
http://your_ip_network:8000
```

---

# Public Pages

| Route | Description |
|---|---|
| / | Home page |
| /tentang-rpl | About RPL page |
| /persyaratan | Requirements page |
| /faq | FAQ page |
| /pengumuman | Announcement page |
| /login | Login page |
| /register | Applicant registration page |

---

# Protected Pages

All protected pages require authenticated session/token.

---

# Dashboard

| Route | Description |
|---|---|
| /dashboard | Main dashboard |

## Notes

- Frontend handles role-based rendering
- Backend remains source of authorization
- Sidebar/menu rendered based on authenticated role

---

# Applicant Pages

## Access Role

```txt
applicant
```

| Route | Description |
|---|---|
| /applications | Application list |
| /applications/create | Create application |

---

# Assessor Pages

## Access Role

```txt
assessor
```

| Route | Description |
|---|---|
| /assessments | Assessment page |

---

# Committee Pages

## Access Role

```txt
committee
```

| Route | Description |
|---|---|
| /approvals | Approval page |

---

# Staff Pages

## Access Role

```txt
staff
```

| Route | Description |
|---|---|
| /submissions | Submission review page |

---

# Admin Pages

## Access Role

```txt
system_admin
```

---

## Master Data

| Route | Description |
|---|---|
| /admin/master-data | Master data management |

---

## User Management

| Route | Description |
|---|---|
| /admin/users | User list |
| /admin/users/create | Create user |
| /admin/users/{id}/edit | Edit user |

---

## Study Programs

| Route | Description |
|---|---|
| /admin/study-programs | Study program list |
| /admin/study-programs/create | Create study program |
| /admin/study-programs/{id}/edit | Edit study program |

---

## Course Management

| Route | Description |
|---|---|
| /admin/courses | Course list |
| /admin/courses/create | Create course |
| /admin/courses/{id}/edit | Edit course |

---

# Current Roles

| Role |
|---|
| applicant |
| staff |
| assessor |
| committee |
| system_admin |

---

# Frontend Responsibilities

- Consume backend API
- Render UI
- Store Sanctum token
- Send Authorization header
- Handle redirect after login
- Handle 401 and 403 responses
- Render menu/sidebar based on role

---

# Frontend Authorization Flow

```txt
Login
→ Save Sanctum Token
→ Fetch /api/auth/me
→ Detect User Role
→ Redirect To Dashboard
→ Render Sidebar/Menu Based On Role
```

---

# Recommended Redirect

| Role | Redirect |
|---|---|
| applicant | /dashboard |
| assessor | /dashboard |
| committee | /dashboard |
| staff | /dashboard |
| system_admin | /dashboard |

---

# Frontend Route Protection

Frontend should:

- Check authenticated role
- Redirect unauthorized access
- Handle expired token
- Handle forbidden access

---

# Current Module Coverage

## Completed

- Authentication
- Email Verification
- Sanctum Authentication
- Role Restriction
- Study Program Management
- User Management
- Course Management
- Frontend Static Routing

---

# Notes For Frontend Team

- Do not create custom workflow outside backend API
- Do not implement business logic on frontend
- Always follow backend authorization
- Backend API is source of truth
- Frontend only handles rendering and interaction