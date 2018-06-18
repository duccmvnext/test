**Install composer dependencies**

```./composer.phar update```

**Create the ZF1 skeleton**

```vendor/zendframework/zendframework1/bin/zf.sh create project .```

**Use the composer autoloader in the `public/index.php` file**

```require_once __DIR__ . '/../vendor/autoload.php';```

**Start the application**

```
cd public
php -S localhost:8080
```

**Usage of Phing to inject database credentials

```
vendor/bin/phing setup-db -Ddb.host=... -Ddb.username=...
```