<?php

namespace Mintbridge\EloquentSentiment;

use Auditor;
use Config;

trait Sentimentable
{
    /**
     * Get all of the activities performed on the model
     */
    public function sentiments()
    {
        return $this->morphMany(Config::get('eloquent-sentiment.model'), 'sentimentable');
    }

    /**
     * Get the sentimentable id for the model
     */
    public function getSentimentableId()
    {
        return $this->id;
    }

    /**
     * Get the sentimentable type for the model
     */
    public function getSentimentableType()
    {
        return get_class($this);
    }
}
