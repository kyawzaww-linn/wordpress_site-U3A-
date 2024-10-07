# WordPress Neve Child Theme Development and Deployment

Welcome to the Neve Child Theme developed for U3A! This documentation is intended for developers who will continue working on the child theme and deployment process. It provides clear, step-by-step instructions on making further changes to the theme and deploying updates to the production environment.

## 1. Theme Development

### Child Theme Overview
The Neve Child Theme inherits the structure and functionality from the parent Neve theme while introducing customizations specific to the U3A project. These customizations are primarily focused on the design, layout, and content integration to align with U3A’s branding and user experience goals.

### Key Customizations
- **Color Scheme:** The child theme uses a customized navy blue (`#000080`) and white (`#FFFFFF`) color palette, deviating from the default Neve colors.
  
- **Header and Footer:**
  - The default Neve header has been customized to include U3A’s branding and relevant call-to-action buttons.
  - The footer has been updated with new links and custom text tailored to U3A’s needs.

- **Membership Form:**  
  A custom web form has been created to allow users to sign up as U3A members. The form captures essential information such as name, email, and membership type.


### How to Make Further Changes

To ensure continuity in development, here’s how to make further changes to the child theme:

#### Directory Structure
All child theme files are located in the `/neve-child/` directory.

- **style.css:** Use this file to make any CSS-related changes, including color adjustments, typography changes, or layout modifications.
- **functions.php:** Use this file to enqueue styles and scripts or to add/remove theme functionality.

#### Adding New Features
- **CSS Customizations:** For design changes, edit the `style.css` file in the child theme directory. Ensure all custom styles are placed after the parent theme’s styles for proper cascading.
- **JavaScript:** If you need to add custom JavaScript functionality, enqueue your scripts via the `functions.php` file. Ensure all scripts are properly registered and enqueued.

## 2. Testing Changes Locally
It’s essential to test all changes in your local development environment (set up with Docker) before deploying them to production.


## 2. Deployment Workflow

The deployment process for the U3A website is streamlined using GitHub Actions and AWS Systems Manager (SSM). The following steps explain how to make changes to the site, including local testing and production deployment.

### Local Development

#### Prerequisites
- **Docker:** Ensure Docker is installed and running on your machine.
- **Git:** Use Git for version control.

#### Steps for Local Development:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/kyawzaww-linn/wordpress-site-U3A.git
   cd wordpress-site-U3A
### Set up Docker
Use the following command to start your Docker containers and set up the local development environment:

```bash
docker-compose up -d
```

### Access the site
Navigate to [http://localhost:8000](http://localhost:8000) in your browser to view the local version of the site.

### Make Changes
Modify the theme files in the `/wp-content/themes/neve-child/` directory as needed. Ensure all changes are tested locally before committing.

### Commit and Push Changes
After confirming that your changes work as expected, commit and push them to the repository:

```bash
git add .
git commit -m "Describe the specific change in the imperative mood"
git push origin main
```

## Deployment to Production

The deployment process is automated using **GitHub Actions**, which pushes updates to the AWS EC2 production environment whenever changes are made to the `main` branch.

### Automated Deployment Workflow

Once changes are pushed to the `main` branch, GitHub Actions triggers the deployment process. Here’s how it works:

1. **GitHub Actions** pulls the latest code from the repository.
2. It uses **AWS Systems Manager (SSM)** to remotely connect to the EC2 instance.
3. SSM runs the necessary commands to pull the updated code onto the server and restart the web server (Apache).

### Steps for Deployment

#### Push to Main:
Ensure all changes are pushed to the `main` branch:
```bash
git push origin main
```

### Automatic Deployment:
GitHub Actions will automatically deploy the changes to production. You can monitor the status of the deployment in the **Actions** tab of your GitHub repository.

### Verify Changes:
After deployment, visit the production site and verify that the changes are live.

### Workflow File (.github/workflows/deploy.yml):
Below is the GitHub Actions workflow used for automated deployment:

```yaml
name: Deploy to EC2 via SSM

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
      # Step 1: Checkout the repository
      - name: Checkout code
        uses: actions/checkout@v2

      # Step 2: Install AWS CLI via pip
      - name: Install AWS CLI
        run: |
          sudo apt-get update
          sudo apt-get install python3-pip -y
          pip3 install awscli --upgrade --user

      # Step 3: Configure AWS credentials using GitHub Secrets
      - name: Configure AWS credentials
        run: |
          aws configure set aws_access_key_id ${{ secrets.AWS_ACCESS_KEY_ID }}
          aws configure set aws_secret_access_key ${{ secrets.AWS_SECRET_ACCESS_KEY }}
          aws configure set region ap-southeast-1

      # Step 4: Use AWS SSM to deploy code to EC2 instance
      - name: Deploy to EC2 via SSM
        run: |
          aws ssm send-command \
            --instance-ids "i-070c298d9232c0169" \
            --document-name "AWS-RunShellScript" \
            --comment "Deploying Neve Child Theme" \
            --parameters commands="cd /opt/bitnami/apps/wordpress/htdocs/wp-content/themes/neve-child
```

## Conclusion
This documentation provides clear and concise instructions for continuing the development and deployment of the Neve Child Theme for U3A. Developers should follow the steps provided to make theme modifications and deploy updates seamlessly to the production environment.

If you run into any issues, feel free to reach out to [kyawzawwlinn@my.jcu.edu.au].

Happy developing! 🚀✨

