# PHP Development Environment

* [**MailDev**](https://github.com/maildev/maildev) SMTP Server + Web Interface for viewing and testing emails during development.
* **PHP 7.4.x (CLI)** with Composer, PHP CodeSniffer, phpDocumentor, phpunit and XDebug for development.

The Visual Studio Code [Remote - Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension lets you use a Docker container as a full-featured development environment. It allows you to open any folder or repository inside a container and take advantage of Visual Studio Code's full feature set. The [devcontainer.json](./.devcontainer.json) file tells VS Code how to access (or create) the development container with well-defined tool and runtime stack.

**Since everything that has to do with the stack, only runs in the container, you have to put the commands into the corresponding container.**

**The local folder `code` is mapped to `/opt/code` in the phpdev container**

Read more:

* [Developing inside a Container](https://code.visualstudio.com/docs/remote/containers)
* [Attach to a running container](https://code.visualstudio.com/docs/remote/attach-container)

## Installed utilities

* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) is a set of two PHP scripts; the main `phpcs` script that tokenizes PHP, JavaScript and CSS files to detect violations of a defined coding standard, and a second `phpcbf` script to automatically correct coding standard violations.
* [phpDocumentor](https://www.phpdoc.org/) is the de-facto documentation application for PHP projects.
* [PHPUnit](https://phpunit.de/) is a programmer-oriented testing framework for PHP.
* [Xdebug](https://xdebug.org/) - Debugger and Profiler Tool for PHP

### Coding standard

The configured coding standard used by PHP_CodeSniffer is the [PSR-12 coding standard](https://www.php-fig.org/psr/psr-12/). To check a file against the PEAR coding standard, use the `--standard` command line argument: `phpcs --standard=PEAR /path/to/code-directory`

## Installed vscode extensions

* [PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug): Debug support for PHP with Xdebug
* [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs): PHP CodeSniffer for Visual Studio Code.
* [phpcbf](https://marketplace.visualstudio.com/items?itemName=persoderlind.vscode-phpcbf): PHP Code Beautifier and Fixer.
* [PHP DocBlocker](https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker): A simple, dependency free PHP specific DocBlocking package.
* [Git File History](https://marketplace.visualstudio.com/items?itemName=pomber.git-file-history): Modern, fast and intuitive tool for browsing the history and files in any git repository.
* [Git Graph](https://marketplace.visualstudio.com/items?itemName=mhutchie.git-graph): View a Git Graph of your repository, and perform Git actions from the graph.
* [gitignore](https://marketplace.visualstudio.com/items?itemName=michelemelluso.gitignore): Add file to .gitignore.
* [GitLens](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens): Supercharge the Git capabilities built into Visual Studio Code.
* [Error Lens](https://marketplace.visualstudio.com/items?itemName=usernamehw.errorlens): Improve highlighting of errors, warnings and other language diagnostics.
* [Path Intellisense](https://marketplace.visualstudio.com/items?itemName=christian-kohler.path-intellisense): Visual Studio Code plugin that autocompletes filenames.
* [Resource Monitor](https://marketplace.visualstudio.com/items?itemName=mutantdino.resourcemonitor): Displays current CPU stats, memory/disk consumption, and battery percentage remaining.

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

## Local Host integration

**Add the `bin` folder to your PATH environment variable.**

If you are using powershell add following command into your vscode settings.json:

```json
    "phpcs.executablePath": "phpcs.bat",
    "php.executablePath": "php.bat",
    "php.validate.executablePath": "php.bat"
```

If you are using git bash add following command into your vscode settings.json:

```json
    "phpcs.executablePath": "phpcs",
    "php.executablePath": "php",
    "php.validate.executablePath": "php"
```
