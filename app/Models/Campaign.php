<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
/**
 * Class Ad
 * @package App\Models
 * @property string id
 * @property int user_id
 * @property string title
 * @property string content
 * @property boolean isActive
 */
class Campaign extends Model
{
    use HasFactory;
    protected $collection = 'sanjagh_campaigns';
    protected $fillable = ["user_id", "title", "content"];

    public static function boot()
    {
        parent::boot();

        static::creating(
            function (Campaign $campaign) {
                $campaign['isActive'] = false;
                $campaign['user_id'] = auth()->user()->_id;
                return $campaign;
            });
    }


    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
