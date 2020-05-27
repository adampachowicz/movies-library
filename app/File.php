<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class File extends Model
{
    use SoftDeletes;

    private const WIDTH = 600;

    protected $fillable = [
        'name', 'mime_type', 'fileExtension', 'patch', 'size', 'movie_id'
    ];

    /**
     * @param UploadedFile $uploadedFile
     * @param int $movieId
     */
    public function insertGetName(UploadedFile $uploadedFile, int $movieId): void
    {
        $name = time().'_'. str_replace(' ', '-', $uploadedFile->getClientOriginalName());
        $path = $uploadedFile->move(public_path('files/'), $name);
        $size = $this->resizeImage(new Image, $path);


        $this->name = $name;
        $this->mime_type = $uploadedFile->getClientMimeType();
        $this->fileExtension = $uploadedFile->getClientOriginalExtension();
        $this->path = $path;
        $this->size = $size;
        $this->movie_id = $movieId;

        $this->save();
    }

    /**
     * @param Image $image
     * @param string $path
     * @return int
     */
    public function resizeImage(Image $image, string $path): int
    {
        $img = $image::make($path)->resize(self::WIDTH, null, function ($constraint) {
                    $constraint->aspectRatio();
        });

        $size = $img->filesize();
        $img->save();

        return $size;
    }
}
