<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyVisitsTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
         Schema::table('visits', function (Blueprint $table) {
            $table->timestamp('dt')->after('status')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
