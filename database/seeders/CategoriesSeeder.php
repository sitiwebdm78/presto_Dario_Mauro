<?php

namespace Database\Seeders;

use App\models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public $categories = [
        'Elettronica',
        'Abbigliamento',
        'Salute e Bellezza',
        'Spiritualità e Evoluzione',
        'Hobby e Fai da te',
        'Casa e Giardinaggio',
        'Giocattoli',
        'Sport',
        'Animali Domestici',
        'Libri e Riviste',
        'Accessori',
        'Motori'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories as $category){
            Category::create([
                'name' => $category
            ]);
        }

    }
}
