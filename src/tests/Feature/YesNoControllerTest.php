<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Diagnosis;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YesNoControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function test_YesNoスタート()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('start');
    }

    /** @test */
    public function test_YesNo性別表示()
    {
        $response = $this->get('/gender'); // `/gender`が正しいルートの場合
        $response->assertStatus(200);
        $response->assertViewIs('gender');
    }

    /** @test */
    public function test_YesNo性別登録()
    {
        $response = $this->withSession(['gender' => 'male'])->post('/age', ['gender' => 'male']);
        $response->assertStatus(200);
        $response->assertViewIs('age');
    }

    /** @test */
    public function test_YesNo年齢()
    {
        $response = $this->withSession(['age' => '20s'])->post('/diagnosis', ['age' => '20s']);
        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    /** @test */
    public function test_YesNo基本データ()
    {
        // Arrange: モックデータを作成
        Diagnosis::factory()->create([
            'gender' => 'male',
            'age' => '20s',
            'result' => 'a1',
        ]);

        session(['gender' => 'male', 'age' => '20s']);

        // Act: 結果ページを取得
        $response = $this->get('/results');

        // Assert: ビューが正しくレンダリングされ、データが含まれる
        $response->assertStatus(200);
        $response->assertViewIs('results');
        $response->assertViewHas('readableResult', '普通肌');
        $response->assertViewHas('gender', 'male');
        $response->assertViewHas('age', '20s');
    }

    /** @test */
    public function test_YesNo保存()
    {
        // Arrange: セッションに性別と年代を設定
        $this->withSession(['gender' => 'male', 'age' => '20s']);

        // Act: データを保存
        $response = $this->post('/store-result', ['result' => 'a1']);

        // Assert: データベースに保存されたことを確認
        $this->assertDatabaseHas('diagnoses', [
            'gender' => 'male',
            'age' => '20s',
            'result' => 'a1',
        ]);

        // 結果ページにリダイレクト
        $response->assertRedirect('/results');
    }
}
