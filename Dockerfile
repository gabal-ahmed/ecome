FROM php:8.1-apache

# نسخ ملفات المشروع إلى السيرفر
COPY . /var/www/html/

# تفعيل Apache rewrite module لو محتاجه
RUN a2enmod rewrite

# إعداد صلاحيات المجلد
RUN chown -R www-data:www-data /var/www/html
