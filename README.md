<p align="center"><h1>Send Money API</h1></p>

#### PHP Version: 8.2.7
#### Laravel Version: 10
#### Composer Version: 2.5.8

## Setup Instruction
- Clone repo.
```bash
git clone https://github.com/jerviepaul/send-money-api.git
```
- Go to send-money-api folder.
```bash
cd send-money-api
```
- Install via [composer](https://getcomposer.org/download/).
```bash
composer install
```
- Copy .env.example to .env.
```bash
cp .env.example .env
```
- Update the <code>.env</code> file and set your DB_USERNAME AND DB_PASSWORD values then save.
- Generate app key.
```bash
php artisan key:generate
```
- Run migrations. If asked to create the database, enter YES.
```bash
php artisan migrate
```
- Seed the database.
```bash
php artisan db:seed
```
- Generate passport keys.
```bash
php artisan passport:keys
```
- Generate passport client. For now just press enter when asked what to name the client.
```bash
php artisan passport:client --client
```
- Generate passport personal. For now just press enter when asked what to name the client.
```bash
php artisan passport:client --personal
```
- Run the server.
```bash
php artisan serve
```
- Access the local instance at http://localhost:8000/api through a browser or API testing tools like [Postman](https://www.postman.com/downloads/) or [Insomnia](https://insomnia.rest/download).

## Database migrations and seed for Sqlite used for Test

  ```bash
  php artisan migrate --database=sqlite
  ```
  ```bash
  php artisan db:seed --database=sqlite
  ```