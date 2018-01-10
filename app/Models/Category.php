<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements TableInterface
{
    use TransformableTrait;
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function getTableHeaders()
    {
        return ['#','Nome'];
    }
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
        }
    }
}
