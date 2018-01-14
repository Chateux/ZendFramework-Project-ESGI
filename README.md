# Project Zend Framework for ESGI

## Introduction

This a project for a course who is name "Zend framework 3". So in this project you have a meetup CRUD.
You can Create, Read, Update and Delete everything you want. But I add into this project 3 tables including one who is not used.


## How to use ?

This project does not use Docker, so you can use this project in local.


You must use first 

```
git clone https://github.com/Chateux/ZendFramework-Project-ESGI.git
```

and you launch 

```
composer install
```

and to finish

```
php vendor/bin/doctrine-module orm:schema-tool:update --force
```
