<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'parent_id', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function descendantsAndSelf($id)
    {
        return $this->descendantsAndSelfQuery($id)->get();
    }

    public function descendantsAndSelfQuery($id)
    {
        return $this->where('parent_id', $id)->orWhere('id', $id);
    }

    public static function tree()
    {
        $allCategories = Category::get();

        $rootCategories = $allCategories->whereNull('parent_id');

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {

            $category->children = $allCategories->where('parent_id', $category->id)->values();

            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }
}
