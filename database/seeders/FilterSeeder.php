<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['PHP', 'Laravel', 'Бази даних', 'Веброзробка', 'JavaScript', 'Новини'];

        foreach ($names as $name) {
            Filter::firstOrCreate(['filter_name' => $name]);
        }
    }
}
