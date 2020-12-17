#!/bin/bash

database=$1
password=$2
password=123456
user=root
host=127.0.0.1

mysql -u$user -p$password -h$host -e "CREATE DATABASE $1;"
mysql -u$user -p$password -h$host $1 < $1.sql
