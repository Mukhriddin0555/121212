<?php

use App\Models\status;
use App\Models\warehouse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryWaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_waits', function (Blueprint $table) {
            $table->id();
            $table->string('data');
            $table->string('crm_id');
            $table->string('sap_kod');
            $table->integer('how');
            $table->string('order');
            $table->foreignIdFor(warehouse::class);
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
        Schema::dropIfExists('history_waits');
    }
}
