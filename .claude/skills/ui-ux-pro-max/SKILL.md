# UI/UX Pro Max

Use this skill when your task involves UI structure, visual design, interaction patterns, or user experience quality. Not needed for backend logic, APIs, or infrastructure work.

## 10 Priority Rule Categories

1. **Accessibility (CRITICAL)** — contrast ≥4.5:1, keyboard navigation, focus management, alt text
2. **Touch & Interaction (CRITICAL)** — 44×44px minimum targets, spacing, tactile feedback
3. **Performance (HIGH)** — image optimization, lazy loading, layout stability (no CLS)
4. **Style Selection (HIGH)** — consistency, match product type, proper visual effects
5. **Layout & Responsive (HIGH)** — mobile-first, breakpoints, safe areas
6. **Typography & Color (MEDIUM)** — contrast ratios, semantic tokens, visual hierarchy
7. **Animation (MEDIUM)** — 150–300ms timing, meaningful motion, `prefers-reduced-motion` support
8. **Forms & Feedback (MEDIUM)** — visible labels, clear error messages, progressive disclosure
9. **Navigation Patterns (HIGH)** — predictable back navigation, deep linking, proper hierarchies
10. **Charts & Data (LOW)** — accessible color palettes, legends, tooltips

## Workflow

**Step 1:** Analyze requirements — product type, audience, style keywords, tech stack

**Step 2:** Generate a complete design system:
```bash
python3 skills/ui-ux-pro-max/scripts/search.py "<query>" --design-system -p "Project Name"
```

**Step 3:** Supplement with domain-specific searches:
```bash
python3 skills/ui-ux-pro-max/scripts/search.py "<query>" --domain style
python3 skills/ui-ux-pro-max/scripts/search.py "<query>" --domain ux
```

**Step 4:** For React Native work, add `--stack react-native`

## Pre-Delivery Checklist

- [ ] No emojis used as icons
- [ ] All touch targets ≥ 44pt
- [ ] Consistent spacing rhythm throughout
- [ ] Safe-area compliance (iOS/Android)
- [ ] Text contrast ≥ 4.5:1 in both light and dark modes
- [ ] All interactive elements have accessibility labels
- [ ] Reduced motion respected
