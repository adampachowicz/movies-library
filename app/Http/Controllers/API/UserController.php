<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    private const TOKEN_TYPE = "Bearer";

    /**
     * @param Request $request
     * @param User $user
     * @param Validator $validator
     * @return JsonResponse
     */
    public function register(Request $request, User $user, Validator $validator): JsonResponse
    {
        $input = $request->all();

        $validator = $validator::make($input, $user::$rules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['password'] = bcrypt($input['password']);

        $user::create($input);

        return $this->sendResponse([], 'Successfully created user!');
    }

    /**
     * @param Request $request
     * @param Validator $validator
     * @param Auth $auth
     * @param Carbon $carbon
     * @return JsonResponse
     */
    public function login(Request $request, Validator $validator, Auth $auth, Carbon $carbon): JsonResponse
    {
        $input = $request->all();
        $validator = $validator::make($input, [
            'email' => 'email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (!$auth::attempt($input)) {
            return $this->sendResponse('Unauthorized', 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $tokenResult->token->save();

        $success['access_token'] =  $tokenResult->accessToken;
        $success['token_type'] =  self::TOKEN_TYPE;
        $success['expires_at'] =  $carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'Successfully login!');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return $this->sendResponse([], 'Successfully logged out!');
    }

    /**
     * @param Request $request
     * @return User
     */
    public function user(Request $request): User
    {
        return $request->user();
    }
}
