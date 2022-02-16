<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Ad
 * @package App\Models
 * @property int id
 * @property string campaign_id
 * @property string title
 * @property string content
 * @property boolean isActive
 */
class Ad extends Model
{
    use HasFactory;
    protected $collection = 'sanjagh_ads';
    protected $fillable = ["campaign_id", "title", "content"];

    public static function boot()
    {
        parent::boot();

        static::creating(
            function (Ad $ad) {
                $ad['isActive'] = false;
                return $ad;
            });
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
