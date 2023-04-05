<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testSuccessfulLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create(); //テスト用ユーザを作成。
            $browser->visit('/login')
                    ->type('email',$user->email) //テスト用ユーザのメアドを指定。
                    ->type('password','password')
                    ->press('LOG IN') //ログインボタンをクリックする。
                    ->assertPathIs('/tweet') // /tweetに遷移したことを確認。
                    ->assertSee('つぶやきアプリ');  //ページ内につぶやきアプリが表示されていることの確認。
        });
    }
}