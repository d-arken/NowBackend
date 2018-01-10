<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 14/06/2017
 * Time: 18:36
 */

namespace App\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait SeriePaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute(){
        return "series/{$this->id}";
    }

    public function getAssetAttribute(){
        return $this->isLocalDriver() ?
            route('series.thumb_asset',['serie'=>$this->id]) :
            $this->thumb_path;
    }

    public function getSmallAssetAttribute(){
        return $this->isLocalDriver() ?
            route('series.thumb_small_asset',['serie'=>$this->id]) :
            $this->thumb_small_path;
    }

    public function getThumbDefaultAttribute(){
        return env('DEFAULT_THUMB');
    }

}