<?php

namespace App\Http\Controllers\Admin;

use App\Forms\CategoryForm;
use App\Http\Controllers\Controller;
use FormBuilder;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;


class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    public function __construct(CategoryRepository $repository)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $categories = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $categories,
            ]);
        }

        return view('admin.categories.index', compact('categories'));

    }

    public function create()
    {
        $form = FormBuilder::create(CategoryForm::class,[
            'url'=>route('categories.store'),
            'method'=>'POST',
        ]);
        return view('admin.categories.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {

        try {
            $form = FormBuilder::create(CategoryForm::class);
            if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }
            $category = $this->repository->create($form->getFieldValues());

            $response = [
                'message' => 'Categoria criada.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('categories.index')->with('message', $response['message']);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $category,
            ]);
        }

        return view('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = $this->repository->find($id);

        $form = FormBuilder::create(CategoryForm::class,[
            'url'=>route('categories.update',['category'=>$category->id]),
            'method'=>'PUT',
            'model'=> $category
        ]);



        return view('admin.categories.edit',compact('form'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        try {

            $form = FormBuilder::create(CategoryForm::class, [
                'data' => ['id' => $id]
            ]);
            if(!$form->isValid()){
                return redirect()
                    ->back()
                    ->withErrors($form->getErrors())
                    ->withInput();
            }

            $category = $this->repository->update($form->getFieldValues(), $id);

            $response = [
                'message' => 'Categoria atualizada.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('categories.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Categoria removida.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('categories.index')->with('message', 'Category deleted.');
    }
}
