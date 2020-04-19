<?php


namespace App\Http\ViewComposers;


use App\Helpers\CategoriesStructure;
use Illuminate\View\View;

/**
 * Class CategoriesComposer
 * @package App\Http\ViewComposers
 */
class CategoriesComposer
{
    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view): View
    {
        return $view->with('categories', CategoriesStructure::getCategories());
    }
}
