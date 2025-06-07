<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('balance_id')->constrained()->onDelete('restrict');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('idr');
            $table->date('date');
            $table->text('description')->nullable();
            $table->enum('payment_method', ['cash', 'credit_card', 'debit_card', 'bank_transfer', 'other'])->nullable();
            $table->string('reference')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_interval')->nullable();
            $table->date('recurring_end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};