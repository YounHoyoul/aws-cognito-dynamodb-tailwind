<?php

namespace App\Http\Controllers;

use App\Services\MessageService\MessageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * Create a new controller instance.
     * @param MessageServiceInterface
     * @return void
     */
    public function __construct(MessageServiceInterface $messageService)
    {
        $this->middleware('auth');
        $this->messageService = $messageService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messageService->listByPaginate(Auth::id());
        
        return view('home', compact('messages'));
    }
}
