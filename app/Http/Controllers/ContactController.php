<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
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
     * Return the list of category
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $where = array([]);
         if ($request->has('client_id')) {             
             $client = array('client_id', '=', $request->client_id);
             $where[count($where)] = $client;
         }
         if ($request->has('dept_id')) {
             $dept = array('dept_id', '=', $request->dept_id);
             $where[count($where)] = $dept;
         }
         if ($request->has('sub_dept_id')) {
             $subdept = array('sub_dept_id', '=', $request->sub_dept_id);
             $where[count($where)] = $subdept;
         }
         if ($request->has('group_id')) {
            $group_id = array('group_id', '=', $request->group_id);
            $where[count($where)] = $group_id;
        }     

        if ($request->has('client_id') || $request->has('dept_id')  || $request->has('sub_dept_id')  || $request->has('group_id') ) {
            //
            $contact = Contact::where($where)->get();
        }
        else{
            if ($request->has('user_id')){
                $contact = Contact::findOrFail($request->user_id);
            }else{
                $contact = Contact::all();
            }
        }
        return $this->successResponse($contact);
    }

        /**
         * Create one new contact
         * @return Illuminate\Http\Response
         */
    public function store(Request $request)
    {
         $rules = [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone' => 'required|max:50',
            'title' => 'required|max:255',
            'client_id' => 'required',
            'user_id' => 'required',
            'modules' => 'required|max:100',
            'can_update' => 'required',
        ];

        $this->validate($request, $rules);

        $contact = Contact::create($request->all());

        return $this->successResponse($contact, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one contact
     * @return Illuminate\Http\Response
     */
    public function show($contact)
    {
        $contact = Contact::findOrFail($contact);

        return $this->successResponse($contact);
    }

    /**
     * Update an existing contact
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $contact)
    {
        $rules = [
            'first_name' => 'max:100',
            'last_name' => 'max:100',
            'phone' => 'max:50',
            'title' => 'max:255',
            'modules' => 'max:100',
        ];

        $this->validate($request, $rules);

        $contact = Contact::findOrFail($contact);

        $contact->fill($request->all());

        if ($contact->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $contact->save();

        return $this->successResponse($contact);
    }

    /**
     * Remove an existing contact
     * @return Illuminate\Http\Response
     */
    public function destroy($contact)
    {
        $contact = Contact::findOrFail($contact);

        $contact->delete();

        return $this->successResponse($contact);
    }

    //
}
