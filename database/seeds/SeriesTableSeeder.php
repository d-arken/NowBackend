<?php

use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $series =  factory(\App\Models\Serie::class,20)->create();
        $repository = app(\App\Repositories\SerieRepository::class);
        $collectionThumbs = $this->getThumbs();
        $series->each(function($series)use($repository, $collectionThumbs){
            $repository->uploadThumb($series->id, $collectionThumbs->random());
        });
    }

    protected function getThumbs(){
        return new \Illuminate\Support\Collection([
           new \Illuminate\Http\UploadedFile(
               storage_path('app/files/faker/thumbs/default.jpg'),
               'default.jpg'),
        ]);
    }
}
