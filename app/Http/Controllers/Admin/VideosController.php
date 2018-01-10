<?php

namespace App\Http\Controllers\Admin;

use App\Forms\VideoForm;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Repositories\VideoRepository;
use FormBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    protected $repository;
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(VideoForm::class,[
            'url'=>route('videos.store'),
            'method'=>'POST',
        ]);
        return view('admin.videos.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(VideoForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $data['thumb'] = "thumb.jpg";
        Model::unguard();
        $this->repository->create($data);
        $request->session()->flash('message','Vídeo criado!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $video,
            ]);
        }
        return view('admin.videos.show',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $form = FormBuilder::create(VideoForm::class,[
            'url'=>route('videos.update',['video'=>$video->id]),
            'method'=>'PUT',
            'model'=> $video
        ]);

        return view('admin.videos.edit',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = FormBuilder::create(VideoForm::class, [
            'data' => ['id' => $id]
        ]);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $this->repository->update($data,$id);

        $request->session()->flash('message','Vídeo atualizado!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->session()->flash('message','Vídeo deletado!');
        $this->repository->delete($id);
        return redirect()->route('videos.index');
    }

    public function file_asset(Video $video){
        return response()->download($video->file_path);

    }

    public function thumb_asset(Video $video){
        return response()->download($video->thumb_path);

    }
    public function thumb_small_asset(Video $video){
        return response()->download($video->thumb_small_path);

    }
}
