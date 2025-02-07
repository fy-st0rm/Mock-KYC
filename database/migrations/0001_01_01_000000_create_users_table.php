<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string("number", 14)->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date("dob");
            $table->string("nationality");
            $table->text("address");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create("user_government_datas", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                  ->constrained("users")
                  ->onDelete("cascade");
            $table->enum("id_type", ['Passport', 'National ID', 'Driver License']);
            $table->string("id_number");
            $table->string("issued_country");
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_government_datas');
        Schema::dropIfExists('sessions');
    }
};
