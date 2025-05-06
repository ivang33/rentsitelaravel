<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name_price'); // Название тарифа
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->string('room_number'); // Номер комнаты
            $table->string('type'); // Тип апартаментов
            $table->decimal('price_per_night', 10, 2); // Цена за ночь
            $table->integer('room_count'); // Количество комнат
            $table->integer('capacity')->nullable(); // Вместимость (сколько человек)
            $table->date('check_in_date')->nullable(); // Дата заезда
            $table->date('check_out_date')->nullable(); // Дата выезда
            $table->text('description')->nullable(); // Основное описание
            $table->text('descriptions')->nullable(); // Дополнительные описания (если нужно дублирование)
            $table->text('additional_info')->nullable(); // Дополнительная информация
            $table->string('photo')->nullable(); // Путь к фото
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
