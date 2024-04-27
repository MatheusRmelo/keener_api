<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
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
    public function readNotification(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é uma informação obrigatória',
            'max' => 'O :attribute deve ter no máximo o tamanho de :max',
        ];
        $validator = Validator::make($request->all(), [
            'location_id'    => 'required|exists:locations,id'
        ], $messages);

        if ($validator->fails()) {
            return $this->badRequest($validator->messages());
        }
        $notification = Notification::where('location_id', $request->location_id)->update([
            'is_read' => true
        ]);

        return $this->success($notification, 'Sucesso ao encontrar o local');
    }
}
