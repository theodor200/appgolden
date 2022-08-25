<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $action= new \App\Http\Controllers\JobsController;
        $action->dccStatus();
        //return 0;
    }
}
