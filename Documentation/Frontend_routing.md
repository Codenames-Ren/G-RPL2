# G-RPL2 Frontend Static Routing

## Base URL

```txt
http://your_ip_network:8000
```

---

# Public Pages

| Route     | Description   |
| --------- | ------------- |
| /         | Home page     |
| /login    | Login page    |
| /register | Register page |

---

# Dashboard

| Route      | Description               |
| ---------- | ------------------------- |
| /dashboard | Single dashboard endpoint |

## Notes

* Frontend handles role-based UI rendering
* Backend remains responsible for authorization
* Sidebar/menu/content rendered conditionally based on user role

---

# Applicant Pages

| Route                | Description        |
| -------------------- | ------------------ |
| /applications        | Application list   |
| /applications/create | Create application |

---

# Assessor Pages

| Route        | Description     |
| ------------ | --------------- |
| /assessments | Assessment page |

---

# Committee Pages

| Route      | Description   |
| ---------- | ------------- |
| /approvals | Approval page |

---

# Staff Pages

| Route        | Description       |
| ------------ | ----------------- |
| /submissions | Submission review |

---

# Admin Pages

| Route        | Description            |
| ------------ | ---------------------- |
| /users       | User management        |
| /master-data | Master data management |

---

# Current Roles

| Role      |
| --------- |
| applicant |
| staff     |
| assessor  |
| committee |
| admin     |

---

# Frontend Responsibilities

* Consume backend API
* Render UI
* Store Sanctum token
* Send Authorization header
* Handle conditional UI rendering