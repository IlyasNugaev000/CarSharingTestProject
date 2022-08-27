<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public const COL_USER_ID='user_id';
    public const COL_NAME='name';
    public const COL_STATE_NUMBER='state_number';

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->{self::COL_USER_ID};
    }

    public function getName()
    {
        return $this->{self::COL_NAME};
    }

    public function getStateNumber()
    {
        return $this->{self::COL_STATE_NUMBER};
    }
}
