<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Category extends Model
{
    protected $table = 'categories';


    public static function getCategories1(): array
    {
        $categories = self::all('id', 'name');
        return $categories->map(function (self $category) use ($categories) {
            return [
                'id' => $category->id,
                'children' => $categories
                    ->where('parent_id', $category->id)
                    ->toArray(),
                'parent' => $category->parent_id
            ];
        })->toArray();
    }
}
