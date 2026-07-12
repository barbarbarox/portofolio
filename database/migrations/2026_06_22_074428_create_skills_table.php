<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Web Development, Cybersecurity, Others
            $table->string('category_emoji')->default('⚡');
            $table->string('name');
            $table->integer('level')->default(75); // 0-100
            $table->string('color')->default('blue'); // blue, green, purple
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('skills'); }
};
