# Web Application Testing

Use this skill to test local web applications using Playwright with Python.

## Decision Tree

1. **Static HTML file?** → Read the file directly to identify selectors, then automate
2. **Dynamic app (needs a server)?**
   - Server already running? → Connect directly
   - Server not running? → Use `scripts/with_server.py` to manage startup

## Running Scripts

Always run scripts with `--help` first to see usage. DO NOT read the source until you try running the script first — these scripts can be large and consume significant context.

```bash
python scripts/with_server.py --help
```

## Critical: Wait for Network Idle

On dynamic applications, always wait for the page to fully load before inspecting the DOM:

```python
page.wait_for_load_state('networkidle')
```

Failing to wait results in incomplete DOM inspection and flaky tests.

## Automation Pattern

1. **Reconnaissance** — Take a screenshot or inspect the rendered DOM to discover selectors
2. **Identify** — Note the selectors (IDs, classes, text, roles) from the results
3. **Act** — Execute interactions using those discovered selectors

## Examples

See the `examples/` directory for ready-to-use scripts:

- `element_discovery.py` — Discover all buttons, links, and inputs on a page
- `static_html_automation.py` — Automate interactions on a local HTML file
- `console_logging.py` — Capture browser console output during testing

## Starting a Server + Running Tests

Single server:
```bash
python scripts/with_server.py --server "npm run dev" --port 5173 -- python my_test.py
```

Multiple servers (e.g. frontend + backend):
```bash
python scripts/with_server.py \
  --server "npm run dev" --port 5173 \
  --server "python backend/server.py" --port 8000 \
  -- python my_test.py
```
