<?php

use Illuminate\Database\Migrations\migration;
use Illuminate\Database\Schema\blueprint;
use Illuminate\Support\Facades\schema;

return new class extends migration
{
    public function up(): void
    {
        schema::create('siswa',function (blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('image');
            $table->bigInteger('nis');
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->string('kelas');
            $table->bigInteger('hp');
            $table->integer('status');
            $table->timestamps();
        });
    }
    public function down():void
    {
        schema::dropIfExists('siswa');
    }
};