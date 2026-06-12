#!/usr/bin/env python3
"""
Manage server lifecycle for webapp testing.

Usage:
  Single server:
    python scripts/with_server.py --server "npm run dev" --port 5173 -- python automation.py

  Multiple servers:
    python scripts/with_server.py \\
      --server "npm run dev" --port 5173 \\
      --server "python backend/server.py" --port 8000 \\
      -- python automation.py
"""
import argparse
import socket
import subprocess
import sys
import time


def is_server_ready(port: int, timeout: int = 30) -> bool:
    deadline = time.time() + timeout
    while time.time() < deadline:
        try:
            with socket.create_connection(("localhost", port), timeout=1):
                return True
        except OSError:
            time.sleep(0.5)
    return False


def main():
    parser = argparse.ArgumentParser(description="Start servers, run a command, then clean up.")
    parser.add_argument("--server", action="append", dest="servers", metavar="CMD",
                        help="Server command to start (repeatable)")
    parser.add_argument("--port", action="append", dest="ports", type=int, metavar="PORT",
                        help="Port to wait on for the corresponding --server (repeatable)")
    parser.add_argument("command", nargs=argparse.REMAINDER,
                        help="Command to run after servers are ready (after --)")

    args = parser.parse_args()

    servers = args.servers or []
    ports = args.ports or []

    if len(servers) != len(ports):
        print("Error: --server and --port must be provided in matching pairs.", file=sys.stderr)
        sys.exit(1)

    command = args.command
    if command and command[0] == "--":
        command = command[1:]
    if not command:
        print("Error: No command specified after --.", file=sys.stderr)
        sys.exit(1)

    processes = []
    try:
        for cmd, port in zip(servers, ports):
            print(f"Starting server: {cmd}")
            proc = subprocess.Popen(cmd, shell=True)
            processes.append(proc)
            print(f"Waiting for port {port}...")
            if not is_server_ready(port):
                print(f"Error: Server did not become ready on port {port} within 30s.", file=sys.stderr)
                sys.exit(1)
            print(f"Server ready on port {port}.")

        result = subprocess.run(command)
        sys.exit(result.returncode)

    finally:
        for proc in processes:
            proc.terminate()
            try:
                proc.wait(timeout=5)
            except subprocess.TimeoutExpired:
                proc.kill()


if __name__ == "__main__":
    main()
