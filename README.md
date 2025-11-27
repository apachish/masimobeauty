# Covan - Cosmetics & Beauty Website (Laravel + Livewire)

پروژه Covan یک وب‌سایت فروشگاه آنلاین لوازم آرایشی و بهداشتی است که با Laravel و Livewire ساخته شده است.

## ویژگی‌ها

- ✅ استفاده از Livewire برای کامپوننت‌های داینامیک
- ✅ کامپوننت‌های قابل استفاده مجدد
- ✅ بدون نیاز به JavaScript اضافی
- ✅ طراحی Responsive

## نصب و راه‌اندازی

### پیش‌نیازها
- PHP >= 8.1
- Composer
- MySQL یا SQLite

### مراحل نصب

1. **نصب وابستگی‌ها:**
```bash
composer install
```

2. **کپی فایل تنظیمات:**
```bash
cp .env.example .env
```

3. **تولید کلید اپلیکیشن:**
```bash
php artisan key:generate
```

4. **تنظیم دیتابیس:**
فایل `.env` را باز کرده و تنظیمات دیتابیس را تغییر دهید:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=covan
DB_USERNAME=root
DB_PASSWORD=
```

5. **اجرای Migration:**
```bash
php artisan migrate
```

6. **اجرای سرور:**
```bash
php artisan serve
```

سپس به آدرس `http://localhost:8000` بروید.

## ساختار پروژه

```
covan-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── HomeController.php
│   └── Livewire/
│       ├── TopBar.php
│       ├── Header.php
│       ├── Hero.php
│       ├── About.php
│       ├── Categories.php
│       ├── NewArrivals.php
│       ├── CollectionOrganic.php
│       ├── BeautyFoundation.php
│       ├── BestSeller.php
│       ├── Features.php
│       ├── Newsletter.php
│       ├── Partners.php
│       └── Footer.php
├── public/
│   └── css/
│       └── style.css
├── resources/
│   └── views/
│       ├── home.blade.php
│       └── livewire/
│           ├── top-bar.blade.php
│           ├── header.blade.php
│           ├── hero.blade.php
│           ├── about.blade.php
│           ├── categories.blade.php
│           ├── new-arrivals.blade.php
│           ├── collection-organic.blade.php
│           ├── beauty-foundation.blade.php
│           ├── best-seller.blade.php
│           ├── features.blade.php
│           ├── newsletter.blade.php
│           ├── partners.blade.php
│           └── footer.blade.php
└── routes/
    └── web.php
```

## کامپوننت‌های Livewire

پروژه شامل کامپوننت‌های زیر است:

1. **TopBar** - نوار بالای صفحه با لینک‌های اجتماعی
2. **Header** - هدر اصلی با منوی ناوبری
3. **Hero** - بخش Hero با نمایش محصولات
4. **About** - بخش درباره ما
5. **Categories** - دسته‌بندی محصولات
6. **NewArrivals** - محصولات جدید (با قابلیت Carousel)
7. **CollectionOrganic** - مجموعه ارگانیک
8. **BeautyFoundation** - بخش Beauty Foundation
9. **BestSeller** - پرفروش‌ترین محصولات (با قابلیت Carousel)
10. **Features** - ویژگی‌های سایت
11. **Newsletter** - فرم عضویت در خبرنامه (با قابلیت Submit)
12. **Partners** - لوگوی شرکای تجاری
13. **Footer** - فوتر سایت

## استفاده از کامپوننت‌ها

در Blade template می‌توانید از کامپوننت‌ها استفاده کنید:

```blade
@livewire('top-bar')
@livewire('header')
@livewire('hero')
```

یا در PHP:

```php
<livewire:top-bar />
<livewire:header />
<livewire:hero />
```

## استفاده

پس از راه‌اندازی سرور، می‌توانید به آدرس `http://localhost:8000` مراجعه کنید.

## توسعه

برای توسعه بیشتر می‌توانید:
- Controller های جدید اضافه کنید
- Model ها و Migration ها ایجاد کنید
- Route های جدید تعریف کنید
- View های جدید بسازید

## مجوز

این پروژه برای استفاده شخصی و تجاری آزاد است.
