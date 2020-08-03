<?php
namespace App\Http\Middleware;
 
use Closure;
use Exception;

use Illuminate\Support\Facades\DB;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
 
class JWTMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
      $token = $request->header('Authorization');
        if (!$token) { 
            return response()->json([
                'error' => 1,
                'error_message' => ""
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), explode(",", env('JWT_ALGORITHM')));
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 1,
                'error_message' => "กรุณาล็อกอินใหม่อีกครั้ง"
            ], 403);
        } catch (Exception $e) {
            return response()->json([
                'error' => 1,
                'error_message' => ""
            ], 403);
        }
        $candidate_id = $credentials->sub; 
        $candidate = DB::table('candidates')->where('candidate_id', $candidate_id)->first();
        $request->auth = $candidate;
        return $next($request);
    }
}