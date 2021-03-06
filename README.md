# API Web Pdftk

## Installation

Install project with git:

```bash
git clone git@github.com:flexphp/flex-pdftk.git api-pdftk
```

### Environment

```bash
cp -p .env.example .env
vim .env
```

#### Enable user for auth

```bash
cp -p app/passwd.example.php app/passwd.php
vim app/passwd.php
```

### Permissions

```bash
chgrp www-data -Rf var
chmod 770 -Rf var
```

### Vhost

```bash
Alias / "/var/www/html/api-psdftk/public/"
<Directory "/var/www/html/api-psdftk/public">
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

## Commands

### Background

#### Request

```bash
curl --location --request POST 'https://api.development.local/pdf/background' \
--header 'Content-Type: application/json' \
--data-raw '{
    "auth": {
        "username": "...username...",
        "password": "...sha256-password..."
    },
    "data": {
        "type": "pdf",
        "id": 1,
        "attributes": {
            "background": "...base64-content...",
            "content": "...base64-content...",
            "encode": "base64"
        }
    }
}'
```

#### Response

```bash
HTTP/1.1 200 OK
Content-Type: application/json
{
    "jsonapi": {
        "version": "1.0"
    },
    "data": [
        {
            "type": "pdf",
            "id": 1,
            "attributes": {
                "content": "...base64-content...",
                "encode": "base64"
            }
        }
    ]
}
```

## License

Schema is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
