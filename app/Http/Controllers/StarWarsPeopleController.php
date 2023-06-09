<?php

namespace App\Http\Controllers;

use App\Classes\Response;
use App\Http\Resources\PeopleResource;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StarWarsPeopleController extends Controller
{

    public function getAllPeople(Request $request){
        try {

            //COMO LA API YA ENTREGA EL GETALL PAGINADO SIMPLEMENTE PUSE EL ID PARA IR A BUSCAR LA PAGINA
            //ESPECIFICA QUE DEVOLVERIA LA API - YA QUE NO TENIA SENTIDO HACER UN LIMIT Y OFFSET
            // SIMPLEMENTE SI SE ENVIA EL ID, ESTE FUNCIONA COMO PAGINA QUE ENVIARIA A LA PAGINACION SOLICITADA

            $validator = Validator::make(['id' => $request->route('id')], [
                'id' => 'nullable|digits_between:1,2',
            ]);

            if ($validator->fails()) {
                return (new Response('', 422, $validator->errors()))->getResponse();
            }

            //REVISO SI EL ID ES NULL O QUIERE IR A UNA PAGINACION ESPECIFICA.
            $page = ($request->route('id') == null ? '' : '?page='.$request->route('id'));

            $client = new Client();
            $response = $client->get(config('swapi.url') . "/people/{$page}");

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

        return (new Response(PeopleResource::collection($data['results'])))->getResponse();

    }





    public function getPeopleById(Request $request)
    {

        $validator = Validator::make(['id' => $request->route('id')], [
                'id' => 'required|digits_between:1,2',
        ]);

        if ($validator->fails()) {
            return (new Response('', 422, $validator->errors()))->getResponse();
        }

        try {

            $client = new Client();
            $response = $client->get(config('swapi.url') . "/people/{$request->route('id')}");

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

        return (new Response(PeopleResource::collection([$data])))->getResponse();

    }

}
