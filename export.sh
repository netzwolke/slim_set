#!/bin/bash

password=123456
user=root
name = $1
host=127.0.0.1
#password=Daniel946875.
#user=dump
#host=us.lan


mysqldump --user=$user --password=$password --host=$host --single-transaction --no-tablespaces  $name > $name.sql

