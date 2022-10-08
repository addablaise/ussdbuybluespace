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
<img width="1438" alt="Screen Shot 2022-10-08 at 6 44 18 PM" src="https://user-images.githubusercontent.com/13081314/194722907-5fdcdfb0-c7fb-44e9-b1ef-9ec9642c4968.png">
<img width="1438" alt="Screen Shot 2022-10-08 at 6 44 32 PM" src="https://user-images.githubusercontent.com/13081314/194722913-472f811a-b998-4e6e-b639-a645faee62fd.png">
<img width="1438" alt="Screen Shot 2022-10-08 at 6 44 56 PM" src="https://user-images.githubusercontent.com/13081314/194722921-df47baca-c517-490e-b348-97db7bd8261d.png">
<img width="1436" alt="Screen Shot 2022-10-08 at 6 45 22 PM" src="https://user-images.githubusercontent.com/13081314/194722929-a9bc658b-a7ad-41c8-b548-2c52918c750b.png">



## API Endpoints

### Get All Phones

URL: **GET /api/phone/**

**Successful Response** 

{
    "status_code": 1,
    "message": "Phone Numbers loaded successfully!",
    "phones": [
        {
            "telco": "airteltigo",
            "phone": "0267750872",
            "status": "active"
        },
        {
            "telco": "mtn",
            "phone": "0246666677",
            "status": "blocked"
        },
        {
            "telco": "mtn",
            "phone": "0247952852",
            "status": "active"
        }
    ]
}


### Get Phone

**POST /api/phone/{phone}**

**Expected Body** 
    
    {
        phone: 0247952852
    }

**Successful Response** 

    {
        "status_code": 1,
        "message": "active"
    }

**Unsuccessful Response** 

    {
        "status_code": 0,
        "message": "No results found: 0261111112"
    }
