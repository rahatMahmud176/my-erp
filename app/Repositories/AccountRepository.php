<?php

namespace App\Repositories;

use App\Contracts\AccountInterface;
use App\Models\Backend\Account;

class AccountRepository implements AccountInterface
{
   public function branchAccounts()
   {
        return Account::branchAccounts();
   }
   public function all()
   {
        return Account::allAccounts();
   }
}