# استخدام صورة PHP مع Apache
FROM php:8.2-apache
# تثبيت التبعيات
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت التبعيات باستخدام Composer
RUN composer install --no-dev --optimize-autoloader

# تعيين أذونات المجلدات
RUN chown -R www-data:www-data /var/www/html/storage

# تفعيل mod_rewrite
RUN a2enmod rewrite

# تعيين PORT الافتراضي
EXPOSE 80

# تشغيل Apache
CMD ["apache2-foreground"]