<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\DeviceRegistered;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class APIToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request);
        // return $next($request);
         //First it will check header data.
         if ($request->header('Authorization')) {
            
            //It will decode token and then parse to check valid request or not.
            $token = base64_decode(base64_decode($request->header('Authorization')));
            if ($token != "") {
                $token_parts = json_decode($token, true);
                if (is_array($token_parts)) {
                    if ($token_parts['timestamp'] <= Carbon::now()->addHour()->timestamp) {
                            //validate user
                            $data = DeviceRegistered::where('deviceUUID',$token_parts["deviceUUID"])->first();
                            if (!$data) {
                                return response()->json(['result' => false, 'message' => __("Unauthorised user")], 200);
                            } else {
                                    session(['user' => $data]);
                                    return $next($request);
                            }
                       
                    }
                }
            }
            $token = $request->header('Authorization');
            
            $data = DeviceRegistered::where('token',$token)->first();
            //dd($data);
            if (!$data) {
                return response()->json(['result' => false, 'message' => __("Unauthorised user")], 200);
            } else {
                    session(['user' => $data]);
                    return $next($request);
            }
        }
        
        return response()->json(['result' => false, 'message' => __("Unauthorised user")], 200);
    }
}
