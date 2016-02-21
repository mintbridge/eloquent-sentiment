<?php
namespace Mintbridge\EloquentSentiment\Test;

use Illuminate\Support\Facades\Config;
use Mintbridge\EloquentSentiment\Sentiment;
use Mockery as m;

class SentimentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_creates_the_morph_to_relationship()
    {
        $sentiment = m::mock(Sentiment::class)->makePartial();

        $sentiment
            ->shouldReceive('morphTo')
            ->once()
            ->andReturn('ok');

        $this->assertEquals(
            $sentiment->sentimentable(),
            'ok'
        );
    }

    /**
     * @test
     */
    public function it_creates_the_user_relationship()
    {
        Config::shouldReceive('get')
            ->once()
            ->with('eloquent-sentiment.user')
            ->andReturn('UserClass');

        $sentiment = m::mock(Sentiment::class)->makePartial();

        $sentiment
            ->shouldReceive('belongsTo')
            ->once()
            ->andReturn('ok');

        $this->assertEquals(
            $sentiment->user(),
            'ok'
        );
    }
}
