<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testHello()
    {
        // 1. まずアクセスする
        $response = $this->get('/products');

        // 2. 「ステータスが302（リダイレクト）であること」をテストする
        $response->assertStatus(302);

        // 3. 「ログインページに飛ぶこと」をテストする
        $response->assertRedirect('/login');
    }
}
