<?php
namespace App\Models;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Square implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(160, 160);
    }
}