#!/bin/sh --

port=$1
[ -z "$port" ] && port='8000'

php -S localhost:${port} $(dirname $0)/showPostData.php
