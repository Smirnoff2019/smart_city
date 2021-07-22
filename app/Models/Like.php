<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'point_likes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'point_id', 'level'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

    /**
     * @return BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return BelongsTo
     */
    public function points()
    {
        return $this->belongsTo(Point::class);
    }
}
