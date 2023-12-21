<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Create a new ContactController instance.
     * Injecting the ContactService class
     * @param ContactService $contactService
     */
    public function __construct(private ContactService $contactService)
    {
    }

    /**
     * Return the list of contacts of the current user.
     * @return array
     */
    public function list()
    {
        try {
            return $this->contactService->list();
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created contact in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'profile_picture_url' => 'required|string',
            ]);
            $request->merge(['user_id' => $request->user()->id]);

            return $this->contactService->create($request->all());
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the contact specified by id.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'string',
                'email' => 'string|email',
                'address' => 'string',
                'phone_number' => 'string',
                'profile_picture_url' => 'string',
            ]);

            return $this->contactService->update($id, $request->all());
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the contact specified by id.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            return $this->contactService->delete($id);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
