<?php

namespace App\Repository;

use App\Http\Requests\StoreFeesRequest;

interface FeesRepositoryInterface
{
    public function index();
    public function create();

    public function edit($id);

    public function show($id);

    public function store( $request);

    public function update($id);

    public function destroy($request);











}
