<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->notnull();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('numero_di_telefono');
            $table->dateTime('data_di_creazione');
            $table->dateTime('data_di_modifica');
            $table->softDeletes('deleted_at', precision: 0);
        });

        Schema::create('profile_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('attribute');
            $table->dateTime('data_di_creazione');
            $table->dateTime('data_di_modifica');
            $table->softDeletes('deleted_at', precision: 0);
            $table->unique(['profile_id', 'attribute']);
            $table->foreignId('profile_id')->references('id')->on('profiles');
        });

        Schema::create('sessions', function ($table) {
            $table->string('id')->unique();
            $table->text('payload');
            $table->integer('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('profile_attributes');
    }
};
