<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarServiceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'car_service';

    /**
     * Run the migrations.
     * @table done_services
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('done_service');
            $table->unsignedInteger('next_service')->nullable();
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('car_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["service_id"], 'fk_done_services_service_idx');

            $table->index(["car_id"], 'fk_done_services_car_idx');


            $table->foreign('service_id', 'fk_done_services_service_idx')
                ->references('id')->on('services')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('car_id', 'fk_done_services_car_idx')
                ->references('id')->on('cars')
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
