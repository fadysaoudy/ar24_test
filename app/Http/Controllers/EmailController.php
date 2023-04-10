<?php

namespace App\Http\Controllers;

use App\Contracts\EmailServiceInterface;
use App\Http\Requests\DTO\Email\EmailGetInfoRequest;
use App\Http\Requests\DTO\Email\EmailSendRequest;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function __construct(protected EmailServiceInterface $emailService)
    {

    }
    public function index(): View
    {
        return view('pages.users.email.index');
    }

    /**
     * @param EmailSendRequest $request
     * @return View|RedirectResponse
     */
    public function store(EmailSendRequest $request): View|RedirectResponse
    {
        try {
            $this->emailService->store($request);
        } catch (Exception $e) {
            return view('errors.user.user_errors', ['message' => $e->getMessage()]);

        }
        Queue::later(10, function () {
            Session::forget('success');
        });
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Email Sent Successfully.');
    }

    public function getEmailInfo(EmailGetInfoRequest $request): View|RedirectResponse
    {
        /**
         * This function retrieves information about an email using the provided EmailGetInfoRequest object as
         * the request parameters. If the email is found, the user is redirected to the home page with a success
         * message. If there is an error, the user is shown an error page with the error message.
         * try to parse the response as I did before, but I received and Exception: You tried to access a resource that is not related to your API (user has not granted API access)
         */


        try {
            $this->emailService->get($request);
            return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Email retrieved Successfully.');
        } catch (Exception $e) {
            return view('errors.user.user_errors', ['message' => $e->getMessage()]);

        }


    }

    public function show(): View
    {
        return view('pages.users.email.show');
    }
}
