<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class UserGroup
 * @package App\Models
 * @property string _id
 * @property string title
 */
class UserGroup extends Model
{
    use HasFactory;
    protected $collection = 'sanjagh_user_group';
    protected $fillable = ["title"];
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
