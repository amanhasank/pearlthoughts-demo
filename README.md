markdown
Copy
Edit
# 🚀 Yii2 Docker Swarm Deployment

This repository provides the complete infrastructure and CI/CD setup to deploy a Yii2 PHP application using **Docker Swarm**, **Ansible**, and **GitHub Actions** on an **EC2 instance**.

---

## 📦 Features

- Containerized Yii2 app using `schmunk42/yii2-app-basic`
- Deployment via Docker Swarm on EC2
- GitHub Actions for CI/CD pipeline
- Nginx reverse proxy with optional SSL
- Infrastructure configuration using Ansible roles
- Health checks and rollback support

---

## ✅ Prerequisites

- A GitHub repository with your Yii2 application code
- An Ubuntu-based EC2 instance (with Docker installed)
- GitHub repository secrets configured for SSH access

---

## 📁 Project Structure

```text
ansible/
├── playbook.yaml
└── roles/
    ├── common/     # System updates & basic utilities
    ├── docker/     # Docker & Swarm setup
    ├── nginx/      # Nginx config & SSL
    └── deploy/     # App deployment steps

.github/
└── workflows/
    └── deploy.yml  # GitHub Actions workflow
🔐 GitHub Secrets Configuration
In your GitHub repository, navigate to:

Settings > Secrets and variables > Actions and add:

EC2_SSH_KEY — contents of your EC2 .pem private key file

Also, ensure:

Settings > Actions > General > Workflow permissions:

✅ Select Read and write permissions

🚀 Deployment Steps
1. Push Code to GitHub
Pushing to the main branch will trigger the GitHub Actions workflow to build and deploy your app.

2. Monitor GitHub Actions
Go to the Actions tab in GitHub

Check the workflow run

It should:

Build a Docker image

Push it to GitHub Container Registry (GHCR)

SSH into EC2 and deploy via Docker Swarm

🔎 Verifying EC2 Deployment
SSH into your EC2 instance:

bash
Copy
Edit
ssh -i demo-pearlthoughts.pem ubuntu@<EC2_PUBLIC_IP>
Check Docker deployment:

bash
Copy
Edit
docker service ls
docker service logs yii2_yii2
docker ps
curl http://localhost
Then, visit:

cpp
Copy
Edit
http://<EC2_PUBLIC_IP>
🔁 Updating the App
Commit and push new code to the main branch

CI/CD pipeline automatically:

Builds new Docker image

Pushes to GHCR

Updates deployment via docker stack deploy

🧯 Rollback to Previous Version
bash
Copy
Edit
# SSH into EC2 instance
ssh -i demo-pearlthoughts.pem ubuntu@<EC2_PUBLIC_IP>

# Change to the deployment directory
cd /opt/yii2-app

# Update the image tag to a previous version
sed -i "s|image:.*|image: ghcr.io/your-username/your-repo:<previous-tag>|" docker-stack.yml

# Redeploy the stack
docker stack deploy -c docker-stack.yml yii2
🛠 Running Ansible Roles Individually
bash
Copy
Edit
ansible-playbook playbook.yaml --tags common
ansible-playbook playbook.yaml --tags docker
ansible-playbook playbook.yaml --tags nginx
ansible-playbook playbook.yaml --tags deploy
❗ Troubleshooting
Container Not Starting?
bash
Copy
Edit
docker service logs yii2_yii2
docker ps
docker logs <container_id>
Application Not Accessible?
Check if the Docker service is running

Validate port exposure (docker service inspect yii2_yii2)

Verify EC2 security group allows HTTP (port 80)

GitHub Actions Failing?
Open the Actions tab in your GitHub repo

Check logs and secret configuration

Ensure EC2 is reachable and SSH key is valid

🧼 Maintenance
To update the app:
Push to main → triggers redeploy automatically.

To rollback:
Manually change Docker image tag as shown above and re-run deployment.

