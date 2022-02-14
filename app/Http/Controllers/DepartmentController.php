<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
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
     * Return the list of dept
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('client_id')) {
            //
            $dept = Department::where('client_id', $request->client_id)->get();

        }
        else{

            $dept = Department::all();
        }

        return $this->successResponse($dept);
    }

        /**
         * Create one new dept
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'dept_address' => 'max:100',
            'dept_phone' => 'max:50',
            'dept_email' => 'max:100|email|unique:departments',
            'dept_name' => 'required|max:250',
            'client_id' => 'required',
        ];

        $this->validate($request, $rules);
        
        if ($request->hasFile('logo')) {

            $fileExtension = $request->file('logo')->getClientOriginalName(); 
            $file = pathinfo($fileExtension, PATHINFO_FILENAME); 
            $extension = $request->file('logo')->getClientOriginalExtension();  
            $fileStore = time() . '_' . $file . '.' . $extension;
            //storeAs() leads to the folder you'll be pushing the image to, for example storage/app/logos
            $path = $request->file('logo')->storeAs('logos', $fileStore); 

            $request->merge(['logo' => $path]);
       }

        $dept = Department::create($request->all());

        return $this->successResponse($dept, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one dept
     * @return Illuminate\Http\Response
     */
    public function show($dept)
    {
        $dept = Department::findOrFail($dept);

        return $this->successResponse($dept);
    }

    /**
     * Update an existing dept
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $dept)
    {
        $rules = [
            'dept_address' => 'max:100',
            'dept_phone' => 'max:50',
            'dept_email' => 'max:100|email',
            'dept_name' => 'max:250',
        ];

        $this->validate($request, $rules);
       
        if ($request->hasFile('logo')) {

            $fileExtension = $request->file('logo')->getClientOriginalName(); 
            $file = pathinfo($fileExtension, PATHINFO_FILENAME); 
            $extension = $request->file('logo')->getClientOriginalExtension();  
            $fileStore = time() . '_' . $file . '.' . $extension;
            //storeAs() leads to the folder you'll be pushing the image to, for example storage/app/logos
            $path = $request->file('logo')->storeAs('logos', $fileStore); 

            $request->merge(['logo' => $path]);
       }

        $dept = Department::findOrFail($dept);

        $dept->fill($request->all());

        if ($dept->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $dept->save();

        return $this->successResponse($dept);
    }

    /**
     * Remove an existing dept
     * @return Illuminate\Http\Response
     */
    public function destroy($dept)
    {
        $dept = Department::findOrFail($dept);

        $dept->delete();

        return $this->successResponse($dept);
    }

    //
}
