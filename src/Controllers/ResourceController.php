<?php

namespace Src\Controllers;

use Modules\DB;
use Src\Models\User;

class ResourceController
{
    public function index()
    {
        
        $data = new User(0);

        print_r(
            $data->where([['id', '=', 1]])->get()
        );

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
