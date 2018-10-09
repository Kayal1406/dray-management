<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class notification extends DatabaseNotification
{
    protected $table = 'notification';
}
