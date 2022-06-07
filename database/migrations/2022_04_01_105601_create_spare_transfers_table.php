<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpareTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('to_user_id');
            $table->integer('how');
            $table->integer('order_number');
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->foreignIdFor(transfer::class);
            $table->foreignIdFor(sparepart::class);
            $table->bigInteger('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_transfers');
    }
}
