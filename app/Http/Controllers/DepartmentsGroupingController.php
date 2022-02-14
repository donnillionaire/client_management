<?php

namespace App\Http\Controllers;
use App\Models\Departments_grouping;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentsGroupingController extends Controller
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
     * Return the list of dept group
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('client_id')) {
            //
            $dept_group = Departments_grouping::where('client_id', $request->client_id)->get();

        }
        else{

            $dept_group = Departments_grouping::all();
        }
        return $this->successResponse($dept_group);
    }

        /**
         * Create one new dept group
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'group_name' => 'required|max:255',
            'client_id' => 'required',
        ];

        $this->validate($request, $rules);

        $dept_group = Departments_grouping::create($request->all());

        return $this->successResponse($dept_group, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one dept group
     * @return Illuminate\Http\Response
     */
    public function show($dept_group)
    {
        $dept_group = Departments_grouping::findOrFail($dept_group);

        return $this->successResponse($dept_group);
    }

    /**
     * Update an existing dept group
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $dept_group)
    {
        $rules = [
            'group_name' => 'max:255',
        ];

        $this->validate($request, $rules);

        $dept_group = Departments_grouping::findOrFail($dept_group);

        $dept_group->fill($request->all());

        if ($dept_group->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $dept_group->save();

        return $this->successResponse($dept_group);
    }

    /**
     * Remove an existing dept group
     * @return Illuminate\Http\Response
     */
    public function destroy($dept_group)
    {
        $dept_group = Departments_grouping::findOrFail($dept_group);

        $dept_group->delete();

        return $this->successResponse($dept_group);
    }

    //
}
