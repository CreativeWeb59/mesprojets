<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // ajout des categories

        // On commence par créer des commentaires de premier niveau :
        /* Category::factory()->create([
            'name' => 'Pain',
            'slug' => 'pain',
            'product_id' => 1,
        ]);

        Category::factory()->create([
            'name' => 'Viennoiserie',
            'slug' => 'viennoiserie',
            'product_id' => 2,
        ]); */

        // niveau 2
        /*$faker = \Faker\Factory::create();
        Category::create([
            'name' => 2,
            'slug' => 3,
            'children' => [
            [
                'name' => 2,
                'slug' => 4,
                'children' => [
                    [
                        'name' => 2,
                        'slug' => 2,
                    ],
                ],
            ],
        ],
        ]);*/

        $lesCategories = [
            [
                'name' => 'Pain',
                'slug' => 'Pain',
                'product_id' => 1,
                    'children' => [
                        [    
                            'name' => 'Baguette',
                            'slug' => 'Baguette',
                            'product_id' => 1,
                        /*    'children' => [
                                    ['category_name' => 'Marvel Comic Book'],
                                    ['category_name' => 'DC Comic Book'],
                                    ['category_name' => 'Action comics'],
                            ],*/
                        ],
                        [    
                            'name' => 'Pains bio',
                            'slug' => 'Pains-bio',
                            'product_id' => 1,
                         /*       'children' => [
                                    ['category_name' => 'Business'],
                                    ['category_name' => 'Finance'],
                                    ['category_name' => 'Computer Science'],
                            ],*/
                        ],
                    ],
                ],
                [
                    'name' => 'Vienoiserie',
                    'slug' => 'Vienoiserie',
                    'product_id' => 2,
                        'children' => [
                        [
                            'name' => 'Classiques',
                            'slug' => 'Classiques',
                            'product_id' => 2,
                    /*        'children' => [
                                ['category_name' => 'LED'],
                                ['category_name' => 'Blu-ray'],
                            ],*/
                        ],
                        [
                            'name' => 'Brioches',
                            'slug' => 'Brioches',
                            'product_id' => 2,
                        /*    'children' => [
                                ['category_name' => 'Samsung'],
                                ['category_name' => 'iPhone'],
                                ['category_name' => 'Xiomi'],
                            ],*/
                        ],
                    ],
                ],
        ];
        foreach($lesCategories as $laCategorie)
        {
            Category::create($laCategorie);
        }
    }

    
}
