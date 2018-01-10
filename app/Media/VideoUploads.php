<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 27/06/2017
 * Time: 22:25
 */

namespace App\Media;
use Illuminate\Http\UploadedFile;

trait VideoUploads
{
    use ThumbUploads;
    public function uploadFile($id,UploadedFile $file){
        $model = $this->find($id);
        $name = $this->upload($model,$file,'file');
        if($name){
            $this->deleteFilesOld($model);
            $model->file = $name;
            $model->save();
        }
        return $model;
    }

    public function deleteFilesOld($model){
        $storage = $model->getDisk();
        if($storage->exists($model->file_relative))
            $storage->delete($model->file_relative);
    }
}