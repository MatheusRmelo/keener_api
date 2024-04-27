<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"Auth"},
     *      summary="Realizando login do usuário",
     *      description="Retorna o token do usuário",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso login, retorna token",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Email ou senha não enviados"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="E-mail ou senha errados",
     *      ),
     * )
     */
    public function login(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é uma informação obrigatória',
            'email' => 'E-mail enviado não é válido',
        ];
        $validator = Validator::make($request->only(['email', 'password']), [
            'email'    => 'required|email',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return $this->badRequest($validator->messages());
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->unathorized("Credenciais inválidas", 'Não autorizado', new MessageBag(
                [
                    'email' => 'Email e/ou senha inválidas',
                    'password' => 'Email e/ou senha inválidas'
                ]
            ));
        }

        return $this->success($user->createToken($request->userAgent())->plainTextToken, 'Sucesso ao fazer login');
    }

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      tags={"Auth"},
     *      summary="Criação do usuário",
     *      description="Retorna dados do usuário",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso na criação",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Nome, e-mail ou senha não enviados"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="E-mail não informado",
     *      ),
     * )
     */
    public function register(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é uma informação obrigatória',
            'email' => 'E-mail enviado não é válido',
            'max' => 'O :attribute deve ter no máximo o tamanho de :max',
            'password.min' => 'Sua senha precisa ter no mínimo 6 caracteres',
        ];
        $validator = Validator::make($request->only(['name', 'email', 'password']), [
            'name'     => 'required|max:255',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], $messages);

        if ($validator->fails()) {
            return $this->badRequest($validator->messages());
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return $this->forbidden('Esse e-mail não está disponível', 'Ação não permitida', new MessageBag([
                'email' => 'Esse e-mail não está disponível'
            ]));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->create($user->createToken($request->userAgent())->plainTextToken, 'Sucesso ao criar o usuário');
    }

    /**
     * @OA\Get(
     *      path="/auth/verify-token",
     *      tags={"Auth"},
     *      security={{"bearer_token":{}}},
     *      summary="Lista informações do usuário ativo",
     *      description="Retorna informações do usuário ativo",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autenticado",
     *      ),
     *     )
     */
    public function verifyToken(Request $request)
    {
        $fcmToken = $request->get('fcmToken');
        if (isset($fcmToken)) {
            $user = User::find(Auth::id());
            if ($user) {
                $user->update([
                    'fcm_token' => $fcmToken
                ]);
            }
        }

        return $this->success(auth()->user());
    }

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"Auth"},
     *      summary="Realizando logout do usuário",
     *      description="Remove o token do usuario",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso ao fazer logout",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autenticado",
     *      ),
     * )
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return $this->noContent();
    }
}
