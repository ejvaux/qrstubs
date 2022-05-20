# Meal Allowance System
## Requirements

 - Websocket server
 - Selenium (for testing)

## Initial deployment

1. run **`composer install`**
2. Copy and rename the **.env.production** file to **.env** and modify the relevant settings
3. run **`php artisan migrate`**
4. **APP_ENV** must remain production in **.env** file and **APP_URL** must match the domain
5. setup scheduled task. run **`php artisan  schedule:work`** every **minute**

## Environment differences 
- If **Development** or **Test**, set **APP_ENV=loca**l in **.env** file
- If **Production**, set **APP_ENV=production** and **APP_DEBUG=false** in **.env** file

## Developers

 1. [Edmund Orario Mati Jr.](https://github.com/ejvaux)
2. [Lawrence Bondad](https://github.com/eenzoo12)
