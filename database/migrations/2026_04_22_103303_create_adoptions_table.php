<?php

use App\Models\Animal;
use App\Models\User;
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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('notes');
            $table->boolean('approved');

            $table->foreignIdFor(Animal::class)->constrained();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->foreignIdFor(User::class, 'approved_by_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
