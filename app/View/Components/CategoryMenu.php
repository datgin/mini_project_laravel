<?php

namespace App\View\Components;

use App\Helpers\CategoryHelper;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $categoryTreeHtml;
    public function __construct()
    {
        $categories = Category::all();
        $this->categoryTreeHtml = CategoryHelper::renderCategoryTree($categories);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-menu');
    }
}
