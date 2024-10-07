<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuccessfulEmailStore;
use App\Http\Requests\SuccessfulEmailUpdate;
use Illuminate\Http\Request;
use App\Models\SuccessfulEmail;
use Illuminate\Http\JsonResponse;
use App\Services\ParseEmailService;

class SuccessfulEmailController extends Controller
{
    private ParseEmailService $parseEmailService;

    /**
     * Constructor for injecting the ParseEmailService
     */
    public function __construct(ParseEmailService $parseEmailService)
    {
        $this->parseEmailService = $parseEmailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $emails = SuccessfulEmail::paginate(10);

        return response()
            ->json([
                'message' => 'Successfully fetched all emails.',
                'status' => 'success',
                'data' => $emails
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * TODO: Add request validation.
     */
    public function store(SuccessfulEmailStore $request): JsonResponse
    {
        $plainText = $this->parseEmailService->parseEmailContent($request->email);

        $email = SuccessfulEmail::create(array_merge($request->validated(), ['raw_text' => $plainText]));

        return response()->json([
            'message' => 'Successfully created the email.',
            'status' => 'success',
            'data' => $email
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $email = SuccessfulEmail::findOrFail($id);

        return response()
            ->json([
                'message' => 'Successfully fetched the email.',
                'status' => 'success',
                'data' => $email
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuccessfulEmailUpdate $request, string $id): JsonResponse
    {
        $email = SuccessfulEmail::findOrFail($id);
        $email->update($request->validated());

        return response()->json([
            'message' => 'Successfully updated the email.',
            'status' => 'success',
            'data' => $email
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $email = SuccessfulEmail::findOrFail($id);
        $email->delete();

        return response()->json([
            'message' => 'Successfully deleted the email.',
            'status' => 'success',
            'data' => []
        ]);
    }
}
