<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class DeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase;
    public function test_delete_successed(){
        $user = User::factory()->create(); //ユーザー作成。
        $tweet = Tweet::factory()->create(['user_id'=>$user->id]); //つぶやき作成。

        $this->actingAs($user);

        $response = $this->delete('/tweet/delete/' . $tweet->id); //作成した呟きidを指定。
        $response->assertRedirect('/tweet');
    }
}