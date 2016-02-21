<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Auditing Events
    |--------------------------------------------------------------------------
    |
    | The default events to record if none have been specified on the model
    |
    */
    'sentiments' => [
        'like',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activity Model
    |--------------------------------------------------------------------------
    |
    | The model to be used for recording events
    |
    */
    'model' => Mintbridge\EloquentSentiment\Sentiment::class,

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The user model to associate with the recorded event, defaults to the app
    | user model
    |
    */
    'user' => App\User::class,

];
