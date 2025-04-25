<?php

namespace App\Repositories;

interface DeepSeekRepositoryInterface
{
    public function getChatResponse(string $prompt, string $systemPrompt = null): string;
}



