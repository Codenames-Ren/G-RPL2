---
schemaVersion: 1
scope: workspace
updatedAt: "2026-06-01T11:01:41.509Z"
workspaceName: "G-RPL2"
---

# Project Memory

## Project Overview
- Workspace untuk aplikasi G-RPL2, dengan fokus saat ini menyamakan desain halaman/pages applicant agar konsisten dengan theme dashboard.

## Current State
- Aplikasi menggunakan Laravel/Vite dengan sumber utama `resources/js/app.js`, `resources/css/app.css`, dan mock/prototype `App.jsx`.
- CSS applicant sudah diperbarui agar mengikuti dashboard theme: sidebar gelap, background hangat, kartu putih, aksen oranye.
- `DESIGN.md` sudah dibuat sebagai baton sistem desain minimal untuk tema dashboard/applicant.
- `App.jsx` sudah diperbaiki agar memiliki mount React.
- Preview/runtime verification belum bisa dijalankan karena Chrome/Chromium tidak tersedia di host.

## Artifacts
- `resources/css/app.css` — stylesheet utama aplikasi; sudah diubah untuk menyelaraskan UI applicant dengan theme dashboard.
- `resources/js/app.js` — logic aplikasi utama, termasuk flow applicant; dibaca untuk memahami kelas/struktur runtime.
- `App.jsx` — mock/prototype dashboard theme dengan tweakable defaults; sudah diperbaiki mount-nya.
- `DESIGN.md` — artifact sistem desain authoritative untuk theme “Applicant Dashboard Theme”.

## Design Direction
- Gunakan gaya dashboard modern: sidebar gelap, area konten dengan latar hangat/off-white, kartu putih/raised, border halus, dan aksen oranye.
- Applicant pages harus terasa sebagai bagian dari dashboard yang sama, bukan halaman terpisah dengan visual lama.
- Pertahankan struktur aplikasi yang ada; lakukan penyelarasan visual melalui token CSS dan kelas runtime.

## User Feedback
- User meminta: “ubah design pada pages di folder applicant agar sama dengan theme yang ada pada dashborad”.
- Preferensi tersirat: perubahan desain harus mengikuti theme dashboard yang sudah ada, bukan rebuild total.

## Decisions
- Theme project diberi nama “Applicant Dashboard Theme”.
- Aksen utama memakai oranye dashboard.
- Sidebar/shell applicant diarahkan ke gaya dashboard dengan background gelap dan surface konten yang lebih terang.
- `DESIGN.md` dibuat karena keputusan visual lintas screen mulai stabil.

## Open Questions
- Perlu verifikasi visual langsung di browser setelah Chrome/Chromium tersedia.
- Belum diketahui apakah semua halaman applicant di folder/backend view sudah memakai kelas CSS yang sama.
- Perlu cek apakah ada halaman dashboard lain yang memiliki token tambahan yang belum tercakup di `DESIGN.md`.

## Next Steps
- Jalankan preview/runtime test ketika Chrome/Chromium tersedia.
- Review halaman applicant aktual satu per satu untuk memastikan semua state, form, table, tab, dan empty state konsisten.
- Jika ada source view applicant terpisah yang belum terinspeksi, audit dan samakan markup/class bila diperlukan.
- Promosikan keputusan visual tambahan ke `DESIGN.md` hanya jika sudah stabil.

## Promotion Candidates For DESIGN.md
- Dashboard/applicant shell dengan sidebar gelap dan content background hangat.
- Card putih dengan radius modern dan border/shadow halus.
- Primary action oranye untuk CTA utama.
- Form controls dan tab applicant mengikuti border halus serta active state oranye.

## Recent History
- 2026-06-01: Workspace diinspeksi; sumber utama `resources/js/app.js`, `resources/css/app.css`, dan `App.jsx` dibaca.
- 2026-06-01: CSS applicant diubah agar selaras dengan theme dashboard.
- 2026-06-01: `DESIGN.md` dibuat dan disesuaikan untuk “Applicant Dashboard Theme”.
- 2026-06-01: `App.jsx` diperbaiki untuk mount React; runtime verification terhalang Chrome host tidak tersedia.