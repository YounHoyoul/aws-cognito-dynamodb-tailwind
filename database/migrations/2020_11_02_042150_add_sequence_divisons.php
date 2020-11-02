<?php

use App\Models\DynamoTable;
use BaoPham\DynamoDb\Facades\DynamoDb;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Services\SequenceService\SequenceServiceInterface;
use App\Repositories\SequenceRepository\SequenceRepository;

class AddSequenceDivisons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $model = new DynamoTable();

        $model->create([
            "pk" => "sequence#user",
            "sk" => "user",
            "data" => "user",
            "sequence_number" => 1
        ]);

        $model->create([
            "pk" => "sequence#message",
            "sk" => "message",
            "data" => "message",
            "sequence_number" => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DynamoDb::table("dynamo_tables")
            ->setKey(DynamoDb::marshalItem(['pk' => "sequence#user", "sk"=>"user"]))
            ->prepare()
            ->deleteItem();

        DynamoDb::table("dynamo_tables")
            ->setKey(DynamoDb::marshalItem(['pk' => "sequence#message", "sk"=>"message"]))
            ->prepare()
            ->deleteItem();    
    }
}
