<?php

namespace App\Helpers;

class CategoryHelper
{
    public static function renderCategoryTree($categories, $parent_id = null)
    {
        $html = '';

        // Find categories that have the specified parent_id
        $filteredCategories = $categories->where('parent_id', $parent_id);

        // If this is the root category, start with <ul>
        if (is_null($parent_id)) {
            $html .= '<ul class="sub-menu">';
        }

        foreach ($filteredCategories as $category) {
            $hasChildren = $categories->where('parent_id', $category->id)->isNotEmpty();
            $html .= '<li class="dropdown position-static"><a href="'. route('categories', $category->slug) .'">' . $category->name;
            if ($hasChildren) {
                $html .= '<i class="ecicon eci-angle-right"></i>';
            }
            $html .= '</a>';

            // Render children recursively
            $childrenHtml = self::renderCategoryTree($categories, $category->id);
            if ($childrenHtml) {
                $html .= '<ul class="sub-menu sub-menu-child">' . $childrenHtml . '</ul>';
            }

            $html .= '</li>';
        }

        // If this is the root category, close <ul>
        if (is_null($parent_id)) {
            $html .= '</ul>';
        }

        return $html;
    }
}
