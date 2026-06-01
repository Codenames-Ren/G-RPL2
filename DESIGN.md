---
version: alpha
name: Applicant Dashboard Theme
description: Shared dashboard styling for admin and applicant pages
colors:
  background: "#F4F0E8"
  surface: "#FFFFFF"
  surfaceMuted: "#F7F3EC"
  surfaceRaised: "#FFFAF2"
  text: "#151821"
  muted: "#6B7280"
  border: "#DED6C8"
  accent: "#E0522D"
  accentDark: "#C84424"
  sidebar: "#111827"
  success: "#16794F"
  danger: "#C24132"
typography:
  display:
    fontFamily: Instrument Sans
    fontSize: 34px
    fontWeight: 800
    lineHeight: 1.08
    letterSpacing: -0.04em
  body:
    fontFamily: Instrument Sans
    fontSize: 16px
    fontWeight: 400
    lineHeight: 1.55
rounded:
  sm: 8px
  md: 12px
  lg: 12px
spacing:
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
components:
  button-primary:
    backgroundColor: "{colors.accent}"
    textColor: "#FFFFFF"
    typography: "{typography.body}"
    rounded: "{rounded.md}"
    padding: 0 18px
  card:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text}"
    rounded: "{rounded.md}"
    padding: 24px
---

## Overview

Applicant pages should visually match the dashboard: warm page background, dark left navigation surfaces, white content cards, orange primary actions, and compact rounded controls. Use these tokens for applicant forms, application tables, tabs, modals, and sidebar status summaries.

## Colors

Use `background` on pages, `sidebar` for navigation panels, `surface` for main cards, and `surfaceRaised` for nested modules. `accent` is reserved for primary buttons, active tabs, focus rings, and submitted/high-attention states.

## Typography

Use Instrument Sans throughout to stay consistent with the existing Laravel/Tailwind setup. Headings should be compact with negative letter spacing; tables and forms stay practical at 14–16px with strong labels.

## Layout

Dashboard and applicant areas use a 280px sidebar plus fluid content on desktop. Collapse to one column under 900px, and keep table wrappers horizontally scrollable instead of clipping actions.

## Elevation & Depth

Use fine borders and soft shadows for cards. The dark sidebar gets stronger depth; main cards should remain lighter and attached to the warm background.

## Shapes

Use 12px radius for controls, cards, tables, and modals. Pills use full radius. Nested surfaces should not exceed the parent radius.

## Components

Primary buttons are orange and high contrast. Secondary buttons in the sidebar use translucent white fills. Cards hold one clear job: applicant status, application record detail, form group, table, or empty state.

## Do's and Don'ts

Do promote repeated visual choices back into this file. Don't paste transient task notes, long source files, or unverified brand values here.
