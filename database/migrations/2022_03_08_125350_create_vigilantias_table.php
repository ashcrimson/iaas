<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVigilantiasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vigilantias', function (Blueprint $table) {
            $table->id('id');
            $table->tinyInteger('pesquisa')->nullable();
            $table->string('dip')->nullable();
            $table->string('procedemientos_cirugias')->nullable();
            $table->string('paa')->nullable();
            $table->string('comentarios');
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
        Schema::drop('vigilantias');
    }
}
