<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Spatie\Activitylog\Traits\LogsActivity;

class AccountsPortal extends Model
{
    use Notifiable, HasRoleAndPermission, LogsActivity;
}
