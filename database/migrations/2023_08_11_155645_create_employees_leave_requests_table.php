<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees_leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->foreign('leave_type')->references('name')->on('leave_requests');
            $table->integer('duration');
            $table->enum('duration_unit', ['hours', 'days', 'weeks', 'months']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('leave_reason');
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->text('deny_reason')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_leave_requests');
    }
};
