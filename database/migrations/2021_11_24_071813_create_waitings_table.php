<?php

use App\Models\sparepart;
use App\Models\status;
use App\Models\warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waitings', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('crm_id');
            $table->foreignIdFor(sparepart::class);
            $table->integer('how');
            $table->string('order');
            $table->foreignIdFor(warehouse::class);
            $table->foreignIdFor(status::class);
            $table->text('text')->nullable();
            $table->integer('active')->default(1);
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
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
        Schema::dropIfExists('waitings');
    }
}
