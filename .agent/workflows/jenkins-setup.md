---
description: Complete Jenkins CI/CD Pipeline Setup for HealthCare Pro
---

# Jenkins Pipeline Setup Guide

This guide will help you set up a complete CI/CD pipeline for the HealthCare Pro Laravel application using Jenkins and Vercel.

## Prerequisites

Before starting, ensure you have:
- [ ] Jenkins server installed and running
- [ ] Docker installed on Jenkins server
- [ ] Vercel account with a project created
- [ ] Git repository access configured in Jenkins

---

## Phase 1: Build Custom Jenkins Docker Image

### Step 1: Build the Custom Docker Image

The project includes a `Dockerfile.jenkins` that creates a custom Jenkins agent with PHP 8.2 and Node.js 20.

```bash
cd d:\PROJECTS\Laravel-Project
docker build -f Dockerfile.jenkins -t custom-jenkins-agent:latest .
```

**What this does:**
- Creates a Docker image with PHP 8.2 CLI
- Installs Composer for PHP dependency management
- Installs Node.js 20 and NPM for Vercel CLI
- Sets up all required system dependencies

### Step 2: Verify the Image

```bash
docker images | grep custom-jenkins-agent
```

You should see your newly built image listed.

---

## Phase 2: Configure Vercel Credentials

### Step 3: Get Vercel Tokens

1. **Login to Vercel:**
   - Go to https://vercel.com
   - Navigate to your account settings

