<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckOnboarding
{
    protected $openRouteNames = [
        'onboarding',
        'installation',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = \Route::getRoutes()->match($request);
        $currentRoute = $route->getName();

        $isCompletedSetup = Setting::get('has_completed_setup');
        $isOnboardingRoute = in_array($currentRoute, $this->openRouteNames);

        if (!$isOnboardingRoute && !$isCompletedSetup) {
            redirect()->route('onboarding')->send();
        }

        if ($isCompletedSetup && $isOnboardingRoute) {
            redirect()->route('home')->send();
        }

        return $next($request);
    }
}
