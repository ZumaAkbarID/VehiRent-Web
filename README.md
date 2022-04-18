
## Installation

1. Clone repository ini

    ```bash
    git clone https://github.com/ZumaAkbarID/VehiRent-Web.git
    ```
    Atau Download di Dropdown Code warna hijau

2. Install composer package

    ```bash
    composer install
    ```
    
3. Copy .env.example ke .env

    ```bash
    cp .env.example .env
    ```

4. Konfigurasikan database pada file `.env`

5. Lakukan migrasi dan seeding untuk data dummy

    ```bash
    php artisan migrate
    ```
6. Jalankan aplikasi

    ```bash
    php artisan serve
    ```
    Jangan lupa aktifkan Apache & MySql

6. Add data menggunakan Postman
