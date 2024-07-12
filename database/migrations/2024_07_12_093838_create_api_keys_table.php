<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    /** 
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('key')->unique();
            $table->timestamps();
        });
    }
    /** 
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('api_keys');
    }
}