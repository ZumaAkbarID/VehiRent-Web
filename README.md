<img src="https://1.bp.blogspot.com/-5-diQBxI_X8/XecNF-3mqHI/AAAAAAAAAEQ/Y0mgjoK7W2I7cNppWpIoXMND32oqknMQACEwYBhgL/s1600/3.jpg" alt="Kang Adit" style="zoom:50%;" />

## Installation

1. Clone repository ini

    ```bash
    git clone https://github.com/ZumaAkbarID/VehiRent-Web.git / Atau
    ```

2. Copy .env.example ke .env

    ```bash
    cp .env.example .env
    ```

3. Konfigurasikan database pada file `.env`

4. Lakukan migrasi dan seeding untuk data dummy

    ```bash
    php artisan migrate
    ```
5. Jalankan aplikasi

    ```bash
    php artisan serve
    ```
    Jangan lupa aktifkan Apache & MySql

6. Add data menggunakan Postman
