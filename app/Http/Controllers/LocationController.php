<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\FirebaseMessasingApiRepository;
use App\Repositories\OpenWeatherApiRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LocationController extends Controller
{
    private OpenWeatherApiRepository $repository;
    private FirebaseMessasingApiRepository $firebaseRepository;
    use ApiResponse;

    public function __construct()
    {
        $this->repository = new OpenWeatherApiRepository();
        $this->firebaseRepository = new FirebaseMessasingApiRepository();
    }

    /**
     * @OA\Post(
     *      path="/locations/geocode",
     *      tags={"Locations"},
     *      security={{"bearer_token":{}}},
     *      summary="Criação do local",
     *      description="Retorna dados do local",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LocationSaveRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso na criação",
     *          @OA\JsonContent(ref="#/components/schemas/LocationResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Informações incompletas"
     *      ),
     * )
     */
    public function geocode(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é uma informação obrigatória',
            'max' => 'O :attribute deve ter no máximo o tamanho de :max',
        ];
        $validator = Validator::make($request->all(), [
            'latitude'    => 'required|max:255|numeric',
            'longitude' => 'required|max:255|numeric'
        ], $messages);

        if ($validator->fails()) {
            return $this->badRequest($validator->messages());
        }
        $response = $this->repository->getCurrentWeather($request->latitude, $request->longitude);
        if (!isset($response)) {
            return $this->serverError(null, 'Falha ao consultar local');
        }

        $name = $response['name'];
        $lat = $request->latitude;
        $lon = $request->longitude;
        $location = Location::where(function ($query) use ($name) {
            $query->where('name', '=', $name);
        })->orWhere(function ($query) use ($lat, $lon) {
            $query->where('latitude', '=', $lat)->where('longitude', '=', $lon);
        })->first();
        if ($location) {
            $location['weather'] = $response;
            return $this->success($location, 'Sucesso ao encontrar o local');
        }

        $location = Location::create([
            'user_id' => Auth::id(),
            'name' => $response['name'],
            'latitude' => $lat,
            'longitude' => $lon
        ]);
        $location['weather'] = $response;

        return $this->success($location, 'Sucesso ao encontrar o local');
    }

    /**
     * @OA\Post(
     *      path="/locations/alert",
     *      tags={"Locations"},
     *      security={{"bearer_token":{}}},
     *      summary="Criação do local",
     *      description="Retorna dados do local",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LocationSaveRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso na criação",
     *          @OA\JsonContent(ref="#/components/schemas/LocationResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Informações incompletas"
     *      ),
     * )
     */
    public function alert(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é uma informação obrigatória',
            'max' => 'O :attribute deve ter no máximo o tamanho de :max',
        ];
        $validator = Validator::make($request->all(), [
            'latitude'    => 'numeric',
            'longitude' => 'numeric',
            'name' => 'string'
        ], $messages);

        if ($validator->fails()) {
            return $this->badRequest($validator->messages());
        }
        $name = $request->name;
        $lat = $request->latitude;
        $lon = $request->longitude;
        $locations = Location::where(function ($query) use ($name) {
            $query->where('name', '=', $name);
        })->orWhere(function ($query) use ($lat, $lon) {
            $query->where('latitude', '=', $lat)->where('longitude', '=', $lon);
        })->get();

        $response = $this->repository->getCurrentWeather($request->latitude, $request->longitude);
        if (!isset($response)) {
            return $this->serverError(null, 'Falha ao consultar local');
        }

        foreach ($locations as $location) {
            $user = User::where('id', $location->user_id)->whereNotNull('fcm_token',)->first();
            if ($user) {
                $firebaseResponse = $this->firebaseRepository->send($user->fcm_token, $location->name);
                Notification::create([
                    'user_id' => $user->id,
                    'location_id' => $location->id,
                    'notification_id' => $firebaseResponse['name'],
                    'is_read' => false
                ]);
            }
            $location['weather'] = $response;
        }

        return $this->success($locations, 'Sucesso ao encontrar o local');
    }
}
