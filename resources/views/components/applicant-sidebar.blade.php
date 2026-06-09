{{-- resources/views/components/applicant-sidebar.blade.php --}}

<aside class="applicant-sidebar">
    <div class="applicant-sidebar-glow applicant-sidebar-glow-1"></div>
    <div class="applicant-sidebar-glow applicant-sidebar-glow-2"></div>

    <div class="applicant-sidebar-top">
        <a href="/applications" class="applicant-sidebar-brand" aria-label="G-RPL Applicant Applications">
            <span class="applicant-sidebar-logo">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
                @else
                    <strong>G</strong>
                @endif
            </span>

            <span class="applicant-sidebar-brand-text">
                <strong>G-RPL</strong>
                <small>Applicant Panel</small>
            </span>
        </a>

        <div class="applicant-sidebar-user">
            <div class="applicant-sidebar-user-head">
                <div>
                    <p>Signed In</p>
                    <h2 data-user-name data-sidebar-user-name>Applicant</h2>
                </div>

                <span class="applicant-sidebar-user-dot" aria-hidden="true"></span>
            </div>

            <div class="applicant-sidebar-role-wrap">
                <span class="applicant-sidebar-role" data-user-role data-sidebar-user-role>Applicant</span>
            </div>
        </div>
    </div>

    <nav class="applicant-sidebar-menu" aria-label="Applicant Navigation">
        <a href="/applications" class="applicant-sidebar-link" data-applicant-sidebar-link="applications">
            <span class="applicant-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 4c0-1.1.9-2 2-2h9l5 5v13c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V4Zm10 0v4h4l-4-4ZM8 12v2h8v-2H8Zm0 4v2h8v-2H8Z"/>
                </svg>
            </span>
            <span class="applicant-sidebar-link-text">Applications</span>
        </a>

        <a href="/applications/create" class="applicant-sidebar-link" data-applicant-sidebar-link="create">
            <span class="applicant-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2Zm-1 10h-5v5h-2v-5H6v-2h5V6h2v5h5v2Z"/>
                </svg>
            </span>
            <span class="applicant-sidebar-link-text">Create Application</span>
        </a>

        <a href="/profile" class="applicant-sidebar-link" data-applicant-sidebar-link="profile">
            <span class="applicant-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 12c2.76 0 5-2.24 5-5S14.76 2 12 2 7 4.24 7 7s2.24 5 5 5Zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5Z"/>
                </svg>
            </span>
            <span class="applicant-sidebar-link-text">Profile</span>
        </a>

    </nav>

    <div class="applicant-sidebar-bottom">
        <div class="applicant-sidebar-help">
            <span>Applicant Area</span>
            <strong>Complete your profile and manage RPL applications.</strong>
        </div>

        <button type="button" class="applicant-sidebar-logout" data-logout>
            <span class="applicant-sidebar-logout-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.09 15.59 11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59ZM19 3H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2Z"/>
                </svg>
            </span>
            <span>Logout</span>
        </button>
    </div>
</aside>

