<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// returns json object with all proteinAC data
$app->get('/protein/{protein}', function (Request $request, Response $response, $args) {
    $arg = $request->getAttribute('protein');
    $this->logger->addInfo("arg: " . $arg);

    // OK for fetch proteinAC
    try {
        $mng = new MongoDB\Driver\Manager(\Src\Classes\Mongo\DB_AUTH_HOST);
        $filter = [ 'alternativeProteinACs' => $arg ];
        $query = new MongoDB\Driver\Query($filter);
        $res = $mng->executeQuery(\Src\Classes\Mongo\DB_NAME.".".\Src\Classes\Mongo\DB_COLLECTION, $query);
        $prot = current($res->toArray());
        if (!empty($prot)) {
            return json_encode($prot);
        } else {
            echo "No match found\n";
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        $filename = basename(__FILE__);
        echo "The $filename script has experienced an error.\n";
        echo "It failed with the following exception:\n";
        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";
    }
});

// returns json object with list of fastaHeaders matches
$app->get('/query/{query}', function (Request $request, Response $response, $args) {
    $arg = $request->getAttribute('query');
    $this->logger->addInfo("arg: " . $arg);

    // search with partial matches
    try {
        $mng = new MongoDB\Driver\Manager(\Src\Classes\Mongo\DB_AUTH_HOST);
        $filter = ['searchTerm' => new MongoDB\BSON\Regex( "$arg", 'i' )];
        $options = ['limit' => 100];
        $query = new MongoDB\Driver\Query($filter,$options);
        $res = $mng->executeQuery(\Src\Classes\Mongo\DB_NAME.".".\Src\Classes\Mongo\SEARCH_COLLECTION, $query);
        if (!empty($res)) {
            $output = array();
            foreach ($res as $row) {
                $output[] = array('proteinAC'=>"$row->proteinAC",'searchTerm'=>"$row->searchTerm");
            }
            print_r(json_encode($output));
        } else {
            echo "No match found\n";
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        $filename = basename(__FILE__);
        echo "The $filename script has experienced an error.\n";
        echo "It failed with the following exception:\n";
        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";
    }
});

