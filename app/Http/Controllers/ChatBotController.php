<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DeepSeekRepositoryInterface;
use App\Models\ChatHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ChatBotController extends Controller {
    protected $deepSeekRepo;

    public function __construct(DeepSeekRepositoryInterface $deepSeekRepo) {
        $this->deepSeekRepo = $deepSeekRepo;
    }

    // public function respond(Request $request) {
    //     $userMessage = $request->input('message');

    //     // Personaliza el system prompt si es necesario
    //     $customSystemPrompt = "Eres un asistente de 'Mi Empresa'. Responde sobre horarios (9AM-6PM), servicios: [limpieza, reparaciones] y citas.";

    //     $response = $this->deepSeekRepo->getChatResponse(
    //         $userMessage,
    //         $customSystemPrompt
    //     );

    //     return response()->json(['reply' => $response]);
    // }
    public function respond(Request $request)
    {
        $userMessage = $request->input('message');
        $customSystemPrompt = "Eres un asistente de 'Mi Empresa'. Responde sobre horarios (9AM-6PM), servicios: [limpieza, reparaciones] y citas.";

        // Guardar mensaje del usuario
        $this->saveMessage('user', $userMessage);

        $response = $this->deepSeekRepo->getChatResponse(
            $userMessage,
            $customSystemPrompt
        );

        Log::debug("Mensaje recibido: " . $userMessage);
        Log::debug("Respuesta generada: " . $response);

        // Guardar respuesta del bot
        $this->saveMessage('bot', $response);

        return response()->json(['reply' => $response]);
    }

    private function saveMessage($sender, $message)
    {
        ChatHistory::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'session_id' => Session::getId(),
            'sender' => $sender,
            'message' => $message
        ]);
    }

    public function history()
    {
        $query = ChatHistory::query();

        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            $query->where('session_id', Session::getId());
        }

        $messages = $query->orderBy('created_at')->get(['sender', 'message']);

        return response()->json($messages);
    }
}
