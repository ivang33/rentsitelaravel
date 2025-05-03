<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('review_text');
            $table->date('review_date');
            $table->foreignId('user_id')->constrained('users'); // Связь с таблицей users
            $table->foreignId('apartment_id')->constrained('apartments'); // Связь с таблицей apartments
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
