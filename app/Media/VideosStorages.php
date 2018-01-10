<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 14/06/2017
 * Time: 18:32
 */

namespace App\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait VideosStorages
{
    public function getDisk(){
        return \Storage::disk($this->getDiskDriver());
    }

    protected function getDiskDriver(){ //driver
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath){
        return $this->isLocalDriver() ? $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath) : $storage->url($fileRelativePath);
    }

    public function isLocalDriver(){
        $driver = config("filesystems.disks.{$this->getDiskDriver()}.driver");
        return $driver == 'local'; //ISSO É UMA CONDICAO Q RETORNA TRUE OU FALSE
    }

}