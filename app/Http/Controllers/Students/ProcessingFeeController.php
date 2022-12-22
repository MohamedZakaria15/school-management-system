<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\ProcessongFeeRepositoryInterface;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected $Processing;
    public function __construct(ProcessongFeeRepositoryInterface $Processing)
    {
        $this->Processing= $Processing;
    }

    public function index()
    {
        return $this->Processing->index();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->Processing->store($request);
    }


    public function show($id)
    {
        return $this->Processing->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->Processing->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->Processing->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Processing->destroy($request);
    }
}
