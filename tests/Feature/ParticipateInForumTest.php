<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest 
extends TestCase
{
	use DatabaseMigrations;
    /**
     * 
     * test
     */


    public function test_unauthenticated_users_may_not_add_replies(){
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $this->post('threads/1/replies', []);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads(){
    	//create a user and set is as the currently logged in user for the application
    	$this->be(factory('App\User')->create());
    	$thread = factory('App\Thread')->create();
    	$reply = factory('App\Reply')->make();

    	$this->post($thread->path() . '/replies', $reply->toArray());
    	$this->get($thread->path())->assertSee($reply->body);
    }
}
