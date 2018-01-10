<?php

namespace App\Http\Controllers\Admin;

use App\Forms\SerieForm;
use App\Models\Serie;
use App\Repositories\SerieRepository;
use FormBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{

    protected $repository;
    public function __construct(SerieRepository $repository)
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
        $serie = $this->repository->paginate();
        return view('admin.series.index',compact('serie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(SerieForm::class,[
            'url'=>route('series.store'),
            'method'=>'POST',
        ]);
        return view('admin.series.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(SerieForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $data['thumb'] = env('DEFAULT_THUMB');
        Model::unguard();
        $this->repository->create($data);
        $request->session()->flash('message','Série criada!');

        return redirect()->route('series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $series)
    {

        return view('admin.series.show',compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series){


        $form = FormBuilder::create(SerieForm::class,[
            'url'=>route('series.update',['serie'=>$series->id]),
            'method'=>'PUT',
            'model'=>$series,
            'data' => ['id'=> $series->id],
        ]);

        return view('admin.series.edit',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = FormBuilder::create(SerieForm::class, [
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

        $request->session()->flash('message','Série atualizada!');

        return redirect()->route('series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->session()->flash('message','Série deletada!');
        $this->repository->delete($id);
        return redirect()->route('series.index');
    }

    public function thumb_asset(Serie $serie){
        return response()->download($serie->thumb_path);

    }
    public function thumb_small_asset(Serie $serie){
        return response()->download($serie->thumb_small_path);

    }
}
