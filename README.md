<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Redox Marketplace

a simple **laravel starter project** build with `tailwind flowbite` and `basic Auth User`. laravel version 11

# Developer Note

catatan developer

pastikan sudah memiliki akun `ngrok` dan flip `buisnes`.

pastikan sudah menjalankan [setup project](#setup-project) terlebih dahulu

```txt
email    : redox@market.laris
password : 123123
```

## Setup Project

-   first things

    install dependencies

    ```
    composer install
    ```

    ```
    npm install
    ```

    copy environtment project

    ```
    copy .env.example .env
    ```

    set key project

    ```
    php artisan key:generate
    ```

-   set data penting
    ```
    php artisan migrate --seed
    ```
    set storage
    ```
    php artisan storage:link
    ```
-   start project
    ```
    php artisan serve --port=80
    ```
    ```
    npm run dev
    ```
    (jika ingin ada callback pembayaran) harus ada ngrok, setelah itu ambil url generate ngrok, lalu pastekan ke flip payment API, _accept payment callback_
    ```
    ngrok http 80
    ```
-   build project (**optional**)
    ```
    npm run build
    ```

## Logger Helper

mempersingkat pembuatan logger class dengan global function, path `app/Helpers/LogHelpers.php`

-   `logDebug` log level Debug
-   `logInfo` log level Info
-   `logWarning` log level Warning
-   `logError` log level Error
-   `logCritical` log level Critical
