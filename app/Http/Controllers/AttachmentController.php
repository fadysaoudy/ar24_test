<?php

namespace App\Http\Controllers;

use App\Http\Requests\DTO\Attachment\AttachmentUploadRequest;
use App\Providers\RouteServiceProvider;
use App\Services\AttachmentService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;

class AttachmentController extends Controller
{
    public function __construct(
        protected AttachmentService $attachmentService,

    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.users.attachment.index');
    }

    /**
     * @param AttachmentUploadRequest $request
     * @return View|RedirectResponse
     */
    public function store(AttachmentUploadRequest $request): View|RedirectResponse
    {
        try {
            $this->attachmentService->store($request);
        } catch (Exception $e) {
            return view('errors.user.user_errors', ['message' => $e->getMessage()]);

        }
        Queue::later(10, function () {
            Session::forget('success');
        });
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'File Uploaded Successfully.');
    }
}