2. **Create a Vercel Token:**
   - Go to Settings → Tokens
   - Click "Create Token"
   - Name it: `jenkins-ci-token`
   - Copy the token (you'll only see it once!)

3. **Get Organization ID:**
   ```bash
   npx vercel login
   npx vercel link
   ```
   - Follow the prompts to link your project
   - Check `.vercel/project.json` for `orgId`

4. **Get Project ID:**
   - Same file `.vercel/project.json` contains `projectId`

### Step 4: Add Credentials to Jenkins

1. **Open Jenkins Dashboard:**
   - Navigate to: `Manage Jenkins` → `Manage Credentials`

2. **Add Vercel Token:**
   - Click on `(global)` domain
   - Click `Add Credentials`
   - Kind: `Secret text`
   - Secret: [Paste your Vercel token]
   - ID: `vercel-token`
   - Description: `Vercel Deployment Token`
   - Click `OK`

3. **Add Organization ID:**
   - Click `Add Credentials` again
   - Kind: `Secret text`
   - Secret: [Paste your Vercel Org ID]
   - ID: `vercel-org-id`
   - Description: `Vercel Organization ID`
   - Click `OK`

4. **Add Project ID:**
   - Click `Add Credentials` again
   - Kind: `Secret text`
   - Secret: [Paste your Vercel Project ID]
   - ID: `vercel-project-id`
   - Description: `Vercel Project ID`
   - Click `OK`

---

## Phase 3: Create Jenkins Pipeline Job

### Step 5: Create New Pipeline Job

1. **From Jenkins Dashboard:**
   - Click `New Item`
   - Enter name: `HealthCare-Pro-Pipeline`
   - Select: `Pipeline`
   - Click `OK`

2. **Configure General Settings:**
   - Description: `CI/CD Pipeline for HealthCare Pro Laravel Application`
   - Check: `GitHub project` (if using GitHub)
   - Project URL: `https://github.com/Sajimithan/Laravel-Project/`

3. **Configure Build Triggers:**
   - Check: `GitHub hook trigger for GITScm polling` (for automatic builds)
   - OR Check: `Poll SCM` with schedule: `H/5 * * * *` (every 5 minutes)

### Step 6: Configure Pipeline Script

1. **Pipeline Definition:**
   - Select: `Pipeline script from SCM`
   - SCM: `Git`
   - Repository URL: `https://github.com/Sajimithan/Laravel-Project.git`
   - Credentials: [Add your Git credentials if private repo]
   - Branch: `*/Dev` (or `*/main` depending on your branch)
   - Script Path: `Jenkinsfile`

2. **Click `Save`**

---

## Phase 4: Docker Configuration in Jenkins

### Step 7: Enable Docker in Jenkins

**Option A: If Jenkins is running in Docker:**

Add Docker socket mounting to your Jenkins container:
```bash
docker run -d \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -p 8080:8080 -p 50000:50000 \
  jenkins/jenkins:lts
```

**Option B: If Jenkins is running natively:**

Ensure Jenkins user has Docker permissions:
```bash
sudo usermod -aG docker jenkins
sudo systemctl restart jenkins
```

### Step 8: Install Docker Pipeline Plugin

1. Go to: `Manage Jenkins` → `Manage Plugins`
2. Click `Available` tab
3. Search for: `Docker Pipeline`
4. Check the box and click `Install without restart`

---

## Phase 5: Prepare Your Repository

### Step 9: Commit Jenkins Configuration Files

```bash
cd d:\PROJECTS\Laravel-Project
git add Dockerfile.jenkins Jenkinsfile api/ vercel.json
git commit -m "Add Jenkins CI/CD pipeline configuration"
git push origin Dev
```

### Step 10: Verify .env.example

Ensure `.env.example` has all required variables (without sensitive data):
```bash
git add .env.example
git commit -m "Update .env.example for CI/CD"
git push origin Dev
```

---

## Phase 6: Test the Pipeline

### Step 11: Trigger First Build

1. **Manual Trigger:**
   - Go to your pipeline job: `HealthCare-Pro-Pipeline`
   - Click `Build Now`

2. **Monitor Build:**
   - Click on the build number (e.g., `#1`)
   - Click `Console Output`
   - Watch the build progress

### Step 12: Verify Pipeline Stages

The pipeline should execute 3 stages:

**Stage 1: Install Dependencies**
- Runs `composer install`
- Copies `.env.example` to `.env`
- Generates application key

**Stage 2: Test**
- Runs Pest/PHPUnit tests
- Validates code quality

**Stage 3: Deploy to Vercel**
- Pulls Vercel environment
- Builds production artifacts
- Deploys to Vercel

---

## Phase 7: Troubleshooting

### Common Issues and Solutions

#### Issue 1: Docker Image Not Found
**Error:** `custom-jenkins-agent not found`

**Solution:**
```bash
# Build the image on the Jenkins server
docker build -f Dockerfile.jenkins -t custom-jenkins-agent:latest .

# Or push to Docker Hub and pull from Jenkins
docker tag custom-jenkins-agent:latest yourusername/custom-jenkins-agent:latest
docker push yourusername/custom-jenkins-agent:latest
```

Then update Jenkinsfile line 7:
```groovy
image 'yourusername/custom-jenkins-agent:latest'
```

#### Issue 2: Credentials Not Found
**Error:** `vercel-token credentials not found`

**Solution:**
- Verify credential IDs match exactly: `vercel-token`, `vercel-org-id`, `vercel-project-id`
- Check credentials are in the correct domain (global)

#### Issue 3: Pest Tests Fail
**Error:** `./vendor/bin/pest: not found`

**Solution:**
Update Jenkinsfile line 33 to:
```groovy
sh 'php artisan test'
```

#### Issue 4: Permission Denied on Docker Socket
**Error:** `permission denied while trying to connect to Docker daemon`

**Solution:**
```bash
sudo chmod 666 /var/run/docker.sock
# Or add Jenkins user to docker group
sudo usermod -aG docker jenkins
```

---

## Phase 8: Advanced Configuration (Optional)

### Step 13: Add Slack Notifications

1. Install Slack Notification Plugin in Jenkins
2. Add to Jenkinsfile after stages:

```groovy
post {
    success {
        slackSend(color: 'good', message: "Deployment Successful: ${env.JOB_NAME} #${env.BUILD_NUMBER}")
    }
    failure {
        slackSend(color: 'danger', message: "Deployment Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}")
    }
}
```

### Step 14: Add Email Notifications

Add to Jenkinsfile:
```groovy
post {
    always {
        emailext(
            subject: "Build ${currentBuild.result}: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
            body: "Check console output at ${env.BUILD_URL}",
            to: 'your-email@example.com'
        )
    }
}
```

### Step 15: Add Build Badges

Install Embeddable Build Status Plugin and add badge to README.md:
```markdown
[![Build Status](http://your-jenkins-url/buildStatus/icon?job=HealthCare-Pro-Pipeline)](http://your-jenkins-url/job/HealthCare-Pro-Pipeline/)
```

---

## Phase 9: Production Best Practices

### Step 16: Environment-Specific Deployments

Create separate pipelines for:
- **Development:** Auto-deploy on every commit to `Dev` branch
- **Staging:** Auto-deploy on merge to `staging` branch
- **Production:** Manual approval required before deployment

### Step 17: Database Migrations

Add migration stage to Jenkinsfile (before deployment):
```groovy
stage('Run Migrations') {
    steps {
        sh 'php artisan migrate --force'
    }
}
```

### Step 18: Backup Before Deployment

Add backup stage:
```groovy
stage('Backup Database') {
    steps {
        sh 'php artisan backup:run'
    }
}
```

---

## Verification Checklist

After setup, verify:

- [ ] Custom Docker image built successfully
- [ ] All Vercel credentials added to Jenkins
- [ ] Pipeline job created and configured
- [ ] Docker permissions configured
- [ ] First build runs successfully
- [ ] All 3 stages complete without errors
- [ ] Application deployed to Vercel
- [ ] Vercel deployment URL accessible
- [ ] GitHub webhook configured (optional)
- [ ] Notifications working (optional)

---

## Quick Reference Commands

### Build Docker Image
```bash
docker build -f Dockerfile.jenkins -t custom-jenkins-agent:latest .
```

### Test Docker Image Locally
```bash
docker run --rm custom-jenkins-agent:latest php -v
docker run --rm custom-jenkins-agent:latest composer -v
docker run --rm custom-jenkins-agent:latest node -v
```

### Manual Vercel Deployment
```bash
npx vercel --token=YOUR_TOKEN --prod
```

### Check Jenkins Logs
```bash
# If Jenkins is in Docker
docker logs jenkins

# If Jenkins is native
sudo journalctl -u jenkins -f
```

---

## Support Resources

- **Jenkins Documentation:** https://www.jenkins.io/doc/
- **Vercel CLI Documentation:** https://vercel.com/docs/cli
- **Laravel Deployment:** https://laravel.com/docs/10.x/deployment
- **Docker Documentation:** https://docs.docker.com/

---

## Next Steps

After successful pipeline setup:

1. **Monitor First Deployment:** Watch the entire pipeline execution
2. **Test Deployed Application:** Visit your Vercel URL and test functionality
3. **Configure Auto-Deployments:** Set up GitHub webhooks for automatic builds
4. **Add More Tests:** Expand your test suite for better coverage
5. **Implement Staging Environment:** Create a staging pipeline for pre-production testing

---

**Pipeline Status:** Ready to Configure ✅

**Estimated Setup Time:** 30-45 minutes

**Difficulty Level:** Intermediate
