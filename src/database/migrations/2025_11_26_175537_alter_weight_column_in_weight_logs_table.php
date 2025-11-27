<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterWeightColumnInWeightLogsTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE weight_logs MODIFY weight DECIMAL(5,1) NOT NULL;');
    }

    public function down()
    {
        DB::statement('ALTER TABLE weight_logs MODIFY weight DECIMAL(4,1) NOT NULL;');
    }
}
