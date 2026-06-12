"""Discover buttons, links, and inputs on a running local dev server."""
from playwright.sync_api import sync_playwright

URL = "http://localhost:5173"

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(viewport={"width": 1920, "height": 1080})
    page.goto(URL)
    page.wait_for_load_state("networkidle")

    print("=== Buttons ===")
    for btn in page.locator("button").all():
        text = btn.inner_text().strip() or "[hidden]"
        print(f"  {text}")

    print("\n=== Links (first 5) ===")
    for link in page.locator("a[href]").all()[:5]:
        print(f"  {link.inner_text().strip()!r} → {link.get_attribute('href')}")

    print("\n=== Input Fields ===")
    for inp in page.locator("input[type=text], input[type=email], input[type=password], textarea, select").all():
        name = inp.get_attribute("name") or inp.get_attribute("id") or "?"
        kind = inp.get_attribute("type") or inp.evaluate("el => el.tagName.toLowerCase()")
        print(f"  [{kind}] {name}")

    page.screenshot(path="/mnt/user-data/outputs/discovery.png", full_page=True)
    print("\nScreenshot saved to /mnt/user-data/outputs/discovery.png")
    browser.close()
