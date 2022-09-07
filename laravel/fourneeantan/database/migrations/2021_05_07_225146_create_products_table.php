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
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('subtitle');
            $table->text('description');
            $table->string('image')->default('https://via.placeholder.com/200x250');
            $table->float('price', 8,2 )->default(0);
            $table->integer('quantity')->default(100);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('category_id')->default(1);
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->timestamps();
            $table->unsignedBigInteger('tva_id')->default(1);
            $table->foreign('tva_id')
            ->references('id')
            ->on('tvas')
            ->onDelete('restrict')
            ->onUpdate('restrict');
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
