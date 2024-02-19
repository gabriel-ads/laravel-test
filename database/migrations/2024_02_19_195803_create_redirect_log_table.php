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
        Schema::create('redirect_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('redirect_id');
            $table->string('request_ip');
            $table->string('user_agente');
            $table->string('header_referer');
            $table->string('query_params');
            $table->timestamp('last_access');
            $table->timestamps();

            $table->foreign('redirect_id')->references('id')->on('redirects')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_redirect_log');
    }
};
