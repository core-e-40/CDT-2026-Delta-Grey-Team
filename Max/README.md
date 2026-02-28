# Ansible-Vulnerable-Deployments

# Project Overview
This Ansible playbook deploys an intentionally vulnerable FTP and web server environment on
the target host group nginxftp. It automates the installation, configuration, and startup of an FTP
service (vsftpd) and a web server stack (Apache with PHP), while deliberately weakening
security controls to create a realistic exploitation lab.
The playbook is designed for cybersecurity education and competitions, allowing participants to
demonstrate attack chaining across services—from unauthenticated access and file uploads to
web-based code execution and privilege pivoting.

# Services
- vsftpd (insecure configuration)
- apache2

<img width="771" height="688" alt="image" src="https://github.com/user-attachments/assets/17aca1ab-21d6-411c-8559-922ba5e688c4" />


# Vulnerabilities
- Anonymous FTP enabled
- Writable webroot directories
- Weak FTP credentials
- No chroot enforcement
- Clear-text authentication
- PHP execution
- OS Command Injection
- /etc/passwd exposed

# Usage
- sudo apt update
- sudo apt install -y sshpass ansible-core
- ./setup-ssh.sh
- ansible-playbook -i inventory.ini playbook.yml
- ansible-playbook -i inventory.ini validate.yml
