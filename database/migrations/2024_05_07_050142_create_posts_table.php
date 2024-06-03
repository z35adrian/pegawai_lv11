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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('image');
        $table->string('nama');
        $table->text('alamat');
        $table->string('kelamin');
        $table->string('tempat_lahir');
        $table->date('tgl_lahir');
        $table->string('jobdesc');
        $table->string('jabatan');
        $table->string('tgl_masuk');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }




};
