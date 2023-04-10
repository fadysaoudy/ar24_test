<?php

namespace App\Providers;

use App\Contracts\ApiResponseHandlerInterface;
use App\Contracts\AttachmentServiceInterface;
use App\Contracts\EmailServiceInterface;
use App\Contracts\HttpWrapperInterface;
use App\Contracts\UserServiceInterface;
use App\Helpers\ApiResponseHandler;
use App\Services\AttachmentService;
use App\Services\EmailService;
use App\Services\HttpWrapper;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(HttpWrapperInterface::class, HttpWrapper::class);
        $this->app->bind(AttachmentServiceInterface::class, AttachmentService::class);
        $this->app->bind(ApiResponseHandlerInterface::class, ApiResponseHandler::class);
        $this->app->bind(EmailServiceInterface::class, EmailService::class);

    }

    /**
     * Bootstrap any application Services.
     */
    public function boot(): void
    {
        //
    }
}
