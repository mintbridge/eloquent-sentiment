<?php

namespace Mintbridge\EloquentSentiment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Sentiment extends Model
{
    const ATTR_ID                 = 'id';
    const ATTR_SENTIMENTABLE_ID   = 'sentimentable_id';
    const ATTR_SENTIMENTABLE_TYPE = 'sentimentable_type';
    const ATTR_USER_ID            = 'user_id';
    const ATTR_SENTIMENT          = 'sentiment';
    const ATTR_CREATED_AT         = 'created_at';
    const ATTR_UPDATED_AT         = 'updated_at';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sentiments';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        self::ATTR_CREATED_AT,
        self::ATTR_UPDATED_AT,
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTR_SENTIMENT,
    ];

    /**
     * Get the user that the perform the action.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(Config::get('eloquent-sentiment.user'), self::ATTR_USER_ID);
    }

    /**
     * Get all of the owning sentimentable models.
     */
    public function sentimentable()
    {
        return $this->morphTo();
    }
}
