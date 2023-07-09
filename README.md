<p align="center"><h1>Send Money API</h1></p>

## Setup Instruction
- Clone repo <code>git clone https://github.com/jerviepaul/send-money-api.git</code>.
- Go to send-money-api folder <code>cd send-money-api</code>.
- Run <code>composer install</code>. If you don't have composer on your system, go to this [site](https://getcomposer.org/download/) for setup instructions.
- Copy .env.example to .env <code>cp .env.example .env</code>.
- Create database <code>send_money_api</code>, user and set password if necessary.
- Update the .env file and set your DB_DATABASE, DB_USERNAME AND DB_PASSWORD values then save.
- Generate app key. <code>php artisan key:generate</code>
- Run migrations. <code>php artisan migrate</code>
- Seed the database. <code>php artisan db:seed</code>
- Generate passport keys. <code>php artisan passport:keys</code>. For now just press enter when asked what to name the client.
- Generate passport client. <code>php artisan passport:client --client</code>. For now just press enter when asked what to name the client.
- Generate passport personal. <code>php artisan passport:client --personal</code>. For now just press enter when asked what to name the client.
- Run the server. <code>php artisan serve</code>
- Access the local instance at http://localhost:8000/api through a browser or API testing tools like [Postman](https://www.postman.com/downloads/) or [Insomnia](https://insomnia.rest/download)
