# Jenkins CI/CD Setup - Quick Start Guide

## ✅ Phase 1: Docker Image (COMPLETED)

The custom Jenkins agent Docker image has been built successfully!

**Image Details:**
- **Name:** `custom-jenkins-agent:latest`
- **PHP Version:** 8.2.30
- **Composer Version:** 2.9.3
- **Node.js Version:** 20.20.0
- **Size:** ~1.13GB

**Verification Commands:**
```bash
docker images custom-jenkins-agent
docker run --rm custom-jenkins-agent:latest php -v
docker run --rm custom-jenkins-agent:latest composer -v
docker run --rm custom-jenkins-agent:latest node -v
```

---

## 🚀 Next Steps

### Step 1: Push Docker Image to Registry (Optional but Recommended)

If your Jenkins server is on a different machine, push the image to Docker Hub:

```bash
# Login to Docker Hub
docker login

# Tag the image
docker tag custom-jenkins-agent:latest YOUR_DOCKERHUB_USERNAME/custom-jenkins-agent:latest

# Push to Docker Hub
docker push YOUR_DOCKERHUB_USERNAME/custom-jenkins-agent:latest
```

Then update `Jenkinsfile` line 7:
```groovy
image 'YOUR_DOCKERHUB_USERNAME/custom-jenkins-agent:latest'
```

### Step 2: Get Vercel Credentials

You need three credentials from Vercel:

#### A. Get Vercel Token
```bash
# Install Vercel CLI globally (if not already installed)
npm install -g vercel

# Login to Vercel
vercel login

# Create a token at: https://vercel.com/account/tokens
# Or use the CLI to get your token
```

**Manual Method:**
1. Go to https://vercel.com/account/tokens
2. Click "Create Token"
3. Name: `jenkins-ci-token`
4. Scope: Full Account
5. Copy the token (save it securely!)

#### B. Link Project and Get IDs
```bash
# Navigate to your project
cd d:\PROJECTS\Laravel-Project

# Link to Vercel (if not already linked)
vercel link

# This creates .vercel/project.json with your IDs
```

#### C. Extract IDs
```bash
# View the project.json file
cat .vercel/project.json
```

You'll see something like:
```json
{
  "orgId": "team_xxxxxxxxxxxxx",
  "projectId": "prj_xxxxxxxxxxxxx"
}
```

**Save these three values:**
- ✅ Vercel Token: `v1_xxxxxxxxxxxxx`
- ✅ Organization ID: `team_xxxxxxxxxxxxx`
- ✅ Project ID: `prj_xxxxxxxxxxxxx`

---

### Step 3: Configure Jenkins

#### A. Install Jenkins (if not already installed)

**Using Docker (Recommended for testing):**
```bash
docker run -d \
  --name jenkins \
  -p 8080:8080 -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  jenkins/jenkins:lts

# Get initial admin password
docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword
```

**Access Jenkins:**
- Open browser: http://localhost:8080
- Enter the initial admin password
- Install suggested plugins
- Create admin user

#### B. Install Required Jenkins Plugins

Go to: **Manage Jenkins** → **Manage Plugins** → **Available**

Install these plugins:
- ✅ Docker Pipeline
- ✅ Git Plugin (usually pre-installed)
- ✅ Pipeline Plugin (usually pre-installed)
- ✅ Credentials Binding Plugin (usually pre-installed)

#### C. Add Credentials to Jenkins

1. Go to: **Manage Jenkins** → **Manage Credentials**
2. Click on **(global)** domain
3. Click **Add Credentials**

**Add Credential #1 - Vercel Token:**
- Kind: `Secret text`
- Scope: `Global`
- Secret: [Paste your Vercel token]
- ID: `vercel-token`
- Description: `Vercel Deployment Token`
- Click **Create**

**Add Credential #2 - Organization ID:**
- Kind: `Secret text`
- Scope: `Global`
- Secret: [Paste your Vercel Org ID]
- ID: `vercel-org-id`
- Description: `Vercel Organization ID`
- Click **Create**

**Add Credential #3 - Project ID:**
- Kind: `Secret text`
- Scope: `Global`
- Secret: [Paste your Vercel Project ID]
- ID: `vercel-project-id`
- Description: `Vercel Project ID`
- Click **Create**

---

### Step 4: Create Jenkins Pipeline Job

1. **From Jenkins Dashboard:**
   - Click **New Item**
   - Enter name: `HealthCare-Pro-Pipeline`
   - Select: **Pipeline**
   - Click **OK**

2. **Configure the Pipeline:**

   **General Section:**
   - Description: `CI/CD Pipeline for HealthCare Pro Laravel Application`
   - ✅ GitHub project
   - Project URL: `https://github.com/Sajimithan/Laravel-Project/`

   **Build Triggers:**
   - ✅ Poll SCM
   - Schedule: `H/5 * * * *` (checks every 5 minutes)

   **Pipeline Section:**
   - Definition: `Pipeline script from SCM`
   - SCM: `Git`
   - Repository URL: `https://github.com/Sajimithan/Laravel-Project.git`
   - Branch Specifier: `*/Dev`
   - Script Path: `Jenkinsfile`

