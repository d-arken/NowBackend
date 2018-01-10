<?php

namespace App\Models;


use App\Media\SeriePaths;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;


class Serie extends Model implements TableInterface
{
    use SeriePaths;
    protected $table= 'series';

    protected $fillable = ['id','title','description','thumb'];

    public function getTableHeaders()
    {
        return ['#'];
    }
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }
}

