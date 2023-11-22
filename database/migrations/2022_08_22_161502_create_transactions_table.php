<?php

use App\Models\Toko;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('toko_id');
            $table->foreign('toko_id')->references('id')->on('tokos')->cascadeOnDelete();
            $table->integer('total');
            $table->enum('metode', ['cod', 'transfer']);
            $table->timestamp('waktu_pengambilan');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['process', 'canceled', 'success', 'diterima']);
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
        Schema::dropIfExists('transactions');
    }
};
