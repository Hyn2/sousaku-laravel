<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 로컬에서 실행하기

1. 레포지토리 클론
```shell
    git clone https://github.com/Hyn2/sousaku-laravel.git
```

2.  `.env.example` 파일명을 `.env`로 변경


3. `.env`를 열어 `FILESYSTEM_DISK=local` 부분을  `FILESYSTEM_DISK=public`으로 변경


4. 명령어 실행
```
php artisan serve
npm run dev
```

5. http://localhost:8000 으로 접속



