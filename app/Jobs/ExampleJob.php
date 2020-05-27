<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExampleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function handle()
    {
        foreach (range(1, $this->number) as $number)
        {
            Log::info('Number ' . $number);
        }
    }
}
