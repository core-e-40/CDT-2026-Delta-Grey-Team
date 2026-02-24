# AnsibleVulnerableServiceDeployment
## Overview
### This Ansible project deploys a vulnerable WordPress environment on a Ubuntu system. The deployment runs on a Linux machine and contains an Apache server, MySQL database and a PHP script file. This infrastructure creates a remote code execution vulnerability that can easily be exploited.

## Vulnerability Description
### The vulnerability in this project is a remote code execution vulnerability and is contained within the file "vulnerable_app.php". To exploit this vulnerability, cURL commands can be run that contains other commands within it after a semicolon (%3B) is placed before it in the URL.

## Prerequisites
* **2 Ubuntu 22.04 Boxes with SSH connections**
* **Ansible 2.9+ Installed**

## Quick Start
### Run these commands once Ansible has been installed:
<pre>
ansible-playbook -i inventory.ini playbook.yml
ssh cyberrange@[ANSIBLE-VULN-SERVER-IP] "systemctl status apache2 && systemctl status mysql"
curl -I http://[ANSIBLE-VULN-SERVER-IP]/vulnerable_app.php
</pre>

## Documentation
### [Deployment Steps](docs/DEPLOYMENT.MD)
### [Exploitation Steps](docs/EXPLOITATION.MD)

## Competition Use Cases
### This vulnerability is a good start for beginners because it is one of the most well known and dangerous vulnerabilities for a system to have. The blue team gains experience with reading logs to find malicious commands, and the red team learns how to exploit a remote code execution vulnerability and it's dangers. This project is useful to grey team because it is easy to deploy and doesn't take much time to set up.

## Technical Details 
### The Ansible playbook does the following:
* **Installs Apache, MySQL, and PHP**
* **Creates database with user and password**
* **Clones WordPress onto the target machine and runs PHP script**
* **Sets environment permissions**

## Troubleshooting
### Make sure SSH is set up correctly and you can access both machines before installing Ansible and running the playbook. This will make sure nothing has broken.

### Ensure your inventory.ini file has the correct username and IP for the target server machine 

### Make sure to follow all steps so the project works as it should.
