<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Media\VideoPaths;

class Video extends Model implements TableInterface
{
    use TransformableTrait, VideoPaths, SoftDeletes;

    protected $fillable = [
        'id',
		'title',
		'description',
		'duration',
        'file',
        'thumb',
        'serie_id',

	];

    protected $casts = [
        'completed'=>'boolean'
    ];

    public function serie(){
        return $this->belongsTo(Serie::class,'serie_id','id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
      return ['#'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
       switch($header){
           case '#':
               return $this->id;

               break;
       }
    }
}
