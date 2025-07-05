<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('account_name');
            $table->decimal('amount', 15, 2)->default(0.00);

            // Enum yang umum digunakan di Indonesia
            $table->enum('account_type', [
                'Cash',          // Uang Tunai
                'Bank Account',  // Rekening Bank (BCA, Mandiri, dll.)
                'E-Wallet',      // Dompet Digital (GoPay, OVO, Dana, ShopeePay)
                'Credit Card',   // Kartu Kredit
                'E-Money',       // Kartu Uang Elektronik (Flazz, Brizzi, TapCash)
                'Investment'     // Rekening Investasi (Reksadana, Saham, dll.)
            ]);

            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
