# CSI300-Twitter-Remake
For our class final, we were instructed to make a simple remake of Twitter with a newly designed MySQL database. Each student is at liberty to decide how the web-facing side of the application is built. Uses Laravel PHP framework.

---

## Author: Gale Proulx
## Due Date: April 27, 2020

# Install Instructions

### Setting Up a Local Testing Environment

Purpose: in order to write the program you need to simulate what the production environment will be like. This local testing environment will be contained to a single computer allowing you to utilize Apache, MySQL, and the Laravel PHP Framework to function without a server. (I will assume you are using a machine running Windows 10 for this tutorial.)

**1.) Download Git Bash**

Purpose: GitHub allows you to download this repository and help contribute to the code base without accidentally writing over another's work. This Terminal will allow you to interact with the repository and run Laravel commands that you will need later on.

- Go to https://git-scm.com/downloads and download the windows version of the Git Bash Terminal.

- Accept the defaults for the installation.

- When you have finished you check if the installation was successful by opening up a File Explorer window. Right click where there is not a file and you should now see a new option that says "Git Bash Here."

**2.) Setting Up the Project Folder**

Purpose: find out where the project folder is and what file contains the code.

- Unzip the uploaded project folder. It will contain two files and a folder. The folder
that contains all the code for this project is in dms_twitter_final.

**3.) Installing XAMPP**

Purpose: The Vermont Marathon DMS program uses MySQL and Apache and PHP to work. This means we need to install all these software. XAMPP is a package including all that we need. It'll help manage our local database environments.

- Go to this link https://www.apachefriends.org/index.html and download and install XAMPP for the appropriate OS. (Make sure you accept the defaults. XAMPP should install on the root of the C drive. If it doesn't, change it do install on the C: drive.)

- When starting up XAMPP you will see the control panel. Click start for Apache and MySQL. Both should start up without a problem. NOTE: if you are getting an error about a port being blocked, you need to change the port that the apache server is trying to use. To do this, hit the 'config' button near the start button and select "Apache (httpd-ssl.conf)". Once you have opened the file, look on line 36, it will have the text "listen 443". You must change the number 443 to a number of a port that is not currently being used by another service; I am using port 8080, but typically most ports above 1024 should be free.

- Now we need to point Apache to the public directory of our program. Go to the XAMPP control panel again and click Config on the Apache row, and hit Apache (httpd.conf). This will open up the configuration file. Press ```Ctrl + f``` and search for ```Document Root```. You should see two lines that look similar to the ones below. Change those default directories to the path that leads to your programs public folder. Examples are below. (Note: file explorer shows the directory next to the search bar. Clicking in an empty space in the directory track bar will show you the directory which you can copy.)
```
    DocumentRoot "C:\xampp\apache"
    <Directory "C:\xampp\apache">
    ---------------- CHANGE TO YOUR PUBLIC FOLDER ----------------
    DocumentRoot "C:\Users\Frank\Desktop\Laravel\dms_twitter_final\public"
    <Directory "C:\Users\Frank\Desktop\Laravel\dms_twitter_final\public">
```

**4.) Installing Composer**

Purpose: Composer is an essential part to get Laravel working. You will need to install this to get Laravel working.


- Download the Composer installer from the link below. There is a direct link to the installation file for Windows for convience. MAC installation is different, directions of which are on the website. Website Directions: https://getcomposer.org/doc/00-intro.md Windows Installation: https://getcomposer.org/Composer-Setup.exe For Windows machines, run Composer-Setup.exe and install on php.exe. The directory location is below if you can't find it.
    ```
        C:\xampp\php\php.exe
    ```

- Go back to your Git Bash (make sure you are in the right directory, use ```pwd``` to see your current directory) and run ```composer install```. Composer should now be installed! Run ```composer -v``` just to be sure. You should some terminal art like the one below if it installed correctly.

    ```
            ______
          / ____/___  ____ ___  ____  ____  ________  _____
         / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
        / /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
        \____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
    ```

- Congrats, you installed Composer! Now a local database needs to be set up. Without a database you can't test your code.

**5.) Setting Up the Database.**

Purpose: This program talks to a database, which currently doesn't exist. First we will make the database on MySQL and in the next step we will migrate the database.

- Open XAMPP and start Apache and MySQL if they are not already started.

- Click Admin under MySQL actions. You have now opened up phpMyAdmin. This is how you will manage your database and create it.

- Click New on the left side of the screen and enter the database name ```twitter_db```. Then click create.

- On the top you should see multiple tabs. Click privileges and create a new account (under 'Add User Account'.)

- Fill in the user name with ```gale``` and password with ```'#CSI300_forlife#'```. The hostname should be 127.0.0.1. Make sure under 'Global privileges' you check off the 'Check all' box.

- Click the inconspicuous 'Go' button on the bottom right of the screen.

- Now you should have a user account under the 'User accounts tab that has all privileges.

- You may have noticed I gave you the username and password. This is because the .env file was uploaded with this program. Normally env files are kept off the internet, as they store passwords and usernames in plain text which is never a good idea. For this program it is okay, as it will only ever run locally at a very specific time in a very specific place. Under normal circumstances, you would make your own username and password to put into your own .env file.

**6.) Run MySQL Scripts and add Authentication tables.**

Purpose: now we need to construct the database and push a couple tables from Laravel.

- Open your Git Bash again (making sure you are in the main directory of your program, not in any subfolders/subdirectories) and run ```composer require laravel/ui``` and ```php artisan ui vue --auth```. If everything was successful the Git Bash should have run a bunch of text and said it was successful at the end!

**7.) Checkout**

Purpose: everything is working, let us double check!

- Open the XAMPP control panel and click Admin on the MySQL line. This should open up phpMyAdmin. This is a Graphical User Interface (GUI) that allows you to see the database you made in step five. If you click on 'twitter_db' you should now see a bunch of tables listed. This is where our information will be stored.

- Next open up a web browser and type in 127.0.0.1. Now you should see the main page of our program! If you do, you are all set to test and code!
