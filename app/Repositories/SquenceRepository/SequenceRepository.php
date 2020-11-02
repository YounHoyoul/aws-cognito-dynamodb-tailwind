<?php

namespace App\Repositories\SequenceRepository;

use Ramsey\Uuid\Uuid;
use App\Models\DynamoTable;
use BaoPham\DynamoDb\Facades\DynamoDb;

class SequenceRepository implements SequenceRepositoryInterface
{
    /**
     * @var DynamoTable
     */
    private $model;

    public function __construct(DynamoTable $model)
    {
        $this->model = $model;
    }

    public function next(string $division): int
    {
        $data = DynamoDb::table('dynamo_tables')
            ->setKey(DynamoDb::marshalItem(['pk' => "sequence#" . $division, 'sk' => $division]))
            ->setUpdateExpression('SET #name1 = #name2 + :val')
            ->setExpressionAttributeName("#name1", "sequence_number")
            ->setExpressionAttributeName("#name2", "sequence_number")
            ->setExpressionAttributeValue(':val' , DynamoDb::marshalValue(1))
            ->setReturnValues("ALL_OLD")
            ->prepare()
            ->updateItem();

        return (int) $data->get('Attributes')['sequence_number']['N'];
    }

    public function create(string $division): DynamoTable
    {
        $data = $this->model->create([
            "pk" => "sequence#" . $division,
            "sk" => $division,
            "data" => $division,
            "sequence_number" => 1
        ]);

        return $data;
    }

    public function delete(string $division): void
    {
        DynamoDb::table('dynamo_tables')
            ->setKey(DynamoDb::marshalItem(['pk' => "sequence#" . $division, 'sk' => $division]))
            ->prepare()
            ->deleteItem();
    }
}