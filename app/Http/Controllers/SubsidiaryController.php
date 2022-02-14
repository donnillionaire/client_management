<?php

namespace App\Http\Controllers;
use App\Models\Subsidiary;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubsidiaryController extends Controller
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
     * Return the list of subsidiary
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('client_id')) {
            //
            $subsidiary = Subsidiary::where('client_id', $request->client_id)->get();

        }
        else{

            $subsidiary = Subsidiary::all();
        }

        return $this->successResponse($subsidiary);
    }

        /**
         * Create one new subsidiary
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'subsidiaries' => 'required|max:100',
        ];

        $this->validate($request, $rules);

        $subsidiary = Subsidiary::create($request->all());

        return $this->successResponse($subsidiary, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one subsidiary
     * @return Illuminate\Http\Response
     */
    public function show($subsidiary)
    {
        $subsidiary = Subsidiary::findOrFail($subsidiary);

        return $this->successResponse($subsidiary);
    }

    /**
     * Update an existing subsidiary
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $subsidiary)
    {
        $rules = [
            'subsidiaries' => 'max:100',
        ];

        $this->validate($request, $rules);
       

        $subsidiary = Subsidiary::findOrFail($subsidiary);

        $subsidiary->fill($request->all());

        if ($subsidiary->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $subsidiary->save();

        return $this->successResponse($subsidiary);
    }

    /**
     * Remove an existing subsidiary
     * @return Illuminate\Http\Response
     */
    public function destroy($subsidiary)
    {
        $subsidiary = Subsidiary::findOrFail($subsidiary);

        $subsidiary->delete();

        return $this->successResponse($subsidiary);
    }

    //
}
