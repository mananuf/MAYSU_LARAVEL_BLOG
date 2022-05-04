<?php

namespace App\Repositories\Posts;

interface PostContract{
    public function create($request);
    public function show();
    public function findID($id);
    public function edit($id, $request);
    public function remove($id);
}