<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CpLead;
use App\Utils\Util;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $cpLeads = CpLead::all();
        if(count($cpLeads) > 0) {
            $util = new Util();
            foreach ($cpLeads as $cpLead) {
                $ref_num = $util->generateCpWalkinRefNum($cpLead);
                $cpLead->ref_num = $ref_num;
                $cpLead->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpwalkinleads', function (Blueprint $table) {
            //
        });
    }
};
