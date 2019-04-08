<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cars';

    /**
     * Run the migrations.
     * @table cars
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('mark', 45);
            $table->string('model', 45);
            $table->string('plate', 15)->unique();
            $table->year('year');
            $table->integer('engine_volume');
            $table->integer('horse_power');
            $table->enum('fuel', ['diesel', 'gasoline'])->default('diesel');
            $table->integer('kilometers');
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["user_id"], 'fk_Cars_user_idx');


            $table->foreign('user_id', 'fk_Cars_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
