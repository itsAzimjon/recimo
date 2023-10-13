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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role_id')->default(5);
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('photo')->nullable();
            $table->string('name');
            $table->string('llc')->nullable();
            $table->string('phone_number')->unique();
            $table->string('address')->nullable();
            $table->string('passport')->unique()->nullable();
            $table->bigInteger('inn')->unique()->nullable();
            $table->string('password');
            $table->string('prize')->nullable();
            $table->string('active')->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
