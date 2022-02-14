<?php

namespace App\Http\Controllers;
use App\Models\Modules;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    use ApiResponser;
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
     * Return the list of module
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::all();

        return $this->successResponse($module);
    }

        /**
         * Create one new client
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'module_name' => 'required|max:100',
        ];

        $this->validate($request, $rules);

        $module = Module::create($request->all());

        return $this->successResponse($module, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one client
     * @return Illuminate\Http\Response
     */
    public function show($module)
    {
        $module = Module::findOrFail($module);

        return $this->successResponse($module);
    }

    /**
     * Update an existing client
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $module)
    {
        $rules = [
            'module_name' => 'max:100',
        ];

        $this->validate($request, $rules);

        $module = Module::findOrFail($module);

        $module->fill($request->all());

        if ($module->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $module->save();

        return $this->successResponse($module);
    }

    /**
     * Remove an existing client
     * @return Illuminate\Http\Response
     */
    public function destroy($module)
    {
        $module = Module::findOrFail($module);

        $module->delete();

        return $this->successResponse($module);
    }

    //
}
