<?php

namespace Database\Seeders;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'          => 'Front-end',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae provident illum sapiente expedita beatae.',
            ],
            [
                'name'          => 'Back-end',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae provident illum sapiente expedita beatae.',
            ],
            [
                'name'          => 'Full-stack',
                'description'   => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae provident illum sapiente expedita beatae.',
            ],
        ];
        foreach ($categories as $category) {
            Type::create($category);
        }

    }
}
