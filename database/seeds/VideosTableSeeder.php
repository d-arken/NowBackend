<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $series */
        $series = \App\Models\Serie::all();
        $categories = \App\Models\Category::all();
        $repository = app(\App\Repositories\VideoRepository::class);
        $collectionThumbs = $this->getThumbs();
        $collectionVideos = $this->getVideos();
        factory(\App\Models\Video::class,10)->create()->each(function($v)use(
                                                                                $series,
                                                                                $categories,
                                                                                $repository,
                                                                                $collectionThumbs,
                                                                                 $collectionVideos){
            $repository->uploadThumb($v->id, $collectionThumbs->random());
            $repository->uploadFile($v->id, $collectionVideos->random());
            $v->categories()
                ->attach(
                    $categories->random(4)
                        ->pluck('id'));

            $n = rand(1,3);
            if($n%2==0){
                $serie = $series->random();
                $v->serie_id = $serie->id;
                $v->serie()->associate($serie);
                $v->save();
            }

        });
    }


    protected function getThumbs(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/default.jpg'),
                'default.jpg'),
        ]);
    }

    protected function getVideos(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/videos/Richard correndo da Pororoca ao som de Sweet Dreams.mp4'),
                'Richard correndo da Pororoca ao som de Sweet Dreams.mp4'),
        ]);
    }
}
