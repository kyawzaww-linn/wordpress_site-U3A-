WordPress Neve Child Theme Development & Deployment
===================================================

Welcome to the **Neve Child Theme** developed by **Kyaw Zaww Linn**. This documentation will guide developers through the **development**, **deployment**, and **publishing workflow** of this child theme. The aim is to help maintain and extend the project, while also automating deployment to AWS.

Key Features
------------

*   **Custom Child Theme** based on the [Neve Theme](https://themeisle.com/themes/neve/).
    
*   **Color Customization**: Introduces a fresh color palette of navy blue and white.
    
*   **Header and Footer Redesign**: Custom header and footer for a modern, personalized look.
    
*   **Custom Typography and Layout**: Modified typography to match the project's branding.
    
*   **Responsive Design**: Fully responsive across mobile, tablet, and desktop.
    
*   **Automated Deployment**: Changes are automatically deployed to an AWS EC2 instance.
    

Theme Development
-----------------

### Child Theme Structure

```bash
neve-child/
├── style.css             # Custom styles for theme (colors, typography, etc.)
├── functions.php         # Enqueues parent and child styles
├── screenshot.png        # Screenshot of the child theme for WordPress

```

### Customizations

1.  **Custom Styles**:
    
    *   Modified background colors, link hover effects, and typography using style.css.
        
    *   Custom header and footer styles for a modern appearance.
        
2.  **Header/Footer Redesign**:
    
    *   Customized the layout and color scheme for both header and footer areas in style.css.
        
3.  **Typography**:
    
    *   Changed default fonts to use a mix of Roboto and Lora for headings and body text.
        
    *   Improved readability by increasing base font sizes.
        
4.  **Functions.php**:
    
    *   functions.php ensures that both the parent and child theme styles are enqueued properly.
        

Development Workflow
--------------------

Here’s how you can start contributing to the theme:

1.  bashCopy codegit clone git clone https://github.com/kyawzaww-linn/wordpress_site-U3A-.git
    
2.  **Set up your local environment**:
    
    *   You should use **Docker** for local development. A docker-compose.yml file is included to simplify the setup.
        
    *   bashCopy codedocker-compose up
        
    *   The local WordPress environment will be available at http://localhost:8000.
        
3.  bashCopy codegit checkout -b feature/my-new-feature
    
4.  **Make changes to the theme**:
    
    *   Modify style.css for visual tweaks.
        
    *   Add custom scripts or modify functionality in functions.php.
        
5.  bashCopy codegit add .git commit -m "Description of changes"
    
6.  bashCopy codegit push origin feature/my-new-feature
    
7.  **Open a pull request**:
    
    *   Go to the GitHub repository and open a pull request to merge your changes into the main branch.
        

Deployment
----------

The project uses **AWS EC2** for hosting the production site. All changes pushed to the main branch are automatically deployed to the EC2 instance using **GitHub Actions** and **AWS Systems Manager (SSM)**. Here’s how you can deploy updates or set up the deployment workflow.

### Automated Deployment Steps:

1.  **Trigger the GitHub Actions workflow**:
    
    *   When changes are pushed to the main branch, GitHub Actions automatically initiates the deployment process.
        
2.  **GitHub Actions Workflow**:
    
    *   The GitHub Actions workflow uses **AWS CLI** to send commands via **SSM** to the EC2 instance.
        
    *   The EC2 instance pulls the latest changes from the GitHub repository and applies them to the WordPress site.
        
    *   Apache is restarted to ensure the changes are reflected immediately.
        

### Manual Deployment (if necessary):

1.  bashCopy codessh -i /path-to-your-key.pem ec2-user@your-ec2-public-ip
    
2.  bashCopy codecd /var/www/html/wp-content/themes/neve-child/
    
3.  bashCopy codegit pull origin main
    
4.  bashCopy codesudo systemctl restart apache2
    

Workflow Details
----------------

### GitHub Actions Workflow

The project uses a **GitHub Actions** workflow to automate deployments. Here’s a high-level overview of the process:

1.  **Trigger**: The workflow is triggered by any changes pushed to the main branch.
    
2.  **Installation**: The workflow installs the **AWS CLI** on the GitHub runner.
    
3.  **Command Execution**: It then uses **SSM** to send commands to the EC2 instance.
    
4.  **Theme Update**: The EC2 instance pulls the latest code from the GitHub repository and restarts Apache.
    

Conclusion
----------

This project automates the deployment of the Neve child theme, making it easier for developers to contribute and release updates. For any questions or issues, feel free to reach out to **kyawzawwlinn**@my.jcu.edu.au
