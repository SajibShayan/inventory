# inventory


```bash
# clone
git clone

#copy the .env.example content and make a .env file

#install composer 
composer install

#install npm 
npm install 
npm install --force

#generate app key 
php artisan key:generate

#run the command 
./vendor/bin/sail up -d

#migrate the database
./vendor/bin/sail artisan migrate:fresh

#for the root permission run this command in the terminal of docker laravel.test container 
chown -R sail:sail storage

#run this command in frontend 
npm run dev

#got to the login page

#run this if faced permission issues for log file 
chmod -R 775 storage

#run this pluclic storage
php artisan storage:link

```