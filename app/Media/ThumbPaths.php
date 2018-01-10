<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 27/06/2017
 * Time: 21:06
 */

namespace App\Media;

use Illuminate\Filesystem\FilesystemAdapter;

trait ThumbPaths
{
    use VideosStorages;

    public function getThumbRelativeAttribute(){
        return $this->thumb ? "{$this->thumb_folder_storage}/{$this->thumb}" : false;
    }

    public function getThumbPathAttribute(){
        if($this->thumb_relative){
            return $this->getAbsolutePath($this->getDisk(),$this->thumb_relative);
        }
        return false;
    }

    public function getThumbSmallRelativeAttribute(){
        if($this->thumb){
            list($name,$extension) =  explode('.',$this->thumb);
            return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
        }
        return false;
    }

    public function getThumbSmallPathAttribute(){
        if($this->thumb_relative){
            return $this->getAbsolutePath($this->getDisk(),$this->thumb_small_relative);
        }
        return false;
    }



}