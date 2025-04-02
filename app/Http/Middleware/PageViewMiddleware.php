<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use App\Models\PageViewLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class PageViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private $page_view;
    private $page_view_log;

    public function __construct(PageView $page_view, PageViewLog $page_view_log){

        $this->page_view = $page_view;
        $this->page_view_log = $page_view_log;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        $id     = $request->route('id');
        $type   = explode('/', trim($request->path(), '/'))[0] ?? null;
        $ip     = $request->ip();


        $modelClass = 'App\\Models\\' . ucfirst($type);
        
        if(class_exists($modelClass) && $id && $ip){
            $alreadyCount = $this->page_view_log->newQuery()
            ->where('page_id', $id)
            ->where('page_type', $modelClass)
            ->where('ip_address', $ip)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->exists();

            if(!$alreadyCount){
                $pageViews = $this->page_view->updateOrCreate([
                    'page_id'       => $id,
                    'page_type'     => $modelClass
                ]);
                
                $pageViews->increment('views');

                $this->page_view_log->newQuery()->firstOrCreate([
                    'page_id'       => $id,
                    'page_type'     => $modelClass,
                    'ip_address'    => $ip
                ]);
            }
        }

        return $next($request);
    }
}
