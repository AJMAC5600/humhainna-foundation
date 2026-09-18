{{-- Shared design system extracted from the Stitch project (project 134589786433582143) --}}
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary-container": "#1e3a8a",
                    "on-background": "#0b1c30",
                    "surface-container-high": "#dce9ff",
                    "surface-light": "#F8FAFC",
                    "surface-dim": "#cbdbf5",
                    "secondary": "#a63b00",
                    "surface-container-low": "#eff4ff",
                    "error": "#ba1a1a",
                    "on-secondary": "#ffffff",
                    "inverse-surface": "#213145",
                    "outline": "#767680",
                    "on-surface": "#0b1c30",
                    "error-container": "#ffdad6",
                    "warning-amber": "#F59E0B",
                    "secondary-container": "#fc6c29",
                    "on-surface-variant": "#45464f",
                    "on-primary": "#ffffff",
                    "success-green": "#10B981",
                    "background": "#f8f9ff",
                    "danger-red": "#EF4444",
                    "primary": "#000000",
                    "surface-container": "#e5eeff",
                    "primary-fixed-dim": "#b9c3ff",
                    "outline-variant": "#c6c5d0",
                    "on-primary-container": "#7681b9",
                    "surface-variant": "#d3e4fe",
                    "surface-tint": "#505b91",
                    "on-error": "#ffffff",
                    "inverse-on-surface": "#eaf1ff"
                },
                borderRadius: {
                    DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px"
                },
                spacing: {
                    "section-gap-sm": "3rem",
                    "container-max": "1280px",
                    "margin-desktop": "2.5rem",
                    "margin-mobile": "1rem",
                    gutter: "1.5rem",
                    "section-gap-lg": "5rem"
                },
                fontFamily: {
                    "label-sm": ["Inter"],
                    "headline-lg": ["Plus Jakarta Sans"],
                    "body-lg": ["Inter"],
                    "headline-md": ["Plus Jakarta Sans"],
                    "body-md": ["Inter"],
                    "display-lg": ["Plus Jakarta Sans"],
                    "mono-id": ["JetBrains Mono"]
                },
                fontSize: {
                    "label-sm": ["14px", { lineHeight: "1.4", letterSpacing: "0.01em", fontWeight: "500" }],
                    "headline-lg": ["32px", { lineHeight: "1.3", fontWeight: "600" }],
                    "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                    "headline-md": ["24px", { lineHeight: "1.4", fontWeight: "600" }],
                    "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
                    "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700" }]
                }
            }
        }
    }
</script>
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; }
</style>
