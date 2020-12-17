#!/bin/bash

database=$1
./export.sh $database 
./import.sh $database
