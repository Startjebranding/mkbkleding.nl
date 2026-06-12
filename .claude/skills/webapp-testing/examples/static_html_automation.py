"""Automate interactions on a local static HTML file."""
import sys
from pathlib import Path
from playwright.sync_api import sync_playwright

html_file = Path(sys.argv[1] if len(sys.argv) > 1 else "index.html").resolve()
file_url = html_file.as_uri()

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(viewport={"width": 1920, "height": 1080})
    page.goto(file_url)

    page.screenshot(path="/mnt/user-data/outputs/before.png", full_page=True)
    print("Before screenshot saved.")

    # Example interactions — adjust selectors to match your HTML:
    page.click("text=Click Me")
    page.fill("input[name=name]", "Test User")
    page.fill("input[name=email]", "test@example.com")
    page.click("button[type=submit]")
    page.wait_for_timeout(500)

    page.screenshot(path="/mnt/user-data/outputs/after.png", full_page=True)
    print("After screenshot saved.")
    browser.close()
