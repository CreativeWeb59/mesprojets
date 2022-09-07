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
            $table->string('payment_intend_id')->unique();
            $table->string('Num_commande')->unique();
            $table->string('nom_client');
            $table->string('city');
            $table->float('total', 8,2 );
            $table->float('totalHT', 8,2 );
            $table->integer('item_count');
            $table->boolean('is_paid')->default(0);
            $table->enum('status', ['Terminee', 'En cours','Validee','Supprimee']);
            $table->enum('payment_method', ['Stripe', 'Carte Bleue', 'Paypal'])->default('Stripe');
            $table->string('informations');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('date_retrait')->nullable();
            $table->string('heure_retrait')->nullable();
            $table->timestamp('retrait_order')->nullable();
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
