<?php

use App\Models\Application;
use App\Models\Competition;
use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contestants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model: Event::class)->constrained();
            $table->foreignIdFor(model: Competition::class)->constrained();
            $table->foreignIdFor(model: Application::class)->nullable()->constrained();
            $table->string('name');
            $table->string('country');
            $table->string('country_code', 2); // For flag display
            $table->string('title');
            $table->string('focus_area');
            $table->text('bio')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('votes')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->text('social_media')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contestants');
    }
};
