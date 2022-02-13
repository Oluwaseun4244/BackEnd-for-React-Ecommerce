<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token2 = uniqid();
        User::where("email", $request->email)->update(["token" => $token2]);
        // $user = User::where("email", $request->email)->get();
        // $user_id = $user["id"];
        // $user_conctact = Contact::where("user_id", $user_id)->get();
        return $this->createNewToken($token2);
    }

    // public function Login(Request $request){
    //     if($request->isMethod('POST')){

    //         $email = $request->email;
    //         $password=$request->password;

    //         if (Auth::attempt(['email'=> $email, 'password'=>$password])){
    //             $user= User::where(['email'=>$email])->first();
    //             $token = JWTAuth::fromUser($user);
    //             // $token= $this->createNewToken($token);
    //             return response()->json(['msg'=>'login', 'token'=>$token, 'user'=>$user]);
    //         }
    // }
    // }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        if ($request->isMethod("POST")) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required',
            ]);


            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }



            // $allRequest = $request->all();
            // $allRequest["password"] = Hash::make($request->password);
            // $user = User::create($allRequest);
 


            $user = User::create(array_merge(
                        $validator->validated(),
                        ['password' => bcrypt($request->password)]
                    ));
            
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
                // 'token' => $token
            ], 201);
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
