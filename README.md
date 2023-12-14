<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 도커로 실행하기

- 아래는 도커가 설치된 환경이라 가정합니다.

1. Repository의 `docker-compose.yml`을 로컬에 복사
2. 터미널에서 `docker compose up` 실행 
3. http://localhost:80 으로 접속

## 기술
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind](https://img.shields.io/badge/tailwind-06B6D4.svg?style=for-the-badge&logo=tailwindcss&logoColor=white)
![S3](https://img.shields.io/badge/amazon%20s3-569A31.svg?style=for-the-badge&logo=amazons3&logoColor=white)
![S3](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![EC2](https://img.shields.io/badge/amazon%20ec2-ff9900.svg?style=for-the-badge&logo=amazonec2&logoColor=white)
![DOCKER](https://img.shields.io/badge/docker-2496ED.svg?style=for-the-badge&logo=docker&logoColor=white)
![NGINX](https://img.shields.io/badge/nginx-009639.svg?style=for-the-badge&logo=nginx&logoColor=white)

- EC2에 Mysql을 설치하여 DB를 운영합니다.
- 게시글 작성 시 S3를 이용하여 이미지를 저장했습니다.
- NGINX와 PHP-FPM 이미지를 기반으로 빌드하였습니다.
