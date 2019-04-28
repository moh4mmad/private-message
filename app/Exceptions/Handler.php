<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Response;
use App\Front;
use App\Social;
use Config;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		
		if (Config()->get('app.env') == 'production')
		{
		$front = Front::first();
		$socials = Social::all();
		}
	
		if($this->isHttpException($exception))
            {

                switch ($exception->getStatusCode()) 
                {

                    case 404:
					    if (Config()->get('app.env') == 'production')
						{
                        return Response::view('404', compact('front','socials'), 404);
						}
						else
						{
							return "404 error";
						}
                        break;

                    case 405:
					     
						if (Config()->get('app.env') == 'production')
						{
                        return Response::view('404', compact('front','socials'), 405);
						}
						else
						{
							return "405 error";
						}
                        break;
                }
            }
        return parent::render($request, $exception);
    }
}
