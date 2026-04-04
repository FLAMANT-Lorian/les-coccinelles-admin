<?php

namespace App\Http\Middleware;

use App\Enums\AvailableLanguage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        $available_language = array_map(
            fn(AvailableLanguage $locale) => $locale->value,
            AvailableLanguage::cases());

        if (in_array($locale, $available_language)) {
            app()->setLocale($locale);
        } else {
            $segments = $request->segments();
            $segments[0] = config('app.locale');

            app()->setLocale(config('app.locale'));

            return redirect('/' . implode('/', $segments));
        }

        URL::defaults(['locale' => app()->getLocale()]);

        return $next($request);
    }
}
