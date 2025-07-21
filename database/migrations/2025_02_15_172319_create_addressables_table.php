<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addressables', function (Blueprint $table): void {
            $table->foreignUuid('address_id')->constrained('addresses')->cascadeOnDelete();
            $table->uuidMorphs('addressable'); // addressable_id, addressable_type
            $table->string('type')->nullable(); // e.g., billing, shipping
            $table->primary(['address_id', 'addressable_id', 'addressable_type']);
            $table->index('address_id');
            $table->index(['addressable_id', 'addressable_type']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addressables');
    }
};
