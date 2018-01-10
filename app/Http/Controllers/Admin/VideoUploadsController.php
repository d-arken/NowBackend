<?php

namespace App\Http\Controllers\Admin;

use App\Forms\VideoRelationForm;
use App\Forms\VideoUploadForm;
use App\Models\Video;
use App\Repositories\VideoRepository;
use FormBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class VideoUploadsController extends Controller
{
    protected $repository;
    function __construct(VideoRepository $repository)
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Video $video)
    {
        $form = FormBuilder::create(VideoUploadForm::class,[
            'url'=>route('videos.uploads.store',['video'=>$video->id]),
            'method'=>'POST',
            'model'=> $video
        ]);

        return view('admin.videos.upload',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $form = FormBuilder::create(VideoUploadForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        if($request->file('thumb'))
            $this->repository->uploadThumb($id,$request->file('thumb'));
        if($request->file('file'))
            $this->repository->uploadFile($id,$request->file('file'));

        $this->repository->update(['duration'=>$request['duration']],$id);
        $request->session()->flash('message','Upload(s) realizado(s) com sucesso!');

        return redirect()->route('videos.uploads.create',['video'=>$id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
