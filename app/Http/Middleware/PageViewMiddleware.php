<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private $page_view;

    public function __construct(PageView $page_view){

        $this->page_view = $page_view;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        $id     = $request->route('id');
        $type   = $request->route('type');

        $modelClass = 'App\\Models\\' . ucfirst($type);
        
        if(class_exists($modelClass) && $id){
            $page_view->firstOrCreate([
                'page_id' => $id,
                'page_type' => $modelClass
            ]);

            $page_view->increment('views');
        }

        return $next($request);
    }
}
