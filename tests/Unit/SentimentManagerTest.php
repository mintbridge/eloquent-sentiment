<?php
namespace Mintbridge\EloquentSentiment\Test;

use Mintbridge\EloquentSentiment\SentimentManager;

class SentimentManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mintbridge\EloquentSentiment\SentimentManager
     */
    protected $manager;

    public function setUp()
    {
        $this->manager = new SentimentManager([
            'like'
        ]);
    }

    /**
     * @test
     */
    public function it_provides_public_sentiment_methods()
    {
        $this->assertTrue(
            method_exists($this->manager, 'toggle'),
            'Class does not have method toggle'
        );
        $this->assertTrue(
            method_exists($this->manager, 'add'),
            'Class does not have method add'
        );
        $this->assertTrue(
            method_exists($this->manager, 'remove'),
            'Class does not have method remove'
        );
    }
}
