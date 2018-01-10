<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace App\Repositories;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb($id,UploadedFile $file);
}
