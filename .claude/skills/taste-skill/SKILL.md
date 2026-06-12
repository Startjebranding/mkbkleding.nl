# Taste Skill — Anti-Slop Frontend Design

For landing pages, portfolios, and redesigns. NOT for dashboards, data tables, multi-step forms, code editors, native mobile, or realtime collab UIs.

## Section 0 — Brief Inference

Before touching code, read the room. Infer page kind, vibe, audience, and existing assets. Output a one-line **Design Read** declaring the aesthetic direction before proceeding.

## Section 1 — Three Dials

Set these values explicitly before designing. They drive every layout, spacing, and motion decision:

- **DESIGN_VARIANCE** (1–10): 1 = symmetrical/safe → 10 = asymmetrical/experimental
- **MOTION_INTENSITY** (1–10): 1 = static → 10 = cinematic
- **VISUAL_DENSITY** (1–10): 1 = gallery-airy → 10 = cockpit-packed

## Section 2 — Design System Map

For official systems (Material, Fluent, Carbon, Polaris, Primer, GOV.UK, USWDS, Radix Themes, shadcn/ui) → use the **official packages**.

For aesthetics without a single system (glassmorphism, brutalism, editorial, kinetic type) → build with native CSS + Tailwind + a maintained component library.

## Section 3 — Default Architecture

- **Framework:** React / Next.js with Server Components
- **Styling:** Tailwind v4
- **Animation:** Motion (`motion/react`)
- **Icons:** Phosphor, HugeIcons, Radix, or Tabler — never Lucide by default; never hand-rolled SVGs
- **Fonts:** `next/font` or self-hosted with `@font-face`

## Section 4 — Design Engineering Directives

**Typography:**
- Preferred fonts: Geist, Outfit, Cabinet Grotesk, Satoshi — over Inter
- Serif only when brand-justified
- Italic descender clearance mandatory

**Color:**
- One accent maximum
- Desaturate to ~80%
- Ban "AI purple"
- Lock one palette per project

**Layout:**
- Hero fits viewport
- Max 4 text elements in hero
- No centered hero when DESIGN_VARIANCE > 4
- Section-layout diversity required
- Eyebrow count ≤ ceil(sectionCount / 3)

**Interactive states:** Loading, empty, error, tactile feedback. Button contrast WCAG AA. No wrapped CTA text at desktop.

**Cards & shadows:** Use cards only for real hierarchy. Tint shadows to background hue.

**Data & forms:** Label above input. No placeholder-as-label. Error text below field.

**Hard layout rules:**
- Hero top padding max `pt-24`
- Nav on one line at desktop
- No zigzag layout > 2 consecutive sections
- No split-header pattern as default
- Bento cell count exact (N items = N cells)

**Image strategy:** Gen-tool first → Picsum-seed second → real assets third. No div-based fake screenshots. Real logo SVGs (Simple Icons) for social proof.

**Content density:** Headlines ≤ 8 words. Sub-paragraphs ≤ 25 words. Long lists need alternative UI (cards, tabs, carousel, marquee).

## Section 6 — Performance & Accessibility

- Animate only `transform` and `opacity`
- Honor `prefers-reduced-motion` (mandatory for MOTION_INTENSITY > 3)
- Dark mode by default (dual-mode design)
- Core Web Vitals: LCP < 2.5s, INP < 200ms, CLS < 0.1

## Section 8 — Dark Mode Protocol

Pick ONE token strategy: Tailwind `dark:` variant OR CSS variables. Maintain hierarchy and contrast in both modes. Respect `prefers-color-scheme: dark`.

---

## Section 9 — AI Tells: FORBIDDEN PATTERNS

### Typography
- NO `Inter` as default
- NO Fraunces or Instrument_Serif as default display serif
- NO serif for creative/agency/modern briefs

### Layout & Spacing
- NO centered hero by default (DESIGN_VARIANCE > 4 → asymmetric)
- NO 3-column equal feature cards
- NO zigzag alternation > 2 consecutive sections
- NO split-header "left headline + right explainer paragraph" pattern

### Content & Copy
- NO "Jane Doe" generic names
- NO generic avatars (egg icons)
- NO fake-perfect numbers (99.99%, 50%)
- NO startup-slop brand names ("Acme", "Nexus", "Cloudly")
- NO filler verbs ("Elevate", "Seamless", "Unleash")

### Color
- NO AI-purple gradients by default
- NO oversaturated accents (desaturate to < 80%)
- NO pure black or white
- BANNED: warm beige + brass + oxblood + espresso palette as default for premium-consumer briefs

### External Resources
- NO hand-rolled SVG icons
- NO div-based fake screenshots
- NO broken Unsplash links

### Marketing Copy Tells
- NO version labels in hero (V0.6, BETA, INVITE-ONLY) unless brief is a launch
- NO section-numbering eyebrows (00 / INDEX, 001 · Capabilities)
- NO scroll cues (Scroll, ↓ scroll)
- NO decoration text strips at hero bottom (BRAND. MOTION. SPATIAL.)

### EM-DASH BAN (Non-Negotiable)

The em-dash (`—`) is **completely forbidden** in all contexts: headlines, eyebrows, pills, button text, captions, nav, body copy, quotes, attribution.

Replace with: periods, commas, parentheses, colons, or line breaks.

The ONLY permitted dash is the regular hyphen (`-`).

Zero em-dashes on the page = mandatory pre-flight requirement.

---

## Section 11 — Redesign Protocol

1. **Detect mode:** Greenfield, Preserve, or Overhaul
2. **Audit first:** Brand tokens, IA, content blocks, patterns to preserve/retire, current dial reading, SEO baseline
3. **Preserve:** IA, copy voice, accessibility wins, analytics events
4. **Modernize in order:** Typography → Spacing → Color → Motion → Hero → Full block replacement

Never change slugs, nav labels, form field names, or logo silently.

---

## Section 14 — Pre-Flight Checklist (Mandatory)

Any failing item = page not done.

- [ ] Design Read declared
- [ ] Dial values explicit (DESIGN_VARIANCE, MOTION_INTENSITY, VISUAL_DENSITY)
- [ ] Design system chosen
- [ ] ZERO em-dashes anywhere on the page
- [ ] Page theme locked (one light/dark/auto across all sections)
- [ ] One accent color, used consistently
- [ ] One border-radius system
- [ ] Button contrast WCAG AA
- [ ] Form contrast WCAG AA
- [ ] Hero fits viewport (≤ 2-line headline, ≤ 20-word subtext, CTA visible above fold)
- [ ] Hero stack ≤ 4 text elements
- [ ] Eyebrow count ≤ ceil(sectionCount / 3)
- [ ] No split-header pattern
- [ ] No zigzag > 2 consecutive sections
- [ ] No duplicate CTA intent
- [ ] Logo walls = real SVGs (Simple Icons) only
- [ ] Bento cells = exact item count
- [ ] No AI Tells from Section 9
- [ ] Every animation has a one-sentence justification
- [ ] Mobile collapse behavior explicit
- [ ] Dark mode tested in both themes
- [ ] Reduced motion honored
- [ ] Core Web Vitals plausible

---

## Appendix — Design System Install Commands

```bash
npm install @material/web                          # Material Web (Material 3)
npm install @fluentui/react-components             # Fluent UI React v9
npm install @carbon/react @carbon/styles           # IBM Carbon
npm install @radix-ui/themes                       # Radix Themes
npx shadcn@latest init                             # shadcn/ui
npm install @primer/css                            # Primer CSS
npm install govuk-frontend                         # GOV.UK Frontend
npm install uswds                                  # USWDS
npm install bootstrap                              # Bootstrap 5.3
```
