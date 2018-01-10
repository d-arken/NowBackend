<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 14/06/2017
 * Time: 18:36
 */

namespace App\Media;



trait VideoPaths
{
    use ThumbPaths;
    public function getThumbFolderStorageAttribute(){
        return "videos/{$this->id}";
    }
    public function getFileFolderStorageAttribute(){
        return "videos/{$this->id}";
    }

    public function getFileAssetAttribute(){
        return $this->isLocalDriver() ?
            route('videos.file_asset',['video'=>$this->id]) :
            $this->file_path;
    }

    public function getSmallAssetAttribute(){
        return $this->isLocalDriver() ?
            route('videos.thumb_small_asset',['video'=>$this->id]) :
            $this->thumb_small_path;
    }

    public function getThumbAssetAttribute(){
        return $this->isLocalDriver() ?
            route('videos.thumb_asset',['video'=>$this->id]) :
            $this->thumb_path;
    }

    public function getThumbDefaultAttribute(){
        return env('DEFAULT_VIDEO_THUMB');
    }

    public function getFileRelativeAttribute(){
        return $this->file ? "{$this->file_folder_storage}/{$this->file}" : false;
    }

    public function getFilePathAttribute(){
        if($this->file_relative){
            return $this->getAbsolutePath($this->getDisk(),$this->file_relative);
        }
        return false;
    }


}