<?php

namespace App\Contracts;

interface ItemInterface 
{
   public function all();
   public function newItem($request);
   public function updateItem($request,$item);
}