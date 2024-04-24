<?php

namespace App\Contracts;

interface BranchInterface
{
    public function all();
    public function store($request);
    public function update($request,$branch);
}