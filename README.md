# postify-app

#It is neccessary to create a htaccess file. Then, copy this code

```javascript
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?load=$1 [PT,L]
```
