<?php


namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger
{
    public function generateUniqueSlug($name, $model, $ignoreId = null)
    {
        // Generate the initial slug
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Check for uniqueness
        while ($model::where('slug', $slug)->where('status', 1)->exists() || 
               ($ignoreId && $model::where('slug', $slug)->where('id', '!=', $ignoreId)->exists())) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}