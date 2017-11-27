# Slim Framework 3 backend application

This REST-API application is the Slim/PHP version of:  
https://gitlab.sib.swiss/rmylonas/slice-silac-viz-backend

This application works with the following frontend react application:  
https://gitlab.sib.swiss/rmylonas/slice-silac-viz-ui


**Requirements:**

* PHP > 5.6 with mongodb.so driver //successfully tested with PHP 7.1.8
* Mongodb database
* PHP composer


**Test API-Mongodb:**

* curl -X GET localhost:8888/slimp/public/query/TFR
* curl -X GET localhost:8888/slimp/public/protein/P02786

_if the API is access protected via a .htaccess use the following and type the password when requested_  
* curl -u authorizedUser localhost:8888/slimp/public/query/TFR
