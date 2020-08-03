<?php
namespace App\Http\Middleware;
 
use Closure;
use Exception;

use Illuminate\Support\Facades\DB;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
 
class AdminAuthMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = "";
        if(isset($_COOKIE['login_admin_session'])) {
            $token = $_COOKIE['login_admin_session'];
        } 
        if (!$token) {  
            return redirect('admin/login');
        }
        try {
            $credentials = JWT::decode($token, env('JWT_KEY'), explode(",", env('JWT_ALGORITHM')));
        } catch (ExpiredException $e) { 
            return redirect('admin/login');
        } catch (Exception $e) { 
            return redirect('admin/login');
        }
        $admin_id = $credentials->sub; 
        $admins = DB::table('admins')
                    ->where('id', $admin_id)
                    ->where('status', 'active')
                    ->first();
        if( empty($admins) ) { 
            return redirect('admin/login');
        }
        return $next($request);
    }
}