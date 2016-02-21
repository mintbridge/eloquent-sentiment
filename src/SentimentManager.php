<?php

namespace Mintbridge\EloquentSentiment;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Mintbridge\EloquentSentiment\Activity;
use Mintbridge\EloquentSentiment\SentimentableInterface;

class SentimentManager
{
    public $sentiments;

    /**
     * @param \League\Fractal\Manager $manager
     */
    public function __construct(array $sentiments)
    {
        $this->sentiments = $sentiments;
    }

    public function __call($name, $arguments)
    {
        if (in_array($name, $this->sentiments)) {
            $this->toggle($name, $arguments[0]);
        }
    }

    /**
     * Toggle the sentiment on the given model for the user (if any)
     *
     * @param string $sentiment
     * @param \Mintbridge\EloquentSentiment\SentimentableInterface $model
     */
    public function toggle($sentiment, SentimentableInterface $model)
    {
        $user = Auth::user();

        $method = (($this->exists($sentiment, $model, $user)) ? 'remove' : 'add');

        return $this->{$method}($sentiment, $model, $user);
    }

    /**
     * Add the sentiment to the given model for the user (if any)
     *
     * @param string $sentiment
     * @param \Mintbridge\EloquentSentiment\SentimentableInterface $model
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function add($sentiment, SentimentableInterface $model, Authenticatable $user)
    {
        $sentiment = new Sentiment([
            Sentiment::ATTR_SENTIMENT => $sentiment
        ]);

        if ($user) {
            $sentiment->user()->associate($user);
        }

        return $model->sentiments()->save($sentiment);
    }

    /**
     * Remove the sentiment from the given model for the user (if any)
     *
     * @param string $sentiment
     * @param \Mintbridge\EloquentSentiment\SentimentableInterface $model
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function remove($sentiment, SentimentableInterface $model, Authenticatable $user)
    {
        $query = $this->query($sentiment, $model, $user);

        return $query->delete();
    }

    /**
     * Check if the sentiment is on the given model for the user (if any)
     *
     * @param string $sentiment
     * @param \Mintbridge\EloquentSentiment\SentimentableInterface $model
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function exists($sentiment, SentimentableInterface $model, Authenticatable $user)
    {
        $query = $this->query($sentiment, $model, $user);

        return $query->exists();
    }

    /**
     * Create the query for the sentiment, modal and user
     *
     * @param string $sentiment
     * @param \Mintbridge\EloquentSentiment\SentimentableInterface $model
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function query($sentiment, SentimentableInterface $model, Authenticatable $user)
    {
        $query = Sentiment::where(Sentiment::ATTR_SENTIMENTABLE_ID, '=', $model->getSentimentableId())
            ->where(Sentiment::ATTR_SENTIMENTABLE_TYPE, '=', $model->getSentimentableType())
            ->where(Sentiment::ATTR_SENTIMENT, '=', $sentiment)
            ->where(Sentiment::ATTR_USER_ID, '=', $user->getAuthIdentifier());

        return $query;
    }
}
