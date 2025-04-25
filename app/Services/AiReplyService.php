<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiReplyService
{
    public function generateReply(string $commentText): ?string
    {
        $apiKey = config('services.openai.api_key');
        $apiUrl = 'https://api.openai.com/v1/chat/completions';

        try {
            Log::info('Starting AI Reply generation...', ['comment_text' => $commentText]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post($apiUrl, [
                'model' => 'gpt-4o-mini',
                'store' => true,
                'messages' => [
                    ['role' => 'user', 'content' => $commentText],
                ],
            ]);

            if ($response->successful()) {
                $reply = $response->json('choices.0.message.content');

                Log::info('AI Reply generated successfully.', ['reply' => $reply]);

                return $reply;
            } else {
                Log::error('AI API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Exception while generating AI Reply', ['error' => $e->getMessage()]);
            return null;
        }
    }
}