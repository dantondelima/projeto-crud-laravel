<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Storage;
class ImageRepository extends Controller
{
public function saveImage($image)
    {
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->getClientOriginalExtension();
            $fileName = time() . random_int(100, 999) .'.' . $extension; 
            $destinationPath = public_path('uploads/users/');
            $url = 'uploads/users/'.$fileName;
            $fullPath = $destinationPath.$fileName;
            $image = Image::make($file)->encode('jpg');
            $image->save($fullPath, 100);
            return $url;
        } else {
            return 'http://'.$_SERVER['HTTP_HOST'].' /uploads/users'.'/placeholder300x300.jpg';
        }
    }
    public function saveImageThumbnail($image, $size)
    {
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->getClientOriginalExtension();
            $fileName = 'thumbnail' . time() . random_int(100, 999) .'.' . $extension; 
            $destinationPath = public_path('uploads/users/thumbnail/');
            $url = 'uploads/users/thumbnail/'.$fileName;
            $fullPath = $destinationPath.$fileName;
            $image = Image::make($file)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg');
            $image->save($fullPath, 100);
            return $url;
        } else {
            return $image;
        }
    }
    
    public function apagarImages($foto, $fotothun)
    {
        unlink(public_path($foto));
        unlink(public_path($fotothun));
    }
}