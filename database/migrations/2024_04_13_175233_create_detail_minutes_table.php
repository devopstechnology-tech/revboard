<?php

declare(strict_types=1);

use App\Enums\PublishEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_minutes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('description')->nullable();
            $table->string('status')->default(PublishEnum::Default->value);//
            $table->string('agenda_id')->nullable();
            $table->string('minute_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_minutes');
    }
};
