<?php

namespace App\Http\Controllers;

use App\Classes\Response;
use App\Http\Resources\PlanetResource;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StarWarsPlanetsController extends Controller
{

    public function getAllPlanets(Request $request){
        try {

            $validator = Validator::make(['id' => $request->route('id')], [
                'id' => 'nullable|digits_between:1,2',
            ]);

            if ($validator->fails()) {
                return (new Response('', 422, $validator->errors()))->getResponse();
            }

            $page = $request->route('id') == null ? '' : "?page={$request->route('id')}";

            $client = new Client();
            $response = $client->get(config('swapi.url') . "/planets/{$page}");

            $data = json_decode($response->getBody(), true);


        } catch (\Exception $e) {
            Log::channel()->error('Falló', [
                'Method' => __METHOD__,
                'Line' => __LINE__,
                'Exception' => $e->getMessage(),
            ]);

            $code = ($e->getCode() == 0 ? 400 : $e->getCode());

            return (new Response('', $code, $e->getMessage()))->getResponse();
        }

        if (empty($data['results'])) {
            return (new Response('', 404, 'No Hay elementos para mostrar'))->getResponse();
        }

        return (new Response(PlanetResource::collection($data['results'])))->getResponse();

    }





    public function getPlanetById(Request $request)
    {

        $validator = Validator::make(['id' => $request->route('id')], [
                'id' => 'required|digits_between:1,2',
        ]);

        if ($validator->fails()) {
            return (new Response('', 422, $validator->errors()))->getResponse();
        }

        try {

            $client = new Client();
            $response = $client->get(config('swapi.url') . "/planets/{$request->route('id')}");

            $data = json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            Log::channel()->error('Falló', [
                'Method' => __METHOD__,
                'Line' => __LINE__,
                'Exception' => $e->getMessage(),
            ]);

            $code = ($e->getCode() == 0 ? 400 : $e->getCode());

            return (new Response('', $code, $e->getMessage()))->getResponse();
        }

        if (empty($data)) {
            return (new Response('', 404, 'No Hay elementos para mostrar'))->getResponse();
        }

        return (new Response(PlanetResource::collection([$data])))->getResponse();

    }

}
