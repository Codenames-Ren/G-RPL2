{{-- resources/views/components/admin-sidebar.blade.php --}}

<aside class="admin-sidebar">
    <div class="admin-sidebar-glow admin-sidebar-glow-1"></div>
    <div class="admin-sidebar-glow admin-sidebar-glow-2"></div>

    <div class="admin-sidebar-top">
        <a href="/dashboard" class="admin-sidebar-brand" aria-label="G-RPL Admin Dashboard">
            <span class="admin-sidebar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
            </span>

            <span class="admin-sidebar-brand-text">
                <strong>G-RPL</strong>
                <small>Admin Control</small>
            </span>
        </a>

        <div class="admin-sidebar-user">
            <div class="admin-sidebar-user-head">
                <div>
                    <p>Signed In</p>
                    <h2 data-user-name>Admin</h2>
                </div>

                <span class="admin-sidebar-user-dot" aria-hidden="true"></span>
            </div>

            <div class="admin-sidebar-role-wrap">
                <span class="admin-sidebar-role" data-user-role>System Admin</span>
            </div>
        </div>
    </div>

    <nav class="admin-sidebar-menu" aria-label="Admin Navigation">
        <a href="/dashboard" class="admin-sidebar-link" data-admin-sidebar-link>
            <span class="admin-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 13h7V4H4v9Zm0 7h7v-5H4v5Zm9 0h7v-9h-7v9Zm0-16v5h7V4h-7Z"/>
                </svg>
            </span>
            <span class="admin-sidebar-link-text">Dashboard</span>
        </a>

        <a href="/admin/users" class="admin-sidebar-link" data-admin-sidebar-link>
            <span class="admin-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3ZM8 11c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3Zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13Zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5Z"/>
                </svg>
            </span>
            <span class="admin-sidebar-link-text">Users</span>
        </a>

        <a href="/admin/master-data" class="admin-sidebar-link" data-admin-sidebar-link>
            <span class="admin-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 5c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v14c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V5Zm4 2v2h8V7H8Zm0 4v2h8v-2H8Zm0 4v2h5v-2H8Z"/>
                </svg>
            </span>
            <span class="admin-sidebar-link-text">Master Data</span>
        </a>

        <a href="/admin/study-programs" class="admin-sidebar-link" data-admin-sidebar-link>
            <span class="admin-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14L5 13.18V16c0 2 4.66 4 7 4s7-2 7-4v-2.82L12 17Z"/>
                </svg>
            </span>
            <span class="admin-sidebar-link-text">Study Programs</span>
        </a>

        <a href="/admin/courses" class="admin-sidebar-link" data-admin-sidebar-link>
            <span class="admin-sidebar-link-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M18 2H7c-1.66 0-3 1.34-3 3v14c0 1.66 1.34 3 3 3h11c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2Zm0 16H7c-.55 0-1 .45-1 1s.45 1 1 1h11v-2Zm0-2H7c-.35 0-.69.06-1 .17V5c0-.55.45-1 1-1h11v12Z"/>
                </svg>
            </span>
            <span class="admin-sidebar-link-text">Courses</span>
        </a>
    </nav>

    <div class="admin-sidebar-bottom">
        <div class="admin-sidebar-help">
            <span>Admin Area</span>
            <strong>Manage G-RPL data safely.</strong>
        </div>

        <button type="button" class="admin-sidebar-logout" data-logout>
            <span class="admin-sidebar-logout-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.09 15.59 11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59ZM19 3H5c-1.1 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2Z"/>
                </svg>
            </span>
            <span>Logout</span>
        </button>
    </div>
</aside>

