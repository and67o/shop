<?php


namespace App\Helpers;


use App\Category;

/**
 * Class CategoriesStructure
 * @package App\Helpers
 */
class CategoriesStructure
{
    /**
     * @return array
     */
    public static function getCategories(): array
    {
        //TODO Сделать структуру с parent и children
        return Category::all('id', 'name')
            ->toArray();
    }
}
