<?php

namespace Mintbridge\EloquentSentiment;

interface SentimentableInterface
{
    public function sentiments();

    public function getSentimentableId();

    public function getSentimentableType();
}
