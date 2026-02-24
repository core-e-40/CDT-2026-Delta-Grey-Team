CDT Team Delta - Vulnerable Samba Deployment

---

## Overview

This repo is an Ansible-based deployment of a vulnerable Samba file server affected by CVE-2017-7494, a critical remote code execution vulnerability. This will hopefully be deployed for team Delta during the Grey Team phase.

---

## Vulnerability Description

CVE-2017-7494 is a critical vulnerability in Samba versions 3.5.0 through 4.6.4 that allows a remote attacker to execute arbitrary code by uploading a malicious shared object (`.so`) file to a writable SMB share and forcing the Samba service to load it. Successful exploitation typically results in root-level command execution.

---

## Prerequisites

- Target OS: Ubuntu 22.04
- Ansible Version: 2.12+
- Python: Python 3.x on control machine
- Network Requirements:
  - TCP port 445 reachable from attacker network
  - SSH access to target host

---

## Quick Start

```bash
git clone https://github.com/Zanex360/cdt-vulnsamba-deploy
cd cdt-vulnsamba-deploy
ansible-playbook -i inventory.ini playbook.yml
```

After deployment, the Samba service will be accessible over TCP 445 and intentionally exploitable via CVE-2017-7494.

---

## Documentation

- Deployment Guide  
  [`deployment_documentation.md`](deployment_documentation.md)

- Exploitation Guide
  [`exploit_documentation.md`](exploit_documentation.md)
  
---

## Competition Use Cases

Red Team:
Competitors can practice SMB enumeration, identify insecure writable shares, and exploit CVE-2017-7494 to gain remote code execution and full system compromise.

Blue Team:
Defenders can monitor Samba logs, analyze SMB traffic, and develop detection and mitigation strategies for malicious file uploads and abnormal service behavior.

Grey Team:
This project provides a vulnerable service for competition infrastructure along with documentation regarding the service. 

---

## Technical Details

The Ansible playbook performs the following high-level tasks:

- Installs required system dependencies
- Extracts and compiles Samba 4.5.9 from source
- Installs Samba to `/opt/samba-4.5.9`
- Deploys an intentionally insecure `smb.conf`
- Creates and starts a systemd service for the vulnerable Samba instance

---

## Repository Structure

```
cdt-vulnsamba-deploy/
├── playbook.yml
├── inventory.ini
├── vars/main.yml
├── roles/
│   └── samba/
│       ├── tasks/
│       │   ├── main.yml
│       │   ├── deps.yml
│       │   ├── build.yml
│       │   ├── configure.yml
│       │   └── service.yml
│       ├── handlers/
│       │   └── main.yml
│       └── templates/
│           └── smb.conf.j2
├── files/
│   └── samba-4.5.9.tar.gz
├── screenshots/
├── deployment_documentation.md
├── exploit_documentation.md
├── .gitignore
└── README.md
```

---

## Troubleshooting

- Samba not reachable: Ensure no system Samba service is conflicting and that TCP 445 is allowed through the firewall
- Build errors: Verify required development dependencies are installed and compatible with Samba 4.5.9
- Cannot access shares: Confirm guest access and permissions in `smb.conf`

---
