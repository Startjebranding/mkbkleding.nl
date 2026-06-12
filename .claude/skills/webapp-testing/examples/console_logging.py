"""Capture browser console output while interacting with a local dev server."""
from pathlib import Path
from playwright.sync_api import sync_playwright

URL = "http://localhost:5173"
OUTPUT = Path("/mnt/user-data/outputs/console.log")

messages = []

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(viewport={"width": 1920, "height": 1080})

    page.on("console", lambda msg: messages.append(f"[{msg.type}] {msg.text}") or print(messages[-1]))

    page.goto(URL)
    page.wait_for_load_state("networkidle")

    # Example interaction — adjust to your app:
    page.click("text=Dashboard")
    page.wait_for_timeout(1000)

    OUTPUT.parent.mkdir(parents=True, exist_ok=True)
    OUTPUT.write_text("\n".join(messages))
    print(f"\nCaptured {len(messages)} console messages → {OUTPUT}")
    browser.close()
