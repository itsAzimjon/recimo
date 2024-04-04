<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('category_id')->nullable();
            $table->text('type')->nullable();
            $table->text('weight');
            $table->bigInteger('price')->nullable();
            $table->string('area');
            $table->text('address');
            $table->string('attachment')->nullable();
            $table->text('status')->nullable();
            $table->text('edited_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
