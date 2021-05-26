<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ReverseController extends Controller
{
    public function __construct(MockHandler $handler)
    {
        $this->handler = $handler;
    }

    public function reverse(Request $request)
    {
        $data = new stdClass();
        $data->text = $request->text;

        $validator = Validator::make($request->all(), [
            'text' => 'required|min:4|max:20'
        ]);

        if ($validator->fails()) {
            $data->errors = $validator->errors();
            return $this->render($request, $data);
        }

        $service = $request->service ?? '';
        $data->reversed = $this->reverseIt($data->text, $service);

        return $this->render($request, $data);
    }

    private function render(Request $request, stdClass $data)
    {
        if (isset($request->json)) {
            return response()->json($data);
        }
        return view('index', (array)$data);
    }

    private function reverseIt($text, $service): string
    {
        switch ($service) {
            case 'laravel';
                return $this->reverseLaravel($text);
            case 'guzzle';
                return $this->reverseGuzzle($text);
            default:
                return $this->reverseLocal($text);
        }
    }

    private function reverseLocal($text): string
    {
        if ($text == 'hello') {
            return 'Hi, I am local';
        }
        return implode(array_reverse(str_split($text)));
    }

    private function reverseLaravel($text): string
    {
        $resp = Http::get('http://http.net/reverse?text=' . $text);
        $code = $resp->status();
        if ($code == 200) {
            return $resp->object()->reversed;
        } else {
            throw new Exception("Get failed", $code);
        }
    }

    private function reverseGuzzle($text): string
    {
        $client = new Client(['handler' => HandlerStack::create($this->handler)]);
        // Guzzle is configured to throw exception on http code 4xx and 5xx
        $resp = $client->get('http://guzzle.net/reverse?text=' . $text);
        return json_decode($resp->getBody()->getContents())->reversed;
    }
}