<style>
    .applicant-sidebar,
    .applicant-sidebar * {
        box-sizing: border-box;
    }

    .applicant-sidebar {
        position: sticky;
        top: 28px;
        min-height: calc(100vh - 56px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        isolation: isolate;
        overflow: hidden;
        padding: 20px;
        border-radius: 30px;
        color: #ffffff;
        background:
            radial-gradient(circle at 18% 0%, rgba(249, 168, 37, 0.22), transparent 30%),
            radial-gradient(circle at 105% 12%, rgba(21, 101, 192, 0.42), transparent 34%),
            radial-gradient(circle at 30% 92%, rgba(229, 57, 53, 0.14), transparent 28%),
            linear-gradient(180deg, #102347 0%, #0b1428 48%, #070d19 100%);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow:
            0 28px 80px rgba(15, 23, 42, 0.24),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .applicant-sidebar::before {
        content: "";
        position: absolute;
        inset: 0 0 auto;
        z-index: -1;
        height: 5px;
        background: linear-gradient(90deg, #1565C0 0%, #F9A825 48%, #E53935 100%);
    }

    .applicant-sidebar::after {
        content: "";
        position: absolute;
        inset: 1px;
        z-index: -2;
        border-radius: 29px;
        background:
            linear-gradient(145deg, rgba(255, 255, 255, 0.08), transparent 28%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.04), transparent 58%);
        pointer-events: none;
    }

    .applicant-sidebar-glow {
        position: absolute;
        z-index: -1;
        border-radius: 999px;
        filter: blur(4px);
        pointer-events: none;
    }

    .applicant-sidebar-glow-1 {
        width: 120px;
        height: 120px;
        top: 66px;
        right: -70px;
        background: rgba(21, 101, 192, 0.22);
    }

    .applicant-sidebar-glow-2 {
        width: 90px;
        height: 90px;
        bottom: 120px;
        left: -54px;
        background: rgba(249, 168, 37, 0.14);
    }

    .applicant-sidebar-top {
        display: grid;
        gap: 22px;
    }

    .applicant-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        text-decoration: none;
        color: #ffffff;
    }

    .applicant-sidebar-logo {
        width: 50px;
        height: 50px;
        flex: 0 0 50px;
        display: grid;
        place-items: center;
        overflow: hidden;
        border-radius: 18px;
        background:
            radial-gradient(circle at 28% 16%, rgba(249, 168, 37, 0.20), transparent 36%),
            linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(255, 255, 255, 0.20);
        box-shadow:
            0 16px 34px rgba(0, 0, 0, 0.20),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
    }

    .applicant-sidebar-logo img {
        width: 34px;
        height: 34px;
        object-fit: contain;
        display: block;
    }

    .applicant-sidebar-logo strong {
        color: #1565C0;
        font-size: 1.35rem;
        line-height: 1;
        font-weight: 950;
    }

    .applicant-sidebar-brand-text {
        min-width: 0;
        display: block;
    }

    .applicant-sidebar-brand strong {
        display: block;
        color: #ffffff;
        font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: 1.18rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: -0.045em;
        white-space: nowrap;
    }

    .applicant-sidebar-brand small {
        display: block;
        margin-top: 5px;
        color: rgba(255, 255, 255, 0.58);
        font-size: 0.69rem;
        line-height: 1;
        font-weight: 900;
        letter-spacing: 0.17em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .applicant-sidebar-user {
        position: relative;
        overflow: hidden;
        padding: 16px;
        border-radius: 22px;
        background:
            linear-gradient(145deg, rgba(255, 255, 255, 0.105), rgba(255, 255, 255, 0.045)),
            radial-gradient(circle at 100% 0%, rgba(249, 168, 37, 0.14), transparent 38%);
        border: 1px solid rgba(255, 255, 255, 0.115);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .applicant-sidebar-user::before {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        right: -38px;
        bottom: -38px;
        border-radius: 999px;
        background: rgba(21, 101, 192, 0.20);
    }

    .applicant-sidebar-user-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .applicant-sidebar-user p {
        margin: 0 0 8px;
        color: #F9A825;
        font-size: 0.69rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: 0.17em;
        text-transform: uppercase;
    }

    .applicant-sidebar-user h2 {
        max-width: 150px;
        margin: 0;
        overflow: hidden;
        color: #ffffff;
        font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: 1.38rem;
        line-height: 1.13;
        font-weight: 950;
        letter-spacing: -0.055em;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .applicant-sidebar-user-dot {
        width: 12px;
        height: 12px;
        flex: 0 0 12px;
        margin-top: 2px;
        border-radius: 999px;
        background: #22c55e;
        border: 2px solid rgba(255, 255, 255, 0.72);
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.14);
    }

    .applicant-sidebar-role-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 13px;
        position: relative;
        z-index: 1;
    }

    .applicant-sidebar-role {
        display: inline-flex;
        width: fit-content;
        min-height: 31px;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        border-radius: 999px;
        color: #ffffff;
        background: rgba(21, 101, 192, 0.36);
        border: 1px solid rgba(147, 197, 253, 0.20);
        font-size: 0.76rem;
        line-height: 1;
        font-weight: 950;
    }

    .applicant-sidebar-menu {
        display: grid;
        gap: 9px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.105);
    }

    .applicant-sidebar-link {
        position: relative;
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 0 13px;
        overflow: hidden;
        border-radius: 16px;
        color: rgba(255, 255, 255, 0.72);
        background: transparent;
        border: 1px solid transparent;
        font-size: 0.92rem;
        line-height: 1;
        font-weight: 850;
        text-decoration: none;
        outline: none;
        transition:
            transform 0.22s ease,
            color 0.22s ease,
            background 0.22s ease,
            border-color 0.22s ease,
            box-shadow 0.22s ease;
    }

    .applicant-sidebar-link::before {
        content: "";
        position: absolute;
        inset: 8px auto 8px 0;
        width: 3px;
        border-radius: 999px;
        background: #F9A825;
        opacity: 0;
        transform: translateX(-8px);
        transition: 0.22s ease;
    }

    .applicant-sidebar-link-icon {
        width: 31px;
        height: 31px;
        flex: 0 0 31px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: 0.22s ease;
    }

    .applicant-sidebar-link-icon svg {
        width: 17px;
        height: 17px;
        fill: currentColor;
        display: block;
    }

    .applicant-sidebar-link-text {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .applicant-sidebar-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.078);
        border-color: rgba(255, 255, 255, 0.105);
        transform: translateX(3px);
    }

    .applicant-sidebar-link:hover .applicant-sidebar-link-icon {
        background: rgba(255, 255, 255, 0.105);
        border-color: rgba(255, 255, 255, 0.14);
    }

    .applicant-sidebar-link.active {
        color: #ffffff;
        background:
            linear-gradient(135deg, rgba(21, 101, 192, 0.48), rgba(249, 168, 37, 0.14)),
            rgba(255, 255, 255, 0.06);
        border-color: rgba(249, 168, 37, 0.24);
        box-shadow:
            0 14px 26px rgba(0, 0, 0, 0.13),
            inset 0 1px 0 rgba(255, 255, 255, 0.10);
    }

    .applicant-sidebar-link.active::before {
        opacity: 1;
        transform: translateX(0);
    }

    .applicant-sidebar-link.active .applicant-sidebar-link-icon {
        color: #0b1428;
        background: linear-gradient(135deg, #F9A825, #ffe08a);
        border-color: rgba(255, 255, 255, 0.22);
        box-shadow: 0 10px 22px rgba(249, 168, 37, 0.18);
    }

    .applicant-sidebar-link:focus-visible,
    .applicant-sidebar-logout:focus-visible {
        box-shadow: 0 0 0 4px rgba(249, 168, 37, 0.18);
        border-color: rgba(249, 168, 37, 0.45);
    }

    .applicant-sidebar-bottom {
        display: grid;
        gap: 13px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, 0.105);
    }

    .applicant-sidebar-help {
        padding: 13px 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.055);
        border: 1px solid rgba(255, 255, 255, 0.085);
    }

    .applicant-sidebar-help span {
        display: block;
        margin-bottom: 5px;
        color: #F9A825;
        font-size: 0.66rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .applicant-sidebar-help strong {
        display: block;
        color: rgba(255, 255, 255, 0.74);
        font-size: 0.8rem;
        line-height: 1.35;
        font-weight: 750;
    }

    .applicant-sidebar-logout {
        width: 100%;
        min-height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        border-radius: 16px;
        color: #fecaca;
        background:
            linear-gradient(135deg, rgba(229, 57, 53, 0.15), rgba(229, 57, 53, 0.07));
        border: 1px solid rgba(229, 57, 53, 0.20);
        font-family: inherit;
        font-size: 0.9rem;
        line-height: 1;
        font-weight: 950;
        cursor: pointer;
        transition:
            transform 0.22s ease,
            color 0.22s ease,
            background 0.22s ease,
            border-color 0.22s ease,
            box-shadow 0.22s ease;
    }

    .applicant-sidebar-logout-icon {
        width: 19px;
        height: 19px;
        display: grid;
        place-items: center;
    }

    .applicant-sidebar-logout-icon svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
        display: block;
    }

    .applicant-sidebar-logout:hover {
        color: #ffffff;
        background:
            linear-gradient(135deg, rgba(229, 57, 53, 0.28), rgba(229, 57, 53, 0.13));
        border-color: rgba(229, 57, 53, 0.34);
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(229, 57, 53, 0.12);
    }

    .applicant-sidebar-logout:active {
        transform: translateY(0);
    }

    @media (max-width: 1100px) {
        .applicant-sidebar {
            padding: 18px;
            border-radius: 26px;
        }

        .applicant-sidebar-brand strong {
            font-size: 1.05rem;
        }

        .applicant-sidebar-user h2 {
            font-size: 1.24rem;
        }

        .applicant-sidebar-link {
            min-height: 46px;
            padding-inline: 12px;
        }
    }

    @media (max-width: 900px) {
        .applicant-sidebar {
            position: relative;
            top: 0;
            min-height: auto;
        }

        .applicant-sidebar-menu {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .applicant-sidebar-link:hover {
            transform: translateY(-1px);
        }

        .applicant-sidebar-bottom {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .applicant-sidebar {
            padding: 16px;
            border-radius: 24px;
        }

        .applicant-sidebar-top {
            gap: 18px;
        }

        .applicant-sidebar-brand {
            gap: 10px;
        }

        .applicant-sidebar-logo {
            width: 46px;
            height: 46px;
            flex-basis: 46px;
            border-radius: 16px;
        }

        .applicant-sidebar-logo img {
            width: 31px;
            height: 31px;
        }

        .applicant-sidebar-user {
            padding: 14px;
            border-radius: 19px;
        }

        .applicant-sidebar-menu {
            grid-template-columns: 1fr;
            margin-top: 18px;
            padding-top: 16px;
        }

        .applicant-sidebar-link {
            min-height: 45px;
            border-radius: 15px;
        }

        .applicant-sidebar-help {
            display: none;
        }
    }

    @media (max-width: 380px) {
        .applicant-sidebar-brand small {
            letter-spacing: 0.12em;
        }

        .applicant-sidebar-user h2 {
            max-width: 120px;
        }

        .applicant-sidebar-link {
            font-size: 0.86rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
        const links = document.querySelectorAll('[data-applicant-sidebar-link]');

        links.forEach(function (link) {
            const type = link.getAttribute('data-applicant-sidebar-link');
            let isActive = false;

            if (type === 'applications') {
                isActive =
                    currentPath === '/applications'
                    || /^\/applications\/(?!create$)[^/]+$/.test(currentPath)
                    || /^\/applications\/(?!create$)[^/]+\/edit$/.test(currentPath);
            }

            if (type === 'create') {
                isActive = currentPath === '/applications/create';
            }

            if (type === 'profile') {
                isActive = currentPath === '/profile';
            }

            if (type === 'profile-edit') {
                isActive = currentPath === '/profile/edit';
            }

            link.classList.toggle('active', isActive);
        });

        const storedUserName =
            localStorage.getItem('user_name')
            || sessionStorage.getItem('user_name')
            || localStorage.getItem('name')
            || sessionStorage.getItem('name')
            || 'Applicant';

        const storedUserRole =
            localStorage.getItem('user_role')
            || sessionStorage.getItem('user_role')
            || 'Applicant';

        document.querySelectorAll('[data-sidebar-user-name], [data-user-name]').forEach(function (element) {
            if (element) {
                element.textContent = storedUserName;
            }
        });

        document.querySelectorAll('[data-sidebar-user-role], [data-user-role]').forEach(function (element) {
            if (element) {
                element.textContent = storedUserRole.charAt(0).toUpperCase() + storedUserRole.slice(1);
            }
        });
    });
</script>