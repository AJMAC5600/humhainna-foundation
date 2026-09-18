<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Hum Hain Na Foundation')</title>

    <meta name="description"
        content="@yield('meta_description', 'Hum Hain Na Foundation — an NGO working across education, health, environment and relief. Volunteer, donate, create change.')">

    @include('partials.design')

    <style>
        /* =========================================================
           HHN HEADER / FOOTER – ROYAL BLUE SOLID NAVBAR
        ========================================================= */

        /* ----- GLOBAL RESET & BASE ----- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fc;
            color: #1e293b;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* =========================================================
           HEADER — SOLID ROYAL BLUE
        ========================================================= */
        .hhn-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            background: #1e3a8a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(15, 35, 80, 0.18);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .hhn-header-height {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .hhn-logo {
            width: 150px;
            height: auto;
            object-fit: contain;
            display: block;
            transition: width 0.2s ease;
            filter: brightness(1.05);
        }

        .hhn-brand-accent {
            position: relative;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            text-decoration: none;
        }

        .hhn-brand-accent::before {
            content: "";
            position: absolute;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            top: -45px;
            left: -35px;
            z-index: -1;
            pointer-events: none;
        }

        .hhn-desktop-nav {
            display: flex;
            align-items: center;
            gap: 28px;
            height: 100%;
        }

        .hhn-nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 80px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.25s ease;
            letter-spacing: -0.01em;
        }

        .hhn-nav-link:hover {
            color: #ffffff;
        }

        .hhn-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            border-radius: 999px 999px 0 0;
            background: #f59e0b;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hhn-nav-link:hover::after,
        .hhn-nav-link.active::after {
            transform: scaleX(1);
        }

        .hhn-nav-link.active {
            color: #ffffff;
            font-weight: 650;
        }

        .hhn-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hhn-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .hhn-icon-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .hhn-icon-btn .material-symbols-outlined {
            font-size: 22px;
        }

        .hhn-divider {
            width: 1px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 4px;
        }

        .hhn-login-link {
            font-size: 15px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            transition: color 0.2s ease;
            white-space: nowrap;
        }

        .hhn-login-link:hover {
            color: #ffffff;
        }

        .hhn-account-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .hhn-account-link:hover {
            color: #ffffff;
        }

        .hhn-account-link .material-symbols-outlined {
            font-size: 21px;
        }

        .hhn-donate {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 22px;
            border-radius: 11px;
            background: #f59e0b;
            color: #1e3a8a;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
            transition: all 0.25s ease;
            white-space: nowrap;
            border: none;
            cursor: pointer;
        }

        .hhn-donate:hover {
            background: #fbbf24;
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(245, 158, 11, 0.4);
        }

        .hhn-donate:active {
            transform: translateY(0);
        }

        .hhn-donate .material-symbols-outlined {
            font-size: 18px;
        }

        .hhn-menu-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .hhn-menu-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .hhn-menu-btn .material-symbols-outlined {
            font-size: 25px;
        }

        .hhn-mobile-menu {
            display: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: #1e3a8a;
            box-shadow: 0 16px 35px rgba(8, 25, 60, 0.25);
            padding: 16px 24px;
        }

        .hhn-mobile-menu.open {
            display: block;
        }

        .hhn-mobile-inner {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .hhn-mobile-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 50px;
            padding: 0 14px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .hhn-mobile-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .hhn-mobile-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-weight: 650;
        }

        .hhn-mobile-link .material-symbols-outlined {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.5);
        }

        .hhn-mobile-divider {
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .hhn-mobile-logout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 50px;
            padding: 0 14px;
            border-radius: 10px;
            background: transparent;
            border: none;
            color: #fca5a5;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
            text-align: left;
            font-family: inherit;
        }

        .hhn-mobile-logout:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .hhn-main {
            flex: 1;
            padding-top: 96px;
            width: 100%;
        }

        /* =========================================================
           FOOTER — COMPLETELY REDESIGNED
        ========================================================= */
        .hhn-footer {
            position: relative;
            background: #1e3a8a;
            color: #ffffff;
            width: 100%;
            margin-top: auto;
            overflow: hidden;
        }

        /* Decorative top gradient line */
        .hhn-footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);
            z-index: 2;
        }

        /* Subtle radial glow */
        .hhn-footer::after {
            content: "";
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent 70%);
            pointer-events: none;
        }

        .hhn-footer-inner {
            position: relative;
            z-index: 3;
            max-width: 1440px;
            margin: 0 auto;
            padding: 70px 24px 0;
        }

        /* ----- NEWSLETTER CTA BAR ----- */
        .hhn-footer-cta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 32px 36px;
            margin-bottom: 60px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05));
            border: 1px solid rgba(245, 158, 11, 0.25);
            position: relative;
            overflow: hidden;
        }

        .hhn-footer-cta::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -10%;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.08);
            pointer-events: none;
        }

        .hhn-footer-cta-content {
            position: relative;
            z-index: 1;
            flex: 1;
            min-width: 260px;
        }

        .hhn-footer-cta-title {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .hhn-footer-cta-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        .hhn-footer-cta-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 12px;
            background: #f59e0b;
            color: #0b1d52;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s ease;
            white-space: nowrap;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.25);
        }

        .hhn-footer-cta-btn:hover {
            background: #fbbf24;
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(245, 158, 11, 0.35);
        }

        .hhn-footer-cta-btn .material-symbols-outlined {
            font-size: 18px;
        }

        /* ----- FOOTER MAIN GRID ----- */
        .hhn-footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 48px;
            padding-bottom: 50px;
        }

        /* ----- BRAND COLUMN ----- */
        .hhn-footer-brand {
            max-width: 380px;
        }

        .hhn-footer-logo {
            width: 200px;
            height: auto;
            object-fit: contain;
            filter: brightness(0) invert(1);
            display: block;
            margin-bottom: 24px;
        }

        .hhn-footer-description {
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .hhn-footer-contact {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hhn-footer-contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .hhn-footer-contact-item:hover {
            color: #f59e0b;
        }

        .hhn-footer-contact-item .material-symbols-outlined {
            font-size: 18px;
            color: #f59e0b;
            flex-shrink: 0;
        }

        /* ----- FOOTER LINK COLUMNS ----- */
        .hhn-footer-heading {
            margin-bottom: 22px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            position: relative;
            padding-bottom: 12px;
        }

        .hhn-footer-heading::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 32px;
            height: 2px;
            border-radius: 999px;
            background: #f59e0b;
        }

        .hhn-footer-link {
            display: block;
            width: fit-content;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
            position: relative;
            padding-left: 0;
        }

        .hhn-footer-link:hover {
            color: #ffffff;
            transform: translateX(4px);
        }

        .hhn-footer-link::before {
            content: "";
            position: absolute;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #f59e0b;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .hhn-footer-link:hover::before {
            opacity: 1;
        }

        /* ----- SOCIAL ICONS ----- */
        .hhn-footer-social {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .hhn-social-btn {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .hhn-social-btn:hover {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #0b1d52;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        .hhn-social-btn .material-symbols-outlined {
            font-size: 19px;
        }

        /* ----- FOOTER BOTTOM ----- */
        .hhn-footer-bottom {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
            justify-content: space-between;
            padding: 28px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .hhn-footer-copy {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
            line-height: 1.6;
        }

        .hhn-footer-copy a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .hhn-footer-copy a:hover {
            color: #f59e0b;
        }

        .hhn-footer-values {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            letter-spacing: 0.2em;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
        }

        .hhn-footer-values span {
            color: #f59e0b;
            font-size: 8px;
        }

        /* ----- WHATSAPP FLOATING BUTTON ----- */
        .hhn-whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 50;
            width: 52px;
            height: 52px;
            background: #10b981;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
            text-decoration: none;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .hhn-whatsapp:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.45);
        }

        .hhn-whatsapp .material-symbols-outlined {
            font-size: 26px;
        }

        /* =========================================================
           RESPONSIVE BREAKPOINTS
        ========================================================= */

        /* --- LARGE DESKTOP (≥1280px) --- */
        @media (min-width: 1280px) {
            .hhn-footer-grid {
                grid-template-columns: 2fr 1fr 1fr 1.2fr;
                gap: 56px;
            }

            .hhn-footer-bottom {
                flex-direction: row;
                text-align: left;
            }
        }

        /* --- DESKTOP (1024px – 1279px) --- */
        @media (min-width: 1024px) and (max-width: 1279px) {
            .hhn-logo {
                width: 135px;
            }

            .hhn-nav-link {
                font-size: 14px;
            }

            .hhn-desktop-nav {
                gap: 20px;
            }

            .hhn-footer-grid {
                grid-template-columns: 2fr 1fr 1fr 1.2fr;
                gap: 36px;
            }

            .hhn-footer-inner {
                padding: 60px 20px 0;
            }
        }

        /* --- TABLET (768px – 1023px) --- */
        @media (min-width: 768px) and (max-width: 1023px) {

            .hhn-desktop-nav,
            .hhn-desktop-login,
            .hhn-search-btn,
            .hhn-divider {
                display: none !important;
            }

            .hhn-menu-btn {
                display: flex;
            }

            .hhn-logo {
                width: 140px;
            }

            .hhn-header-height {
                padding: 0 20px;
            }

            .hhn-footer-inner {
                padding: 55px 20px 0;
            }

            .hhn-footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }

            .hhn-footer-brand {
                grid-column: 1 / -1;
                max-width: 100%;
            }

            .hhn-footer-bottom {
                flex-direction: row;
                text-align: left;
            }

            .hhn-footer-cta {
                padding: 28px 28px;
                margin-bottom: 48px;
            }
        }

        /* --- MOBILE (≤767px) --- */
        @media (max-width: 767px) {

            .hhn-desktop-nav,
            .hhn-desktop-login,
            .hhn-search-btn,
            .hhn-divider {
                display: none !important;
            }

            .hhn-menu-btn {
                display: flex;
            }

            .hhn-header-height {
                height: 70px;
                padding: 0 16px;
            }

            .hhn-logo {
                width: 122px;
            }

            .hhn-donate {
                min-height: 42px;
                padding: 0 15px;
                border-radius: 9px;
                font-size: 13px;
                gap: 6px;
            }

            .hhn-donate .material-symbols-outlined {
                font-size: 16px;
            }

            .hhn-donate .hhn-donate-arrow {
                display: none;
            }

            .hhn-mobile-menu {
                padding: 12px 16px;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
            }

            .hhn-main {
                padding-top: 86px;
            }

            .hhn-footer-inner {
                padding: 50px 16px 0;
            }

            .hhn-footer-cta {
                padding: 24px 20px;
                margin-bottom: 40px;
                border-radius: 16px;
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .hhn-footer-cta-title {
                font-size: 18px;
            }

            .hhn-footer-cta-btn {
                width: 100%;
                justify-content: center;
            }

            .hhn-footer-grid {
                grid-template-columns: 1fr;
                gap: 36px;
                padding-bottom: 40px;
            }

            .hhn-footer-brand {
                max-width: 100%;
            }

            .hhn-footer-logo {
                width: 200px;
            }

            .hhn-footer-heading {
                margin-bottom: 18px;
            }

            .hhn-footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 14px;
                padding: 24px 0;
            }

            .hhn-footer-values {
                justify-content: center;
            }

            .hhn-whatsapp {
                width: 48px;
                height: 48px;
                bottom: 16px;
                right: 16px;
            }

            .hhn-whatsapp .material-symbols-outlined {
                font-size: 24px;
            }
        }

        /* --- SMALL MOBILE (≤480px) --- */
        @media (max-width: 480px) {
            .hhn-logo {
                width: 108px;
            }

            .hhn-donate {
                padding: 0 12px;
                font-size: 12px;
                min-height: 38px;
                gap: 5px;
            }

            .hhn-donate .material-symbols-outlined {
                font-size: 15px;
            }

            .hhn-header-height {
                padding: 0 12px;
            }

            .hhn-footer-inner {
                padding: 40px 12px 0;
            }

            .hhn-footer-cta {
                padding: 20px 16px;
                margin-bottom: 32px;
            }

            .hhn-footer-cta-title {
                font-size: 16px;
            }

            .hhn-footer-cta-subtitle {
                font-size: 13px;
            }

            .hhn-footer-cta-btn {
                padding: 12px 20px;
                font-size: 14px;
            }

            .hhn-footer-social {
                gap: 8px;
            }

            .hhn-social-btn {
                width: 38px;
                height: 38px;
                border-radius: 10px;
            }

            .hhn-social-btn .material-symbols-outlined {
                font-size: 17px;
            }

            .hhn-footer-contact-item {
                font-size: 13px;
            }

            .hhn-footer-link {
                font-size: 13px;
                margin-bottom: 12px;
            }

            .hhn-footer-copy {
                font-size: 12px;
            }

            .hhn-footer-values {
                font-size: 10px;
                letter-spacing: 0.15em;
            }
        }

        /* --- EXTRA SMALL (≤360px) --- */
        @media (max-width: 360px) {
            .hhn-logo {
                width: 96px;
            }

            .hhn-donate {
                padding: 0 10px;
                font-size: 11px;
                min-height: 36px;
            }

            .hhn-donate .material-symbols-outlined {
                font-size: 14px;
            }

            .hhn-header-height {
                height: 64px;
                padding: 0 10px;
            }

            .hhn-main {
                padding-top: 78px;
            }

            .hhn-footer-inner {
                padding: 36px 10px 0;
            }

            .hhn-footer-cta {
                padding: 16px 14px;
            }

            .hhn-footer-cta-title {
                font-size: 15px;
            }

            .hhn-footer-values {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* ----- UTILITY ----- */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }
    </style>
</head>

<body>

    {{-- =========================================================
    HEADER — SOLID ROYAL BLUE
    ========================================================= --}}

    <header class="hhn-header">
        <div class="hhn-header-height">

            <a href="{{ route('home') }}" class="hhn-brand-accent" aria-label="Hum Hain Na Foundation Home">
                <img src="{{ asset('images/logo-bg.png') }}" alt="Hum Hain Na Foundation" class="hhn-logo">
            </a>

            <nav class="hhn-desktop-nav" aria-label="Main navigation">
                @foreach ([
                        'Home' => route('home'),
                        'About' => route('about'),
                        'Our Work' => route('gallery.index'),
                        'Events' => route('events.index'),
                        'Volunteer' => route('volunteer.apply.form'),
                        'Blog' => route('blog.index'),
                    ] as $label => $href)
                    <a href="{{ $href }}" class="hhn-nav-link {{ request()->url() === $href ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="hhn-actions">

                <!-- <a href="#" class="hhn-icon-btn hhn-search-btn" aria-label="Search">
                <span class="material-symbols-outlined">search</span>
            </a> -->

                <span class="hhn-divider hhn-divider-desktop"></span>

                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.home') : route('dashboard.home') }}"
                        class="hhn-account-link hhn-desktop-login" aria-label="Account">
                        <span class="material-symbols-outlined">account_circle</span>
                        <span>Account</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hhn-login-link hhn-desktop-login">
                        Login
                    </a>
                @endauth

                <a href="{{ route('donate.show') }}" class="hhn-donate">
                    <span class="material-symbols-outlined">favorite</span>
                    <span>Donate Now</span>
                    <span class="material-symbols-outlined hhn-donate-arrow">arrow_forward</span>
                </a>

                <button type="button" class="hhn-menu-btn" aria-label="Toggle navigation menu"
                    aria-controls="mobile-nav" aria-expanded="false" onclick="toggleMobileMenu(this)">
                    <span class="material-symbols-outlined">menu</span>
                </button>

            </div>
        </div>

        <div id="mobile-nav" class="hhn-mobile-menu" role="navigation" aria-label="Mobile navigation">
            <div class="hhn-mobile-inner">
                @foreach ([
                        'Home' => route('home'),
                        'About' => route('about'),
                        'Our Work' => route('gallery.index'),
                        'Achievements' => route('achievements'),
                        'Events' => route('events.index'),
                        'Volunteer' => route('volunteer.apply.form'),
                        'Certificates & Verification' => route('certificates.info'),
                        'Blog' => route('blog.index'),
                        'FAQ' => route('faq'),
                        'Contact' => route('contact.show'),
                    ] as $label => $href)
                    <a href="{{ $href }}" class="hhn-mobile-link {{ request()->url() === $href ? 'active' : '' }}">
                        <span>{{ $label }}</span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                @endforeach

                <div class="hhn-mobile-divider">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hhn-mobile-logout">
                                <span>Logout</span>
                                <span class="material-symbols-outlined">logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hhn-mobile-link">
                            <span>Login</span>
                            <span class="material-symbols-outlined">login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- =========================================================
    MAIN CONTENT
    ========================================================= --}}

    <main class="hhn-main">
        @yield('content')
    </main>

    {{-- =========================================================
    FOOTER — COMPLETELY REDESIGNED
    ========================================================= --}}

    <footer class="hhn-footer">

        <div class="hhn-footer-inner">

            {{-- =============================================
            NEWSLETTER / CTA BAR
            ============================================== --}}
            <div class="hhn-footer-cta">
                <div class="hhn-footer-cta-content">
                    <h3 class="hhn-footer-cta-title">Be the reason for a brighter tomorrow</h3>
                    <p class="hhn-footer-cta-subtitle">
                        Join our mission. Every contribution creates ripples of change across communities.
                    </p>
                </div>
                <a href="{{ route('donate.show') }}" class="hhn-footer-cta-btn">
                    <span class="material-symbols-outlined">volunteer_activism</span>
                    <span>Support Our Cause</span>
                </a>
            </div>

            {{-- =============================================
            FOOTER MAIN GRID
            ============================================== --}}
            <div class="hhn-footer-grid">

                {{-- =============================================
                BRAND COLUMN
                ============================================== --}}
                <div class="hhn-footer-brand">
                    <img src="{{ asset('images/logo-bg.png') }}" alt="Hum Hain Na Foundation" class="hhn-footer-logo">

                    <p class="hhn-footer-description">
                        Hum Hain Na Foundation works across education, health, environment and relief — powered by
                        volunteers and transparent giving.
                    </p>

                    {{-- Contact Info --}}
                    <div class="hhn-footer-contact">
                        @php($email = \App\Models\Setting::get('contact_email'))
                        @php($phone = \App\Models\Setting::get('contact_phone'))
                        @php($address = \App\Models\Setting::get('contact_address'))

                        @if ($email)
                            <a href="mailto:{{ $email }}" class="hhn-footer-contact-item">
                                <span class="material-symbols-outlined">mail</span>
                                <span>{{ $email }}</span>
                            </a>
                        @endif

                        @if ($phone)
                            <a href="tel:{{ preg_replace('/\D/', '', $phone) }}" class="hhn-footer-contact-item">
                                <span class="material-symbols-outlined">call</span>
                                <span>{{ $phone }}</span>
                            </a>
                        @endif

                        @if ($address)
                            <div class="hhn-footer-contact-item">
                                <span class="material-symbols-outlined">location_on</span>
                                <span>{{ $address }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Social Icons --}}
                    <div class="hhn-footer-social">
                        @foreach ([
                                ['facebook', \App\Models\Setting::get('social_facebook')],
                                ['photo_camera', \App\Models\Setting::get('social_instagram')],
                                ['alternate_email', \App\Models\Setting::get('social_twitter')],
                                ['smart_display', \App\Models\Setting::get('social_youtube')],
                                ['business_center', \App\Models\Setting::get('social_linkedin')],
                            ] as [$icon, $url])
                            @if ($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $icon }}"
                                    class="hhn-social-btn">
                                    <span class="material-symbols-outlined">{{ $icon }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- =============================================
                EXPLORE
                ============================================== --}}
                <div>
                    <h3 class="hhn-footer-heading">Explore</h3>
                    <a href="{{ route('about') }}" class="hhn-footer-link">About Us</a>
                    <a href="{{ route('gallery.index') }}" class="hhn-footer-link">Our Work</a>
                    <a href="{{ route('achievements') }}" class="hhn-footer-link">Achievements</a>
                    <a href="{{ route('events.index') }}" class="hhn-footer-link">Events</a>
                    <a href="{{ route('volunteer.apply.form') }}" class="hhn-footer-link">Get Involved</a>
                    <a href="{{ route('blog.index') }}" class="hhn-footer-link">Blog / News</a>
                </div>

                {{-- =============================================
                RESOURCES
                ============================================== --}}
                <div>
                    <h3 class="hhn-footer-heading">Resources</h3>
                    <a href="{{ route('certificates.info') }}" class="hhn-footer-link">Verify Certificate</a>
                    <a href="{{ route('faq') }}" class="hhn-footer-link">FAQ</a>
                    <a href="{{ route('feedback.show') }}" class="hhn-footer-link">Feedback</a>
                    <a href="{{ route('privacy') }}" class="hhn-footer-link">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hhn-footer-link">Terms of Service</a>
                    <a href="{{ route('contact.show') }}" class="hhn-footer-link">Contact Us</a>
                </div>

                {{-- =============================================
                QUICK CONTACT / NEWSLETTER
                ============================================== --}}
                <div>
                    <h3 class="hhn-footer-heading">Get in Touch</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.7; margin-bottom: 20px;">
                        Have questions or want to collaborate? We'd love to hear from you.
                    </p>
                    <a href="{{ route('contact.show') }}"
                        style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 10px; background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); color: #f59e0b; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.25s ease;"
                        onmouseover="this.style.background='rgba(245,158,11,0.25)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.background='rgba(245,158,11,0.15)'; this.style.transform='translateY(0)';">
                        <span class="material-symbols-outlined" style="font-size: 18px;">chat</span>
                        <span>Contact Us</span>
                    </a>
                </div>

            </div>

            {{-- =============================================
            FOOTER BOTTOM
            ============================================== --}}
            <div class="hhn-footer-bottom">
                <p class="hhn-footer-copy">
                    {{ \App\Models\Setting::get(
    'footer_note',
    '© ' . now()->year . ' Hum Hain Na Foundation. All rights reserved.'
) }}
                    &nbsp;|&nbsp;
                    <a href="{{ route('privacy') }}">Privacy</a>
                    &nbsp;|&nbsp;
                    <a href="{{ route('terms') }}">Terms</a>
                </p>

                <p class="hhn-footer-values">
                    <span>●</span> PEOPLE <span>●</span> PURPOSE <span>●</span> PROGRESS
                </p>
            </div>

        </div>
    </footer>

    {{-- =========================================================
    WHATSAPP FLOATING BUTTON
    ========================================================= --}}

    @php($wa = \App\Models\Setting::get('whatsapp_number'))

    @if ($wa)
        <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}?text={{ urlencode('Hello Hum Hain Na Foundation!') }}"
            target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp" class="hhn-whatsapp">
            <span class="material-symbols-outlined">chat</span>
        </a>
    @endif

    {{-- =========================================================
    SCRIPTS
    ========================================================= --}}

    <script>
        function toggleMobileMenu(btn) {
            const nav = document.getElementById('mobile-nav');
            const expanded = btn.getAttribute('aria-expanded') === 'true';

            nav.classList.toggle('open');
            btn.setAttribute('aria-expanded', !expanded);

            const icon = btn.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.textContent = nav.classList.contains('open') ? 'close' : 'menu';
            }
        }

        document.querySelectorAll('#mobile-nav a').forEach(link => {
            link.addEventListener('click', () => {
                const nav = document.getElementById('mobile-nav');
                const btn = document.querySelector('.hhn-menu-btn');
                const icon = btn?.querySelector('.material-symbols-outlined');

                nav?.classList.remove('open');
                btn?.setAttribute('aria-expanded', 'false');
                if (icon) icon.textContent = 'menu';
            });
        });

        document.querySelectorAll('[data-autodismiss]').forEach(el => {
            setTimeout(() => {
                el.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => el.remove(), 500);
            }, 6000);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const nav = document.getElementById('mobile-nav');
                const btn = document.querySelector('.hhn-menu-btn');
                const icon = btn?.querySelector('.material-symbols-outlined');

                nav?.classList.remove('open');
                btn?.setAttribute('aria-expanded', 'false');
                if (icon) icon.textContent = 'menu';
            }
        });
    </script>

    @stack('scripts')

</body>

</html>