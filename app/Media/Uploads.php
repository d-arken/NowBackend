<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 27/06/2017
 * Time: 22:27
 */

namespace App\Media;


use Illuminate\Http\UploadedFile;

trait Uploads
{
    protected function upload($model,UploadedFile $file, $type){
        /** @var FilesystemAdapter $storage */
        $storage = $model->getDisk();
        $name = md5(time()."{$model->id}-{$file->getClientOriginalName()}") . ".{$file->guessExtension()}";
        $result=$storage->putFileAs($model->{"{$type}_folder_storage"}, $file, $name);
        return $result ? $name : $result;
    }
}