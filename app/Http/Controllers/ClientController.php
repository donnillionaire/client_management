<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
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
     * Return the list of clients
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $this->successResponse($clients);
    }

        /**
         * Create one new client
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
        $rules = [
            'address' => 'required|max:100',
            'phone' => 'required|max:50',
            'org_email' => 'required|max:100|email|unique:clients',
            'organization' => 'required|max:250',
            'category_id' => 'required',
            'client_status' => 'required',
            'sub_dept_exist' => 'required',
            'demo_acc' => 'required',
            'has_sister'  => 'required',
        ];

        if (!$request->hasFile('logo')) {
            $rules['logo'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
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

        $client = Client::create($request->all());

        return $this->successResponse($client, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one client
     * @return Illuminate\Http\Response
     */
    public function show($client)
    {
        $client = Client::findOrFail($client);

        return $this->successResponse($client);
    }

    /**
     * Update an existing client
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $client)
    {
        //how to check if email is unique even when doing update 
        //'org_email' => 'max:100|email|unique:clients,org_email,' . $client,
        $rules = [
            'address' => 'max:100',
            'phone' => 'max:50',
            'org_email' => 'max:100|email',
            'organization' => 'max:250',
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

        $client = Client::findOrFail($client);

        $client->fill($request->all());

        if ($client->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $client->save();

        return $this->successResponse($client);
    }

    /**
     * Remove an existing client
     * @return Illuminate\Http\Response
     */
    public function destroy($client)
    {
        $client = Client::findOrFail($client);

        $client->delete();

        return $this->successResponse($client);
    }

    //
}
