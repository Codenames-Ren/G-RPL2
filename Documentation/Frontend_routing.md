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
| /login | Login page |
| /register | Register page |

---

# Protected Pages

All protected pages require authenticated session/token.

---

# Dashboard

| Route | Description |
|---|---|
| /dashboard | Single dashboard endpoint |

## Notes

- Frontend handles role-based UI rendering
- Backend remains responsible for authorization
- Sidebar/menu/content rendered conditionally based on user role

---

# Applicant Pages

| Route | Description |
|---|---|
| /applications | Application list |
| /applications/create | Create application |

## Access Role

```txt
applicant
```

---

# Assessor Pages

| Route | Description |
|---|---|
| /assessments | Assessment page |

## Access Role

```txt
assessor
```

---

# Committee Pages

| Route | Description |
|---|---|
| /approvals | Approval page |

## Access Role

```txt
committee
```

---

# Staff Pages

| Route | Description |
|---|---|
| /submissions | Submission review |

## Access Role

```txt
staff
```

---

# Admin Pages

| Route | Description |
|---|---|
| /admin/users | User management |
| /admin/master-data | Master data management |
| /admin/study-programs | Study program list |
| /admin/study-programs/create | Create study program |
| /admin/study-programs/{id}/edit | Edit study program |

## Access Role

```txt
system_admin
```

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
- Handle conditional UI rendering
- Handle redirect after login
- Handle 401 and 403 responses

---

# Frontend Authorization Flow

```txt
Login
→ Save Sanctum Token
→ Fetch /api/auth/me
→ Detect User Role
→ Redirect To Role Dashboard
→ Render Sidebar/Menu Based On Role
```

---

# Recommended Frontend Role Redirect

| Role | Redirect |
|---|---|
| applicant | /dashboard |
| assessor | /dashboard |
| committee | /dashboard |
| staff | /dashboard |
| system_admin | /dashboard |

---

# Frontend Route Protection

Frontend should prevent unauthorized page access by:

- Checking authenticated user role
- Redirecting unauthorized users
- Handling expired tokens
- Handling forbidden access

---

# Current Admin Module Coverage

## Completed

- Authentication
- Email Verification
- Sanctum Token Authentication
- Role Restriction
- Study Program Management
- Frontend Static Routing

---

# Current Study Program Features

- Create study program
- Update study program
- Get all study programs
- Get detail study program
- Activate / deactivate study program
- Configure RPL support
- Configure hybrid support
- Configure maximum SKS conversion

---

# Notes For Frontend Team

- Do not implement business logic on frontend
- Do not validate role permissions manually
- Always rely on backend authorization
- Use backend API as source of truth
- Frontend only responsible for rendering and user interaction

```