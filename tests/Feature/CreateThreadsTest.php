<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    /**
     * test
     */
    use DatabaseMigrations;

    public function test_guests_may_not_create_threads(){

    	$this->expectException('Illuminate\Auth\AuthenticationException');

    	$thread = factory('App\Thread')->make();

    	$this->post('/threads', $thread->toArray());
    }

    public function test_an_authenticated_user_can_create_new_form_threads(){

    	$this->actingAs(factory('App\User')->create());

    	$thread = factory('App\Thread')->make();

    	$this->post('/threads', $thread->toArray());

    	$this->get($thread->path())
    		->assertSee($thread->title)
		 	->assertSee($thread->body);

    }
}
