@echo off
set PHPBIN="docker exec -i phpdev phpcbf"
"%PHPBIN%" %*