<style>
    .admin-sidebar,
    .admin-sidebar * {
        box-sizing: border-box;
    }

    .admin-sidebar {
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

    .admin-sidebar::before {
        content: "";
        position: absolute;
        inset: 0 0 auto;
        z-index: -1;
        height: 5px;
        background: linear-gradient(90deg, #1565C0 0%, #F9A825 48%, #E53935 100%);
    }

    .admin-sidebar::after {
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

    .admin-sidebar-glow {
        position: absolute;
        z-index: -1;
        border-radius: 999px;
        filter: blur(4px);
        pointer-events: none;
    }

    .admin-sidebar-glow-1 {
        width: 120px;
        height: 120px;
        top: 66px;
        right: -70px;
        background: rgba(21, 101, 192, 0.22);
    }

    .admin-sidebar-glow-2 {
        width: 90px;
        height: 90px;
        bottom: 120px;
        left: -54px;
        background: rgba(249, 168, 37, 0.14);
    }

    .admin-sidebar-top {
        display: grid;
        gap: 22px;
    }

    .admin-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        text-decoration: none;
        color: #ffffff;
    }

    .admin-sidebar-logo {
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

    .admin-sidebar-logo img {
        width: 34px;
        height: 34px;
        object-fit: contain;
        display: block;
    }

    .admin-sidebar-brand-text {
        min-width: 0;
        display: block;
    }

    .admin-sidebar-brand strong {
        display: block;
        color: #ffffff;
        font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: 1.18rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: -0.045em;
        white-space: nowrap;
    }

    .admin-sidebar-brand small {
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

    .admin-sidebar-user {
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

    .admin-sidebar-user::before {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        right: -38px;
        bottom: -38px;
        border-radius: 999px;
        background: rgba(21, 101, 192, 0.20);
    }

    .admin-sidebar-user-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .admin-sidebar-user p {
        margin: 0 0 8px;
        color: #F9A825;
        font-size: 0.69rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: 0.17em;
        text-transform: uppercase;
    }

    .admin-sidebar-user h2 {
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

    .admin-sidebar-user-dot {
        width: 12px;
        height: 12px;
        flex: 0 0 12px;
        margin-top: 2px;
        border-radius: 999px;
        background: #22c55e;
        border: 2px solid rgba(255, 255, 255, 0.72);
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.14);
    }

    .admin-sidebar-role-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 13px;
    }

    .admin-sidebar-role {
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

    .admin-sidebar-menu {
        display: grid;
        gap: 9px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.105);
    }

    .admin-sidebar-link {
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

    .admin-sidebar-link::before {
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

    .admin-sidebar-link-icon {
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

    .admin-sidebar-link-icon svg {
        width: 17px;
        height: 17px;
        fill: currentColor;
        display: block;
    }

    .admin-sidebar-link-text {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .admin-sidebar-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.078);
        border-color: rgba(255, 255, 255, 0.105);
        transform: translateX(3px);
    }

    .admin-sidebar-link:hover .admin-sidebar-link-icon {
        background: rgba(255, 255, 255, 0.105);
        border-color: rgba(255, 255, 255, 0.14);
    }

    .admin-sidebar-link.active {
        color: #ffffff;
        background:
            linear-gradient(135deg, rgba(21, 101, 192, 0.48), rgba(249, 168, 37, 0.14)),
            rgba(255, 255, 255, 0.06);
        border-color: rgba(249, 168, 37, 0.24);
        box-shadow:
            0 14px 26px rgba(0, 0, 0, 0.13),
            inset 0 1px 0 rgba(255, 255, 255, 0.10);
    }

    .admin-sidebar-link.active::before {
        opacity: 1;
        transform: translateX(0);
    }

    .admin-sidebar-link.active .admin-sidebar-link-icon {
        color: #0b1428;
        background: linear-gradient(135deg, #F9A825, #ffe08a);
        border-color: rgba(255, 255, 255, 0.22);
        box-shadow: 0 10px 22px rgba(249, 168, 37, 0.18);
    }

    .admin-sidebar-link:focus-visible,
    .admin-sidebar-logout:focus-visible {
        box-shadow: 0 0 0 4px rgba(249, 168, 37, 0.18);
        border-color: rgba(249, 168, 37, 0.45);
    }

    .admin-sidebar-bottom {
        display: grid;
        gap: 13px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, 0.105);
    }

    .admin-sidebar-help {
        padding: 13px 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.055);
        border: 1px solid rgba(255, 255, 255, 0.085);
    }

    .admin-sidebar-help span {
        display: block;
        margin-bottom: 5px;
        color: #F9A825;
        font-size: 0.66rem;
        line-height: 1;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .admin-sidebar-help strong {
        display: block;
        color: rgba(255, 255, 255, 0.74);
        font-size: 0.8rem;
        line-height: 1.35;
        font-weight: 750;
    }

    .admin-sidebar-logout {
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

    .admin-sidebar-logout-icon {
        width: 19px;
        height: 19px;
        display: grid;
        place-items: center;
    }

    .admin-sidebar-logout-icon svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
        display: block;
    }

    .admin-sidebar-logout:hover {
        color: #ffffff;
        background:
            linear-gradient(135deg, rgba(229, 57, 53, 0.28), rgba(229, 57, 53, 0.13));
        border-color: rgba(229, 57, 53, 0.34);
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(229, 57, 53, 0.12);
    }

    .admin-sidebar-logout:active {
        transform: translateY(0);
    }

    @media (max-width: 1100px) {
        .admin-sidebar {
            padding: 18px;
            border-radius: 26px;
        }

        .admin-sidebar-brand strong {
            font-size: 1.05rem;
        }

        .admin-sidebar-user h2 {
            font-size: 1.24rem;
        }

        .admin-sidebar-link {
            min-height: 46px;
            padding-inline: 12px;
        }
    }

    @media (max-width: 900px) {
        .admin-sidebar {
            position: relative;
            top: 0;
            min-height: auto;
        }

        .admin-sidebar-menu {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .admin-sidebar-link:hover {
            transform: translateY(-1px);
        }

        .admin-sidebar-bottom {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .admin-sidebar {
            padding: 16px;
            border-radius: 24px;
        }

        .admin-sidebar-top {
            gap: 18px;
        }

        .admin-sidebar-brand {
            gap: 10px;
        }

        .admin-sidebar-logo {
            width: 46px;
            height: 46px;
            flex-basis: 46px;
            border-radius: 16px;
        }

        .admin-sidebar-logo img {
            width: 31px;
            height: 31px;
        }

        .admin-sidebar-user {
            padding: 14px;
            border-radius: 19px;
        }

        .admin-sidebar-menu {
            grid-template-columns: 1fr;
            margin-top: 18px;
            padding-top: 16px;
        }

        .admin-sidebar-link {
            min-height: 45px;
            border-radius: 15px;
        }

        .admin-sidebar-help {
            display: none;
        }
    }

    @media (max-width: 380px) {
        .admin-sidebar-brand small {
            letter-spacing: 0.12em;
        }

        .admin-sidebar-user h2 {
            max-width: 120px;
        }

        .admin-sidebar-link {
            font-size: 0.86rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
        const links = document.querySelectorAll('[data-admin-sidebar-link]');

        links.forEach(function (link) {
            const rawHref = link.getAttribute('href');

            if (!rawHref) return;

            const href = rawHref.replace(/\/$/, '') || '/';

            if (href === '/dashboard') {
                link.classList.toggle('active', currentPath === href);
                return;
            }

            link.classList.toggle(
                'active',
                currentPath === href || currentPath.startsWith(href + '/')
            );
        });
    });
</script>