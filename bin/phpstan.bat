@echo off
set PHPBIN="docker exec -i phpdev phpstan"
"%PHPBIN%" %*
