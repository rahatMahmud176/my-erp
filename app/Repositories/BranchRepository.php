<?php

namespace App\Repositories;

use App\Contracts\BranchInterface;
use App\Models\Backend\Branch;

class BranchRepository implements BranchInterface
{
    public function all()
    {
        return Branch::all();
    }
    public function store($request)
    {
        Branch::newBranch($request);
    }
    public function update($request,$category)
    {
        Branch::branchUpdate($request,$category);
    }
}