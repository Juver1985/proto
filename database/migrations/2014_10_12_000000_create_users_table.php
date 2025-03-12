<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Usuario que realiza la solicitud (Mayordomo)
            $table->string('titulo'); // Título breve de la solicitud
            $table->text('descripcion'); // Descripción detallada
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente'); // Estado de la solicitud
            $table->timestamps();

            // Clave foránea que enlaza con la tabla users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
