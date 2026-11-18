<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Filter;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [];

        foreach (['Новини', 'Технології', 'Події'] as $name) {
            $categories[] = Category::firstOrCreate(['category_name' => $name]);
        }

        $filterIds = Filter::pluck('filter_id')->all();

        for ($i = 1; $i <= 15; $i++) {
            $blog = Blog::updateOrCreate(
                ['title' => "Навчальний запис №{$i}"],
                [
                    'description' => "Короткий опис запису №{$i}",
                    'text'        => "Повний текст запису №{$i}.",
                    'category_id' => $categories[($i - 1) % count($categories)]->category_id,
                    'user_id'     => null,
                ]
            );

            // Кожному запису призначаємо 1-2 мітки
            if ($filterIds) {
                $blog->filters()->sync(array_slice($filterIds, $i % count($filterIds), 2));
            }
        }
    }
}
