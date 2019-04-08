<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'bookings';

    /**
     * Run the migrations.
     * @table booking
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('note')->nullable()->default(null);
            $table->unsignedInteger('car_id');
            $table->unsignedInteger('service_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["car_id"], 'fk_Booking_car_idx');

            $table->index(["service_id"], 'fk_Booking_service_idx');


            $table->foreign('car_id', 'fk_Booking_car_idx')
                ->references('id')->on('cars')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('service_id', 'fk_Booking_service_idx')
                ->references('id')->on('services')
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
