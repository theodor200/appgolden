<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingram', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('nota_venta')->nullable()->default(null);
            $table->string('serie')->nullable()->default(null);
            $table->string('numero_modelo')->nullable()->default(null);
            $table->string('modelo')->nullable()->default(null);
            $table->string('order_dcc')->unique();
            $table->string('order_estado_dcc')->nullable()->default(null);
            $table->string('order_tipo_dcc')->nullable()->default(null);
            $table->string('numero_suministro')->nullable()->default(null);
            $table->string('suministro')->nullable()->default(null);
            $table->string('cliente_dcc')->nullable()->default(null);
            $table->string('site_dcc')->nullable()->default(null);

            $table->string('guia_remision')->nullable()->default(null);
            $table->string('procesado')->nullable()->default(null);
            $table->string('preparado')->nullable()->default(null);
            $table->string('transito')->nullable()->default(null);
            $table->string('zona')->nullable()->default(null);
            $table->string('entregado')->nullable()->default(null);
            $table->string('digitalizado')->nullable()->default(null);
            $table->string('rechazado')->nullable()->default(null);
            $table->string('observaciones')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingram');
    }
};
