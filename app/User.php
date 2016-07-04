<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Eloquent{
    
    use Authenticatable, CanResetPassword, EntrustUserTrait;
    ...
}
