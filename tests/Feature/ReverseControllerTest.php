<?php

namespace Tests\Feature;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ReverseControllerTest extends TestCase
{
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new MockHandler();
        $this->app->register(new GuzzleMockServiceProvider($this->app, $this->handler));
    }

    public function testInitialLoad()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeTextInOrder(['Reverse', 'Indtast et tekst']);
        $response->assertDontSeeText('Error');
        $response->assertDontSeeText('Reversed');
    }

    public function testEmpty()
    {
        $response = $this->get('/reverse?text=');
        $response->assertStatus(200);
        $response->assertSeeTextInOrder(['Error', 'required']);
        $response->assertDontSeeText('Reversed');
    }

    public function testReverse()
    {
        $response = $this->get('/reverse?text=hejsa');
        $response->assertStatus(200);
        $response->assertSeeText('Reversed: asjeh');
        $response->assertDontSeeText('Error');
    }

    public function testReverseHttp()
    {
        $fixture = json_encode((object)["reversed" => "asjeh"]);
        Http::fake(function ($request) use ($fixture) {
            return Http::response($fixture, 200);
        });
        $response = $this->get('/reverse?text=hejsa&service=laravel');
        $response->assertStatus(200);
        $response->assertSeeText('Reversed: asjeh');
        $response->assertDontSeeText('Error');
    }

    public function testReverseHttpFail()
    {
        Http::fake(function ($request) {
            return Http::response(null, 500);
        });
        $response = $this->get('/reverse?text=hejsa&service=laravel');
        $response->assertStatus(500);
    }

    public function testReverseGuzzle()
    {
        $fixture = json_encode((object)["reversed" => "asjeh"]);
        $this->handler->append(new Response(200, [], $fixture));

        $response = $this->get('/reverse?text=hejsa&service=guzzle');
        $response->assertStatus(200);
        $response->assertSeeText('Reversed: asjeh');
        $response->assertDontSeeText('Error');
    }

    public function testReverseGuzzleFail()
    {
        $this->handler->append(new Response(500));
        $response = $this->get('/reverse?text=hejsa&service=guzzle');
        $response->assertStatus(500);
    }

    public function testReverseJson()
    {
        $response = $this->getJson('/reverse?text=hejsa&json=1');
        $response->assertStatus(200);
        $response->assertJson(["reversed" => "asjeh"]);
    }
}
