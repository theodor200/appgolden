<?php

namespace App\Console\Commands;

use App\Models\CookieCliente;
use Illuminate\Console\Command;

class IngramStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingram:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite ver si la sesion sigue activa en Ingram';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $clientes = CookieCliente::all();
        $action= new \App\Http\Controllers\CookieClienteController;
        foreach ($clientes as $cliente) {
            $action->cookieIngramStatus($cliente);
        }
        //return Command::SUCCESS;
    }
}
