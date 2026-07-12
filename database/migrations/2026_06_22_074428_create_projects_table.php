<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('emoji')->default('🚀');
            $table->string('title');
            $table->text('description');
            $table->string('tech_stack')->nullable();
            $table->json('tags')->nullable();
            $table->string('accent_color')->default('#00d4ff');
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};
