# UpworkJobAlerts

A simple script to automatically fetch and notify about new Upwork jobs from an RSS feed. Ideal for developers and freelancers to stay updated with the latest job postings.

## What the script does

- Fetches the latest job postings from a specified Upwork RSS feed.
- Compares the fetched jobs with the ones from the last check.
- Sends an email alert with the details of the new jobs.

## Prerequisites

- PHP environment
- [Composer](https://getcomposer.org/download/) (to install dependencies)

## Setup

1. **Clone or download this repository to your local machine.**
    ```bash
    git clone https://github.com/oldravian/upwork-job-alerts.git
    ```

2. **Navigate to the project directory.**
    ```bash
    cd upwork-job-alerts
    ```

3. **Install the required dependencies using Composer.**
    ```bash
    composer install
    ```

4. **Configure your email settings in the mailer.php script to ensure you can send and receive email alerts.** The script uses the PHPMailer library for this.

## Customization

- To fetch jobs from a different Upwork category or filter, modify the RSS feed URL in the script.
- Customize your search criteria on Upwork and get your RSS feed URL to put in the script
  ![image](https://github.com/oldravian/upwork-job-alerts/assets/33361064/8e11a9a0-a187-4533-a319-01b97c34f0e0)

- Provide the recipient email in alert.php script.

## Scheduling the Script

To ensure the script runs automatically at regular intervals (e.g., every two minutes), you can set up a cron job:

1. **Open your crontab with the command:**
    ```bash
    crontab -e
    ```

2. **Add the following line to run the script every two minutes (modify the path to match your setup):**
    ```bash
    */2 * * * * /usr/bin/php /var/www/html/upwork-job-alerts/alert.php
    ```

3. Save and exit.

> Remember to adjust the path and the frequency as per your needs.
