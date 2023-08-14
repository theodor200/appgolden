<?php

namespace App\Console\Commands;

use App\Models\CookieCliente;
use App\Models\Site;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Dcc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dcc:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite ver si la sesion sigue activa en DCC';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Me ejecute');
        $sites = Site::all();
        $action= new \App\Http\Controllers\JobsController;
        foreach ($sites as $site) {
            $action->dccStatus($site);
        }
        return 0;
    }
}
