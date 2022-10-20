# Meal Allowance System
## Initial deployment
1. run **`composer install`**
2. Copy and rename the **.env.production** file to **.env** and modify the relevant settings
3. run **`php artisan migrate`**
4. **APP_ENV** must remain production in **.env** file and **APP_URL** must match the domain
5. setup scheduled task. run **`php artisan  schedule:work`** every **minute**
6. setup **Queue Worker** service, run **`php artisan  queue:work`**
7. setup **Websockets** service, run **`artisan websockets:serve --debug`**

## Environment differences
- For **Development** or **Test**, set **APP_ENV=local** in **.env** file
- For **Production**, set **APP_ENV=production** and **APP_DEBUG=false** in **.env** file
## Account
HR Account

 - set **APP_REGISTER=true** in **.env** file to enable user registration
 - create account with **HR** role
 - set **APP_REGISTER=false** after registration

Admin Account

 - set **ADMIN_USERNAME** in **.env** file with a username
 - the username must be a **HR** account

## Developers

 1. [Edmund Orario Mati Jr.](https://github.com/ejvaux)
2. [Lawrence Bondad](https://github.com/eenzoo12)
