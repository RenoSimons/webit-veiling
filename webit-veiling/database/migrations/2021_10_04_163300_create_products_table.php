<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->default("Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat harum omnis autem temporibus, doloremque adipisci libero tenetur rerum, blanditiis quae asperiores mollitia placeat ab perferendis hic ea, laudantium nobis fugit.");
            $table->float('start_price');
            $table->string('img_url');
            $table->string('close_date');
            $table->float('highest_offer')->nullable();
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
        Schema::dropIfExists('products');
    }
}
