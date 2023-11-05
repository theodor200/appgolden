<?php

namespace App\Console\Commands;

use App\Models\Glpi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PingGlpi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cookie:glpi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active remote session cookie Glpi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Log::info('cookie:glpi, Comando ejecutado');
        $glpi = Glpi::all()->first();
        $action= new \App\Http\Controllers\JobsController;
        $action->glpiStatus($glpi);
        return 0;
    }
}
