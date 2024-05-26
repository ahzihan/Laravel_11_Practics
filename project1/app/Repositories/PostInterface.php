<?php

namespace App\Repositories;

interface PostInterface
{
    public function all();
    public function index();
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function delete($id);
}
