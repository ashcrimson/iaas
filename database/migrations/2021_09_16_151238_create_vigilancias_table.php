<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVigilanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('vigilancias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id')->nullable()->index('fk_solicitud_paciente_idx');
            $table->unsignedBigInteger('estado_id')->nullable()->index('fk_solicitud_estado_idx');
            $table->tinyInteger('pesquisa')->nullable();
            $table->string('dip')->nullable();
            $table->string('procedimientos_cirugias')->nullable();
            $table->string('iarepi')->nullable();
            $table->string('paa')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('descserv')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vigilancias');
    }
}
