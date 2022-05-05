<?php

use App\Models\sparepart;
use App\Models\transfer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToSpareTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spare_transfers', function (Blueprint $table) {
            $table->foreignIdFor(transfer::class);
            $table->foreignIdFor(sparepart::class);
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spare_transfers', function (Blueprint $table) {
            //
        });
    }
}
