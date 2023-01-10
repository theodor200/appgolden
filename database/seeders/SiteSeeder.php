<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert(
            [
                'name'=>'ENTEL PERU S.A.',
                'customer_id'=>'5e456077e17c9d001b8d9167',
                'email'=>'soportehp_entel@goldenroad.com.pe',
                'sid'=>'s%3A2iYRJaTrUSGD56zVg9auwRBrkHR3_L5t.Vlf%2FUsz%2Fqq%2BkcmqJBqWR6KSftOg96%2BZ2wnadvihr6Cc'
            ]
        );
        DB::table('sites')->insert(
            [
                'name'=>'Glencore Peru SAC',
                'customer_id'=>'5c8bb94cb70117001ca91d91',
                'email'=>'soporte.impresion@glencore.com.pe',
                'sid'=>'s%3AMYfMuLS2zM9_YoPiUDCLloJ6ivcumD1p.OagRjiGaF%2BteVo3zOJFLbNvOUqLhHZv8mEa3D8gc5qc'
            ]
        );
        DB::table('sites')->insert(
            [
                'name'=>'Anglo American Peru S.A',
                'customer_id'=>'57ed8e36a4344b163c175672',
                'email'=>'impresiones.peru@angloamerican.com',
                'sid'=>'s%3AwU7FYtotJoXpWUhu3eL6G-l17b1eK3qs.HAscx%2F5K9wfZJlIX28ehNpFAaPyj1hDjoFixZ22nv4E'
            ]
        );
        DB::table('sites')->insert(
            [
                'name'=>'DHL Express Peru SAC',
                'customer_id'=>'59f347a25da9bfa341c46130',
                'email'=>'soportehp_dhl@goldenroad.com.pe',
                'sid'=>'s%3A5yA2dQqBjaOeC-xZOIZTPukuYMKKW4Vj.gjBu%2F5H69QpcS3DLsCUWl6nVHMLpIPditebyep32pvQ'
            ]
        );
        DB::table('sites')->insert(
            [
                'name'=>'DIVEIMPORT S.A.',
                'customer_id'=>'5f34730888f6e10012fcbd0d',
                'email'=>'theodor.cardenas@goldenroad.com.pe',
                'sid'=>'s%3Aa2Jo2eSRa9b4nc89bYK1sNt6C_ZOTaq3.oeBPfwldf4ObhMvNs4QHN3hlgoxJrrch6sPntmhmJck'
            ]
        );
    }
}
