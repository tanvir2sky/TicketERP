<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->unsignedBigInteger('ticket_category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('subject');
            $table->longText('body');
            $table->string('status')->default(\App\Models\Ticket::PENDING);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
