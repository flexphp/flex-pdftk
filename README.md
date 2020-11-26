# API Web Pdftk

## Installation

Install the package with Composer:

```bash
composer require flexphp/pdftk
```

### Environment

```bash
cp -p .env.example .env
vim .env
```

### Permissions

```bash
chgrp www-data -Rf var
chmod 770 -Rf var
```

### Vhost

```bash
Alias / "/var/www/html/public/"
<Directory "/var/www/html/public">
    Options -Indexes +FollowSymLinks +MultiViews
    AllowOverride None
    Require all granted
    ErrorDocument 404 /

    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteOptions Inherit

        RewriteBase /
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^ index.php [QSA,L]
    </IfModule>
</Directory>
```

## License

Schema is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
