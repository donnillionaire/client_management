<?php

namespace App\Http\Controllers;
use App\Models\Sub_department;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubDepartmentController extends Controller
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
     * Return the list of subdepartment
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('dept_id')) {
            //
            $sub_dept = Sub_department::where('dept_id', $request->dept_id)->get();

        }
        else{

            $sub_dept = Sub_department::all();
        }

        return $this->successResponse($sub_dept);
    }

        /**
         * Create one new subdept
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'sub_dept_name' => 'required|max:100',
            'dept_id' => 'required',
        ];

        $this->validate($request, $rules);

        $sub_dept = Sub_department::create($request->all());

        return $this->successResponse($sub_dept, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one subdept
     * @return Illuminate\Http\Response
     */
    public function show($sub_dept)
    {
        $sub_dept = Sub_department::findOrFail($sub_dept);

        return $this->successResponse($sub_dept);
    }

    /**
     * Update an existing subdept
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $sub_dept)
    {
        $rules = [
            'sub_dept_name' => 'max:100',
        ];

        $this->validate($request, $rules);

        $sub_dept = Sub_department::findOrFail($sub_dept);

        $sub_dept->fill($request->all());

        if ($sub_dept->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $sub_dept->save();

        return $this->successResponse($sub_dept);
    }

    /**
     * Remove an existing subdept
     * @return Illuminate\Http\Response
     */
    public function destroy($sub_dept)
    {
        $sub_dept = Sub_department::findOrFail($sub_dept);

        $sub_dept->delete();

        return $this->successResponse($sub_dept);
    }

    //
}
