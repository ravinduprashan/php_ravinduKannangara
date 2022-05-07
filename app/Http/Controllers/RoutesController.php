<?php

namespace App\Http\Controllers;

use App\Models\Routes;
use App\Repositories\RoutesRepository;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    private $repository;

    public function __construct(RoutesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('routes.edit');
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
            'name' => 'Route name required',
            ];

        $this->validate($request,[
            'name' => 'required',
        ],$messages);

        $attributes = [
            'area' => $request->area ?? '',
            'name' => $request->name ?? '',
            'selected' => 0,
        ];

        $route = $this->repository->create($attributes);
        return redirect()->route('routes.create')
                ->with('success', 'Area route ' . $route->name . ' created successfully.');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
