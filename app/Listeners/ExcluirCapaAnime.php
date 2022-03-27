<?php

namespace App\Listeners;

use App\Events\AnimeApagado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaAnime implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AnimeApagado  $event
     * @return void
     */
    public function handle(AnimeApagado $event)
    {
        $anime = $event->anime;
        if ($anime->capa) {
            Storage::delete($anime->capa);
        }
    }
}
