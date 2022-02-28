<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BussinesSideers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ame',
        // 'rfc',
        // 'legal_representative',
        // 'number'
        Business::create([
        'name' => 'Rancheritos',
        'rfc' => 'DHK120478LMN',
        'legal_representative' => 'Alberto Perez Zambrano',
        'number' => 9612314714
        ]);
    }
}
