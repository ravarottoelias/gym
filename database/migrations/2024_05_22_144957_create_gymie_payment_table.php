<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymiePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gymie_payments', function (Blueprint $table) {
            $table->string('payment_identifier')->primary();
            $table->string('status');
            $table->string('period');
            $table->string('gateway');
            $table->text('payload');
            $table->text('notification_payload');
            $table->boolean('notification_verified')->nullable();
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
        Schema::dropIfExists('gymie_payment');
    }
}
