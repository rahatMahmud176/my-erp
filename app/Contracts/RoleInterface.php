<?php
namespace App\Contracts;

interface RoleInterface
{
    public function all();
    public function create($request);
}