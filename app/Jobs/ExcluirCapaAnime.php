<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaAnime 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $anime;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($anime)
    {
        $this->anime = $anime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $anime = $this->anime;
        if ($anime->capa) {
            Storage::delete($anime->capa);
        }
    }
}
