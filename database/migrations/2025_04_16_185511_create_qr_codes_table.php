<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodesTable extends Migration
{
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_codes');
    }
}