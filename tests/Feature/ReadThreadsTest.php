<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
        a user can browse threads
    */

    public function setUp(){
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }
    public function test_a_user_can_view_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    public function test_a_user_can_view_a_single_thread(){
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread(){
        $reply= factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())->assertSee($reply->body);

        $this->assertCount(1, $this->thread->replies);

    }
}
