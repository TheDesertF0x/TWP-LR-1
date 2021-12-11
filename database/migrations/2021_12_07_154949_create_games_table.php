<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('stadium');
            $table->string('level');
            $table->string('first_team');
            $table->string('second_team');
            $table->integer('num_of_pucks_first')->comment('Количество шайб, забитых первой командой');
            $table->integer('num_of_pucks_second')->comment('Количество шайб, забитых второй командой');
            $table->string('winner')->comment('Победитель в матче');
            $table->foreignId('cup_id')->constrained('cups');
            $table->softDeletes();
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
        Schema::dropIfExists('games');
    }
}
