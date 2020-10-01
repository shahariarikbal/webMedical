<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->integer('services')->nullable()->after('logo');
            $table->float('developing_fee', 8,2)->nullable()->after('services');
            $table->float('monthly_charge', 8,2)->nullable()->after('developing_fee');
            $table->string('methods_name')->nullable()->after('monthly_charge');
            $table->string('sender_account_number')->nullable()->after('methods_name');
            $table->string('receipt')->nullable()->after('sender_account_number');
            $table->string('status')->default(0)->after('receipt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            Schema::dropIfExists('services');
            Schema::dropIfExists('developing_fee');
            Schema::dropIfExists('monthly_charge');
            Schema::dropIfExists('methods_name');
            Schema::dropIfExists('sender_account_number');
            Schema::dropIfExists('receipt');
            Schema::dropIfExists('status');
        });
    }
}
