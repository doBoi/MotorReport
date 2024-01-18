<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('dissmantlings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')->constrained();
            $table->string('sernum', 40);
            $table->string('slug', 40);
            $table->date('tgl');
            $table->string('spk', 55);
            $table->longText('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dissmantlings');
    }
};
