<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;
    /**
     
     */
    protected $thread;

    public function setUp(){
		parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }
    public function test_a_thread_has_replies(){
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_a_thread_has_a_creator(){
		$this->assertInstanceOf('App\User', $this->thread->creator);
    }

    public function test_a_thread_can_add_a_reply(){
    	$this->thread->addReply(
    		[
    			'body' => 'foobar',
    			'user_id' => 1
    		]

    	);

    }
}
