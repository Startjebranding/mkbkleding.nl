# Impeccable — Production-Grade Frontend Design

Ship battle-tested, pixel-perfect UI code. Not prototypes. Not starting points. Complete implementations that are beautiful, responsive, fast, accessible, on-brand, and free of common AI tells.

## Setup (Required Before Any Work)

1. Run `node scripts/context.mjs` to load project context (PRODUCT.md / DESIGN.md). Stop if it reports `NO_PRODUCT_MD` — follow `reference/init.md` first.
2. If invoking a sub-command, read its reference file (`reference/<command>.md`).
3. Familiarise yourself with existing design systems, tokens, and components in the codebase.
4. Read the matching register reference: `reference/brand.md` for marketing/identity-driven work; `reference/product.md` for app/tool UI.
5. If the project has no committed brand colors, run `node scripts/palette.mjs` for a seed color and composition guidance.

## Design Rules (Non-Negotiable)

### Color
- Body text ≥ 4.5:1 contrast; large text ≥ 3:1. Verify every time.
- Use OKLCH throughout.
- Avoid warm-tinted near-white body backgrounds; carry warmth through accent and typography instead.

### Typography
- Body text: 65–75ch line length maximum.
- Display headings: `clamp()` max ≤ 6rem; letter-spacing floor ≥ -0.04em.
- Use `text-wrap: balance` on h1–h3; `text-wrap: pretty` on prose.

### Layout
- Vary spacing for rhythm.
- Flexbox for 1D; Grid for 2D.
- Semantic z-index scales (never 999 / 9999).

### Motion
- Intentional only; never an afterthought.
- Ease out with exponential curves.
- Reduced motion support is mandatory.
- Never animate `<img>` on hover.

## Absolute Bans — Refuse & Rewrite

- Side-stripe borders (>1px colored left/right borders)
- Gradient text
- Glassmorphism as default aesthetic
- Identical card grids repeated endlessly
- Tiny uppercase eyebrows above every section
- Numbered section markers as default scaffolding (01 / 02 / 03)
- Text overflow on mobile/tablet
- Ghost cards (1px border + wide shadow)
- Over-rounded cards (>16px border-radius)
- Hand-drawn / sketchy SVG illustrations
- Repeating-gradient stripe backgrounds

## Commands

| Command | Use When |
|---------|----------|
| `craft` | Build a feature end-to-end |
| `shape` | Plan UX/UI before writing code |
| `init` | Set up project context |
| `critique` | UX design review with scoring |
| `audit` | Accessibility / performance / responsive checks |
| `polish` | Final quality pass |
| `animate` | Add purposeful motion |
| `colorize` | Add strategic color to monochromatic UI |
| `typeset` | Improve typography hierarchy |
| `layout` | Fix spacing and visual hierarchy |
| `quieter` | Tone down aggressive designs |
| `bolder` | Amplify bland designs |
| `clarify` | Improve UX copy and labels |
| `live` | In-browser visual iteration |

## AI Slop Test

If someone could identify this as "AI-made" by design alone, it failed. Refuse:
- First-order reflexes (obvious palette from category)
- Second-order reflexes (predictable aesthetic family even with anti-references)

## Pin / Unpin Shortcuts

```bash
node scripts/pin.mjs <pin|unpin> <command>
```

License: Apache 2.0
