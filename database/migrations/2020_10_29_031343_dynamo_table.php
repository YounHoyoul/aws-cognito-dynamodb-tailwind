<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use BaoPham\DynamoDb\Facades\DynamoDb;

class DynamoTable extends Migration
{
    private $client;
    private $config = [];
    private $tableName;

    public function __construct()
    {        
        $this->tableName = with(new App\Models\DynamoTable)->getTable();

        if(env('DYNAMODB_LOCAL')) {
            $this->config['endpoint'] = env('DYNAMODB_LOCAL_ENDPOINT');
        }
        
        $this->client = DynamoDb::client();        
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = [
            "TableName" => $this->tableName,
            "KeySchema" => [
                [
                    "AttributeName" => "pk", 
                    "KeyType" => "HASH"
                ],
                [
                    "AttributeName" => "sk", 
                    "KeyType" => "RANGE"
                ]
            ],

            "GlobalSecondaryIndexes" => [
                [
                    "IndexName" => "gs1",
                    "KeySchema" => [
                        [
                            "AttributeName" => "sk", 
                            "KeyType" => "HASH"
                        ],
                        [
                            "AttributeName" => "data", 
                            "KeyType" => "RANGE"
                        ]
                    ],
                    "Projection" => [
                        "ProjectionType" => "INCLUDE",
                        "NonKeyAttributes" => [
                            "data"
                        ]
                    ],
                    "ProvisionedThroughput" => [
                        "ReadCapacityUnits" => 1, 
                        "WriteCapacityUnits" => 1
                    ]
                ]
            ],

            "AttributeDefinitions" => [
                [
                    "AttributeName" => "pk", 
                    "AttributeType" => "S"
                ],
                [
                    "AttributeName" => "sk", 
                    "AttributeType" => "S"
                ],
                [
                    "AttributeName" => "data", 
                    "AttributeType" => "S"
                ]
            ],
            "ProvisionedThroughput" => [
                "ReadCapacityUnits" => 1, 
                "WriteCapacityUnits" => 1
            ]
        ];

        $table = $this->client->createTable($schema);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->client->deleteTable([
            "TableName" => $this->tableName,
        ]);
    }
}
