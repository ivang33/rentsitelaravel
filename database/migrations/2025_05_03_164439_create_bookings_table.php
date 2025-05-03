<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('guest_count');
            $table->string('status');
            $table->decimal('total_price', 10, 2);
            $table->foreignId('apartment_id')->constrained('apartments'); // Связь с таблицей apartments
            $table->foreignId('user_id')->constrained('users'); // Связь с таблицей users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
