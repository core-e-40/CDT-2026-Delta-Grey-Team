# Deployment Documentation — Vulnerable Samba (CVE-2017-7494)

---

## 1. Prerequisites

### Target System
- Operating System: Ubuntu 22.04 LTS Desktop
- Architecture: x86_64
- Network:
  - TCP 445 reachable from attacker network
  - No firewall blocking SMB traffic

### Control Machine (Ansible)
- OS: Linux (Ubuntu recommended)
- Ansible Version: 2.12+
- Python: Python 3.x
- Required Packages:
  - `ansible`
  - `ssh`

### Manual Pre-Setup
- SSH access from Ansible control node to target host
- SSH key-based authentication recommended
- Samba 4.5.9 source archive available (`samba-4.5.9.tar.gz`)

---

## 2. Installation & Configuration

### Step 1: Inventory Configuration

Edit `inventory.ini`:

```ini
[samba]
samba-srv ansible_host=<TARGET_IP> ansible_user=<USERNAME> ansible_password=<PASSWORD>
```

---

### Step 2: Run the Ansible Playbook

Execute from the project root:

```bash
ansible-playbook -i inventory.ini playbook.yml
```

Expected behavior:
- System dependencies installed
- Samba source extracted and compiled
- Vulnerable configuration deployed
- Samba service started

---

### Step 3: Samba Build & Installation

The playbook performs the following actions:
- Installs legacy build dependencies
- Configures Samba without AD DC support
- Installs Samba to `/opt/samba-4.5.9`

Build verification:

```bash
/opt/samba-4.5.9/sbin/smbd -V
```

Expected output:
```
Version 4.5.9
```

---

### Step 4: Samba Configuration

Key insecure settings applied:
- Writable guest share enabled
- No authentication required
- SMB service bound to all interfaces

Configuration file location:
```
/opt/samba-4.5.9/etc/smb.conf
```

---

### Step 5: Start and Enable Samba

Samba is launched using a systemd service created by Ansible:

```bash
systemctl status samba-vuln
```

Expected result:
- Service is active (running)

---

## 3. Verification Steps

### Service Verification

Confirm SMB port is listening:

```bash
ss -tulnp | grep 445
```

---

### Network Verification (From Attacker Machine)

```bash
nmap -p 445 <TARGET_IP>
```

Expected result:
- Port 445 open
- Samba service detected

---

### Share Access Verification

```bash
smbclient -L //<TARGET_IP>/ -N
```

Expected result:
- Writable guest share visible

---

## 4. Troubleshooting

### Common Issues

#### Samba Fails to Start
- Check logs:
  ```bash
  /opt/samba-4.5.9/var/log.smbd
  ```
- Ensure no conflicting system Samba service is running

#### Build Errors
- Verify legacy Python compatibility
- Ensure required development libraries are installed

#### Cannot Access Share
- Confirm permissions on share directory
- Verify firewall allows TCP 445

---

## 5. Expected Final State

After successful deployment:
- Vulnerable Samba 4.5.9 running
- Writable guest SMB share exposed
- System exploitable via CVE-2017-7494

---
