# PHP Development Environment

* [**MailDev**](https://github.com/maildev/maildev) SMTP Server + Web Interface for viewing and testing emails during development.
* **PHP 7.4.x (CLI)** with Composer, PHP CodeSniffer, phpDocumentor, phpunit and XDebug for development.

**Since everything that has to do with the stack, only runs in the container, you have to put the commands into the corresponding container.**

* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) is a set of two PHP scripts; the main `phpcs` script that tokenizes PHP, JavaScript and CSS files to detect violations of a defined coding standard, and a second `phpcbf` script to automatically correct coding standard violations.
* [phpDocumentor](https://www.phpdoc.org/) is the de-facto documentation application for PHP projects.
* [PHPUnit](https://phpunit.de/) is a programmer-oriented testing framework for PHP.
* [Xdebug](https://xdebug.org/) - Debugger and Profiler Tool for PHP

## Useful commands

To start/stop the stack, enter the following command in the terminal:

```bash
docker-compose up -d
docker-compose down
```

To **open a shell** in the application's container, use:

```bash
docker exec -it <container> /bin/bash
```

To **test if email works**

```bash
docker exec -i maildev echo -n 'Subject: test\n\nTesting Email' | sendmail -v testuser@localhost.local
```

To **execute a PHP script**:

```bash
cd code
docker exec -i phpdev php example.php
```

## Visual Studio Code integration

Add the `bin` folder to your PATH environment variable.

Add following command into your vscode settings.json:

```json
    "phpcs.executablePath": "phpcs.bat",
    "php.executablePath": "php.bat",
    "php.validate.executablePath": "php.bat"
```
