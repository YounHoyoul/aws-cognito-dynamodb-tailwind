<?php

namespace App\Repositories\MessageRepository;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\DynamoTable;
use Illuminate\Support\Collection;
use App\Services\SequenceService\SequenceServiceInterface;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var DynamoTable
     */
    private $model;

    /**
     * @var SequenceServiceInterface
     */
    private $sequenceService;

    public function __construct(DynamoTable $model, SequenceServiceInterface $sequenceService)
    {
        $this->model = $model;
        $this->sequenceService = $sequenceService;
    }

    public function create(array $data) : DynamoTable
    {
        $data = $this->model->create([
            "pk" => $data['pk'],
            "sk" => "message#" . $this->sequenceService->next('message'),
            "data" => "" . Carbon::now(),
            "title" => $data['title'],
            "message" => $data['message'],
        ]);

        return $data;
    }

    public function listByPaginate(string $pk) : Collection
    {
        return $this->model
            ->where('pk', $pk)
            ->where('sk', 'begins_with', 'message')
            ->get();
    }
}