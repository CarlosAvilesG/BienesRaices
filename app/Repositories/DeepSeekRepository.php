<?php

namespace App\Repositories;

use GuzzleHttp\Client;
//use App\Models\Egreso;

class DeepSeekRepository implements DeepSeekRepositoryInterface
{
    protected $client;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = env('DEEPSEEK_API_KEY');
    }

    public function getChatResponse(string $prompt, string $systemPrompt = null): string {
        $systemPrompt = $systemPrompt ?? 'Eres un asistente útil para una empresa pequeña. Responde solo sobre horarios, servicios y agendar citas.';

        try {

            $response = $this->client->post('https://api.deepseek.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'deepseek-chat',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 150,
                ],
            ]);

            // return json_decode($response->getBody(), true)['choices'][0]['message']['content'];

            print ($response->getBody());
            
            return json_decode($response->getBody(), true)['choices'][0]['message']['content'];

        } catch (\Exception $e) {
            return "Error al procesar tu solicitud. Por favor, intenta más tarde.";
        }
    }


}
/*
<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use App\Repositories\Interfaces\DeepSeekRepositoryInterface;

class DeepSeekRepository implements DeepSeekRepositoryInterface {
    protected $client;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = env('DEEPSEEK_API_KEY');
    }

    public function getChatResponse(string $prompt, string $systemPrompt = null): string {
        $systemPrompt = $systemPrompt ?? 'Eres un asistente útil para una empresa pequeña. Responde solo sobre horarios, servicios y agendar citas.';

        try {

            $response = $this->client->post('https://api.deepseek.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'deepseek-chat',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 150,
                ],
            ]);

            // return json_decode($response->getBody(), true)['choices'][0]['message']['content'];

            return json_decode($response->getBody(), true)['choices'][0]['message']['content'];
        } catch (\Exception $e) {
            return "Error al procesar tu solicitud. Por favor, intenta más tarde.";
        }
    }
}
*/
