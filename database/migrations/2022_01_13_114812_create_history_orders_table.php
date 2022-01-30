<?php

use App\Models\User;
use App\Models\status;
use App\Models\warehouse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_orders', function (Blueprint $table) {
            $table->id();
            $table->string('crm_id');
            $table->string('sap_kod');
            $table->integer('how');
            $table->string('order');
            $table->foreignIdFor(warehouse::class);            
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(status::class);
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
        Schema::dropIfExists('history_orders');
    }
}