3. **Click Save**

---

### Step 5: Commit and Push Changes

```bash
# Check current status
git status

# Add all Jenkins-related files
git add Dockerfile.jenkins Jenkinsfile api/ vercel.json .dockerignore JENKINS_SETUP.md

# Commit
git commit -m "Add complete Jenkins CI/CD pipeline configuration"

# Push to repository
git push origin Dev
```

---

### Step 6: Run Your First Build

1. **Go to your pipeline:** `HealthCare-Pro-Pipeline`
2. **Click:** `Build Now`
3. **Monitor the build:**
   - Click on the build number (e.g., `#1`)
   - Click `Console Output`
   - Watch the pipeline execute

**Expected Pipeline Stages:**
1. ✅ **Install Dependencies** - Installs Composer packages
2. ✅ **Test** - Runs Pest/PHPUnit tests
3. ✅ **Deploy to Vercel** - Deploys to Vercel production

---

## 🔧 Troubleshooting

### Issue: Docker Image Not Found in Jenkins

**Solution 1:** Build on Jenkins server
```bash
# SSH into Jenkins server
ssh jenkins-server

# Navigate to project
cd /path/to/project

# Build image
docker build -f Dockerfile.jenkins -t custom-jenkins-agent:latest .
```

**Solution 2:** Use Docker Hub (recommended)
```bash
# Tag and push
docker tag custom-jenkins-agent:latest yourusername/custom-jenkins-agent:latest
docker push yourusername/custom-jenkins-agent:latest
```

Update Jenkinsfile line 7 to use your Docker Hub image.

### Issue: Pest Tests Fail

If `./vendor/bin/pest` doesn't exist, update Jenkinsfile line 33:
```groovy
sh 'php artisan test'
```

### Issue: Permission Denied on Docker Socket

```bash
# On Jenkins server
sudo chmod 666 /var/run/docker.sock

# Or add Jenkins user to docker group
sudo usermod -aG docker jenkins
sudo systemctl restart jenkins
```

### Issue: Vercel Deployment Fails

Check that:
- ✅ All three Vercel credentials are added correctly
- ✅ Credential IDs match exactly: `vercel-token`, `vercel-org-id`, `vercel-project-id`
- ✅ Vercel token has not expired
- ✅ Project is linked to Vercel

---

## 📊 Pipeline Status Checklist

- [x] **Phase 1:** Docker image built successfully
- [ ] **Phase 2:** Vercel credentials obtained
- [ ] **Phase 3:** Jenkins installed and configured
- [ ] **Phase 4:** Credentials added to Jenkins
- [ ] **Phase 5:** Pipeline job created
- [ ] **Phase 6:** Code committed and pushed
- [ ] **Phase 7:** First build executed successfully
- [ ] **Phase 8:** Application deployed to Vercel

---

## 🎯 What Happens on Each Build

1. **Trigger:** Git push to `Dev` branch or manual build
2. **Jenkins:** Detects changes and starts pipeline
3. **Docker:** Spins up custom Jenkins agent container
4. **Install:** Runs `composer install` and sets up `.env`
5. **Test:** Executes test suite with Pest/PHPUnit
6. **Build:** Prepares production artifacts
7. **Deploy:** Pushes to Vercel using CLI
8. **Verify:** Vercel builds and deploys the application
9. **Complete:** Application is live at your Vercel URL

---

## 📱 Monitoring Your Deployment

After successful deployment, you can:

1. **Check Vercel Dashboard:**
   - Go to https://vercel.com/dashboard
   - View your project deployments
   - Check build logs and performance

2. **Access Your Application:**
   - Production URL: `https://your-project.vercel.app`
   - Custom domain (if configured)

3. **View Jenkins Build History:**
   - See all past builds
   - Check success/failure rates
   - Review console outputs

---

## 🚀 Advanced Features (Optional)

### Enable GitHub Webhooks

For instant builds on push (instead of polling):

1. Go to GitHub repository settings
2. Navigate to **Webhooks** → **Add webhook**
3. Payload URL: `http://your-jenkins-url/github-webhook/`
4. Content type: `application/json`
5. Events: `Just the push event`
6. Click **Add webhook**

### Add Slack Notifications

Install Slack Notification Plugin and add to Jenkinsfile:
```groovy
post {
    success {
        slackSend(color: 'good', message: "✅ Deployment Successful!")
    }
    failure {
        slackSend(color: 'danger', message: "❌ Deployment Failed!")
    }
}
```

---

## 📚 Additional Resources

- **Full Setup Guide:** See `.agent/workflows/jenkins-setup.md`
- **Jenkins Documentation:** https://www.jenkins.io/doc/
- **Vercel CLI Docs:** https://vercel.com/docs/cli
- **Laravel Deployment:** https://laravel.com/docs/10.x/deployment

---

**Status:** Ready for Jenkins Configuration ✅

**Next Action:** Obtain Vercel credentials and configure Jenkins

**Estimated Time to Complete:** 15-20 minutes
