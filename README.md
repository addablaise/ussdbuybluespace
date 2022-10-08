# Blue Space Africa Take-home Assignment 

## The problem: 
CompanyA is developing an application called USSDBuy that is accessible by dialing a shortcode on your phone. This application however is in development and is not yet available to the general public, as a result only whitelisted numbers can access it. Currently a developer will need to manually edit the codebase to add a new number to be whitelisted. This is not ideal. CompanyA needs your help. 

## How you can help:
Create a portal for managing access to USSDBuy. The portal should allow an admin to: 
- Add a new number and whitelist it 
- View all numbers added to the portal 
- Edit number 
- Delete number 
- Blacklist number 

Create an API endpoint that returns the number, a status code of 1 and a message of active if the number is whitelisted or it returns the number, a status code of 1 and a message of blocked if the number is blacklisted

## How to start the application
- Create a database to store application database
- Configure database in .env or in config/database.php
- Open the console and cd to project root directory
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan serve
- You can now access the application at 127.0.0.1:8000


## Default Logins
- Username: admin@example.com
- Password: admin

## Dashboard
![Screenshot 2022-10-07 at 7 26 38 PM](https://user-images.githubusercontent.com/20325487/194639010-cf7a8601-ca62-480b-898a-6595f2757c9c.png)
![Screenshot 2022-10-07 at 7 27 14 PM](https://user-images.githubusercontent.com/20325487/194639165-16bfc469-201f-4826-bcce-438f471f2dcb.png)
![Screenshot 2022-10-07 at 7 27 30 PM](https://user-images.githubusercontent.com/20325487/194639176-1141d7fd-ba8a-4abc-ba5b-41f23a2d1fab.png)


## API Endpoints

### Get All Phones

URL: **GET /api/phone/**

**Successful Response** 

    {
        "status_code": 1,
        "message": "Phone Numbers loaded successfully!",
        "phones": [
            {
                "telco": "mtn",
                "phone": "0546034490",
                "status": "blocked"
            },
            {
                "telco": "vodafone",
                "phone": "0206119718",
                "status": "active"
            },
            {
                "telco": "mtn",
                "phone": "0546034493",
                "status": "blocked"
            },
            {
                "telco": "vodafone",
                "phone": "0204229999",
                "status": "active"
            }
        ]
    }


### Get Phone

**POST /api/phone/{phone}**

**Expected Body** 
    
    {
        phone: 0206119718
    }

**Successful Response** 

    {
        "status_code": 1,
        "message": "active"
    }

**Unsuccessful Response** 

    {
        "status_code": 0,
        "message": "No results found: 020611971"
    }
