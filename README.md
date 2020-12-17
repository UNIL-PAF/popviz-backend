# PopViz backend

## Description

This is the REST-API of [PopViz](https://popviz.vital-it.ch/) developed for the Department of Physiology at the University of Lausanne.
It is written with Slim/PHP.

This application works with the following ReactJS frontend application:  
https://github.com/UNIL-PAF/popviz-frontend

----

###Requirements:

* PHP > 5.6 with mongodb.so driver //successfully tested with PHP 7.1.8
* Mongodb database
* PHP composer


###Test API-Mongodb:

* curl -X GET localhost:8888/slimp/public/query/TFR
* curl -X GET localhost:8888/slimp/public/protein/P02786

_if the API is access protected via a .htaccess use the following and type the password when requested_  
* curl -u authorizedUser localhost:8888/slimp/public/query/TFR


###Modifications
```
composer update
```
_copy and adapt the following files_

```
cp public/.htaccess_template public/.htaccess
cp src/classes/mongo.php_template src/classes/mongo.php
```
