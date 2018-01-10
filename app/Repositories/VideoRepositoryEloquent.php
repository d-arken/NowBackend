<?php

namespace App\Repositories;

use App\Media\ThumbUploads;
use App\Media\VideoUploads;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VideoRepository;
use App\Models\Video;


/**
 * Class VideoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    use VideoUploads;

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id); // TODO: Change the autogenerated stub
        if(isset($attributes['categories'])){
            $model->categories()->sync($attributes['categories']);
        }
        return $model;
    }

    public function model()
    {
        return Video::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
