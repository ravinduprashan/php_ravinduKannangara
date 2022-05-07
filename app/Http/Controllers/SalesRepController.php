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


    public function index()
    {
        $salesReps = $this->repository->all();
        $routes = Routes::all();
        return view('salesrep.index', compact('salesReps','routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Routes::all();
        return view('salesrep.edit', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routes = Routes::all();
        $salesrep = $this->repository->getUserById($id);
        return view('salesrep.edit', compact('salesrep','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->repository->delete($id);

        return redirect()->route('salesrep.list')
            ->with('success', 'Sales Rep deleted successfully');
    }
}
