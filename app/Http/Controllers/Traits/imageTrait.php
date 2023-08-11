<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;

trait imageTrait
{
    public function storeImage($image)
    {
        $fileName = time() . $image->getClientOriginalName();
        Storage::disk('public')->put($fileName, file_get_contents($image));
        return 'storage/' . $fileName;
    }

    public function deleteImage($imagePath)
    {
        $imagePath = str_replace('storage/', '', $imagePath);

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

    }

}
