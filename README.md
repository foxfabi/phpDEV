# PHP Development Environment

* [**MailDev**](https://github.com/maildev/maildev) SMTP Server + Web Interface for viewing and testing emails during development.
* **PHP 7.4.x (CLI)** with Composer, PHP CodeSniffer, phpDocumentor, phpunit and XDebug for development.

**Since everything that has to do with the stack, only runs in the container, you have to put the commands into the corresponding container.**

## Useful commands

To start/stop the stack, enter the following command in the terminal:

```bash
docker-compose -f "docker-compose.yml" up -d
docker-compose -f "docker-compose.yml" down
```

To **open a shell** in the application's container, use:

```bash
docker exec -it <container> /bin/bash
```

To **test if email works**

```bash
echo -n 'Subject: test\n\nTesting Email' | sendmail -v testuser@localhost.local
```

To **execute a PHP script**:

```bash
cd code
docker exec -i phpdev php example.php
```

## Visual Studio Code integration

In order to call `php`, `phpcbf` or `phpcs` we add some custom scripts into `/usr/local/bin`.

```bash
#!/bin/bash
#/usr/local/bin/php
DOCK=phpdev
docker exec \
    -i \
    $DOCK \
    php "$@"
```

```bash
#!/bin/bash
#/usr/local/bin/phpcbf
DOCK=phpdev
docker exec \
    -i \
    $DOCK \
    phpcbf "$@"
```

```bash
#!/bin/bash
#/usr/local/bin/phpcs
DOCK=phpdev
docker exec \
    -i \
    $DOCK \
    phpcs "$@"
```

```bash
#!/bin/bash
#/usr/local/bin/phpstan
DOCK=phpdev
docker exec \
    -i \
    $DOCK \
    phpstan "$@"
```
