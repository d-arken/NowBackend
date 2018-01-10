<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 14/06/2017
 * Time: 20:57
 */

namespace App\Media;


use Illuminate\Filesystem\FilesystemAdapter;

use Illuminate\Http\UploadedFile;
use Image;
use Imagine\Image\Box;

trait ThumbUploads
{
    use Uploads;

    public function uploadThumb($id,UploadedFile $file){
        $model = $this->find($id);
        $name = $this->upload($model, $file, 'thumb');
        if($name){
            $this->deleteThumbsOld($model);
            $model->thumb = $name;
            $this->makeThumbSmall($model);
            $model->save();
        }
        return $model;
    }

    protected function makeThumbSmall($model){
        $storage = $model->getDisk();
        $thumbFile = $model->thumb_path;


        $format = Image::format($thumbFile);
        $thumbnailSmall = Image::open($thumbFile)
            ->thumbnail(new Box(128,64));
        $storage->put($model->thumb_small_relative, $thumbnailSmall->get($format));
    }

    public function deleteThumbsOld($model){
        $storage = $model->getDisk();
        if($storage->exists($model->thumb_relative) && $model->thumb != $model->thumb_default)
            $storage->delete([
                $model->thumb_relative,
                $model->thumb_small_relative]);
        
    }


}