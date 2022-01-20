<?php

namespace App\Jobs;

use App\Serie;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExcluirCapaSerie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $serie;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Serie $serie)
    {
        $this->serie = $serie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serie = $this->serie;
        if ($serie->thumbnail) {
            Storage::delete($serie->thumbnail);
        }
    }
}
