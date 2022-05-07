<?php

namespace App\Http\Controllers;

use App\Models\SalesRepresentatives;
use App\Models\Routes;
use App\Repositories\SalesRepresentativesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesRepController extends Controller
{
    private $repository;

    public function __construct(SalesRepresentativesRepository $repository)
    {
        $this->repository = $repository;
    }

// root page show sales rep all detail
    public function index()
    {
        $salesReps = $this->repository->all();
        $routes = Routes::all();
        return view('salesrep.index', compact('salesReps','routes'));
    }

//     create sales rep
    public function create()
    {
        $routes = Routes::all();
        return view('salesrep.edit', compact('routes'));
    }

//     store sales rep   
    public function store(Request $request)
    {
        $messages = [
            'first_name.required' => 'First name required',
            'last_name.required' => 'Last name required',
            'email.required' => 'Email required',
            ];

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ],$messages);

        $joined_date = '';

        if ($request->joined_date != null) {
            $joined_date = Carbon::createFromFormat('d/m/Y', $request->joined_date);
        }
        $routes = '';
        if ($request->routes != null) {
            $routes = array_combine($request->routes, $request->routes);
            $routes = join(",", $routes);
        }

        $attributes = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? '',
            'telephone' => $request->telephone ?? '',
            'joined_date' => $joined_date  ?? '',
            'working_routes' => $request->working_routes  ?? '',
            'comments' => $request->comments  ?? '',

        ];

        $email = $request->email;
        $duplicate_client = SalesRepresentatives::where('email',$email)->first();
        if($duplicate_client){
            return back()->with('error', 'We have found a Sales Rep record which may be a duplicate.')->with('duplicate_client',$duplicate_client->id)->with('duplicate_client_name',$duplicate_client->first_name)->withInput();
        }

        else{
            $salesrep = $this->repository->create($attributes);
            return redirect()->route('salesrep.list')
                ->with('success', 'Sales Representative ' . $salesrep->first_name . ' created successfully.');
        }
    }


    // edit sales rep view
    public function edit($id)
    {
        $routes = Routes::all();
        $salesrep = $this->repository->getUserById($id);
        return view('salesrep.edit', compact('salesrep','routes'));
    }

  // edit sales rep
    public function update(Request $request, $id)
    {
        $messages = [
            'first_name.required' => 'First name required',
            'last_name.required' => 'Last name required',
            'email.required' => 'Email required',
            ];

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ],$messages);

        $joined_date = '';

        if ($request->joined_date != null) {
            $joined_date = Carbon::createFromFormat('d/m/Y', $request->joined_date);
        }

        $attributes = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? '',
            'telephone' => $request->telephone ?? '',
            'joined_date' => $joined_date  ?? '',
            'working_routes' => $request->working_routes  ?? '',
            'comments' => $request->comments  ?? '',
        ];

        $this->repository->update($attributes, $request->id);

        return redirect()->route('salesrep.list')
            ->with('success', 'Sales Rep ' . $request->first_name . ' updated successfully');
    }
    
// delete sales rep
    public function delete($id)
    {
        $this->repository->delete($id);

        return redirect()->route('salesrep.list')
            ->with('success', 'Sales Rep deleted successfully');
    }
}
