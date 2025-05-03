<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->decimal('name_price', 10, 2);
            $table->integer('room_count');
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->text('descriptions')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('hotel_id')->constrained('hotels'); // Связь с таблицей hotels
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
