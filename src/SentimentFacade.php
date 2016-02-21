<?php

namespace Mintbridge\EloquentSentiment;

use Illuminate\Support\Facades\Facade;

class SentimentFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sentiments';
    }
}
