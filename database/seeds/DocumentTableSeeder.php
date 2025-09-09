<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'Drawing',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'Letter of Intent (LOI)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'Loading vs Capacity',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'Tooling Progress Report (TPR)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'P3-Plan',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'SE Activity',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-1','documents' =>'SPTT-1 Form',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Supply Chain Management (SCM)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Quality Control Process Chart (QCPC)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Part Inspection Sheet (PIS)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Layout Inspection',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'PISS (Part Identification Standard Sheet)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'PESS (Part Evaluation Status Sheet)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Check Sheet',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'SoC Free',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Mill Sheet',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Cp CPk',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Material Safety Data Sheet (MSDS)',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Risk Management',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Measurement System Analysis (MSA) Report',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Packing Specification',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'PFMEA',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'QC Plan',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Logistic Supplier',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Test Report',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'Process Flow Diagram',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-2','documents' =>'SPTT-2 Form',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-3','documents' =>'Data HVPT',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-3','documents' =>'Initial Control Form',]);
        DB::table('documents')->insert(['kinds_doc' => 'SPTT-3','documents' =>'SPTT-3 Form',]);
    }
}
