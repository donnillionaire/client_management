<?php

namespace App\Http\Controllers;
use App\Models\Clients_category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

        /**
     * Return the list of category
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $category = Clients_category::all();

        return $this->successResponse($category);
    }

        /**
         * Create one new category
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required|max:100',
        ];

        $this->validate($request, $rules);

        $category = Clients_category::create($request->all());

        return $this->successResponse($category, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one category
     * @return Illuminate\Http\Response
     */
    public function show($category)
    {
        $category = Clients_category::findOrFail($category);

        return $this->successResponse($category);
    }

    /**
     * Update an existing category
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
       
        $rules = [
            'category_name' => 'max:100',
        ];

        $this->validate($request, $rules);
        
        $category = Clients_category::findOrFail($category);

        $category->fill($request->all());

        if ($category->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category->save();

        return $this->successResponse($category);
    }

    /**
     * Remove an existing category
     * @return Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $category = Clients_category::findOrFail($category);

        $category->delete();

        return $this->successResponse($category);
    }

    //
}
