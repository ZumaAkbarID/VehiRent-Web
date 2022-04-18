<img src="https://1.bp.blogspot.com/-5-diQBxI_X8/XecNF-3mqHI/AAAAAAAAAEQ/Y0mgjoK7W2I7cNppWpIoXMND32oqknMQACEwYBhgL/s1600/3.jpg" alt="Kang Adit" style="zoom:50%;" />

## Installation

1. Clone repository ini

    ```bash
    git clone https://github.com/ZumaAkbarID/VehiRent-Web.git
    ```
    Atau Download di Dropdown Code warna hijau

2. Update composer package

    ```bash
    composer update
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
