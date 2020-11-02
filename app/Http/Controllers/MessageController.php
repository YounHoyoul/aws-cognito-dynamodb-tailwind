<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;
use App\Services\MessageService\MessageServiceInterface;

class MessageController extends Controller
{
    /**
     * @var MessageServiceInterface
     */
    private $service;

    public function __construct(MessageServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(MessageRequest $request)
    {
        $message = $this->service->create([
            'pk' => Auth::user()->id,
            'title' => $request->input('title'),
            'message' => $request->input('message')
        ]);

        return redirect()->route('home');
    }
}
