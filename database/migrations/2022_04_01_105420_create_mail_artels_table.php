<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailArtelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_artels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('from_user_id');
            $table->string('topic');
            $table->integer('transfer_id')->default(0);
            $table->integer('active')->default(1);
            $table->text('text');
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
        Schema::dropIfExists('mail_artels');
    }
}
