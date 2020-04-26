<?php


namespace App\Helpers;


use App\Category;

/**
 * Class CategoriesStructure
 * @package App\Helpers
 */
class CategoriesStructure
{

    public static function getCategories()
    {
        //TODO Сделать структуру с parent и children
        return Category::all('id', 'name')
            ->push(['id' => 0,
                'name' => 'все'
            ])
            ->sortBy('id');
    }
}
