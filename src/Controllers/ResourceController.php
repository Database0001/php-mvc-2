<?php

namespace Src\Controllers;

class ResourceController
{
    public function index()
    {
        return "index";
    }

    public function create()
    {
        return "create";
    }

    public function store()
    {
        return "store";
    }

    public function show($id)
    {
        return "show $id";
    }

    public function edit($id)
    {
        return "edit $id";
    }

    public function update($id)
    {
        return "update $id";
    }

    public function destroy($id)
    {
        return "destroy $id";
    }
}
