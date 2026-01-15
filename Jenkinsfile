pipeline {
    agent {
        docker {
            // We use a custom image or a standard one with adjustments.
            // Using a standard Node image and installing PHP, or Vice Versa.
            // Here we define a custom Dockerfile to build an environment with both PHP and Node/Vercel.
            image 'custom-jenkins-agent'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
            // NOTE: You must build this image locally or host it on a registry.
            // See Dockerfile.jenkins in the project root.
        }
    }

    environment {
        // You must set VERCEL_TOKEN and VERCEL_ORG_ID / VERCEL_PROJECT_ID in Jenkins Credentials
        VERCEL_TOKEN = credentials('vercel-token')
        VERCEL_ORG_ID = credentials('vercel-org-id')
        VERCEL_PROJECT_ID = credentials('vercel-project-id')
    }

    stages {
        stage('Install Dependencies') {
            steps {
                sh 'composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Test') {
            steps {
                // Run tests using PHPUnit/Pest
                sh './vendor/bin/pest' 
            }
        }

        stage('Deploy to Vercel') {
            steps {
                // Pull Vercel environment information
                sh 'npx vercel pull --yes --environment=production --token=$VERCEL_TOKEN'
                
                // Build the project artifacts
                sh 'npx vercel build --prod --token=$VERCEL_TOKEN'
                
                // Deploy artifacts to Vercel
                sh 'npx vercel deploy --prebuilt --prod --token=$VERCEL_TOKEN'
            }
        }
    }
}
