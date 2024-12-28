<?php

namespace App\Http\Controllers\Iban;

use App\Http\Controllers\Controller;
use App\Http\Requests\Iban\IbanStoreRequest;
use App\Models\Iban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the authenticated user is an admin
        if (!Auth::user()->is_admin) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        try {
            $ibans = Iban::with('user')->get();

            return $this->sendResponse($ibans, 'IBANs fetched successfully.');

        } catch (\Exception $e) {

            Log::error('fetch failed: ' . $e->getMessage());
            return $this->sendError('fetch failed due to a server error.', [], 500);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IbanStoreRequest $request)
    {
        
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        try {

            $iban = Iban::create($data);

            $success['iban'] = $iban->iban;

            return $this->sendResponse($success, 'Iban register successfully.');
            
        } catch (\Exception $e) {

            Log::error('fetch failed: ' . $e->getMessage());
            return $this->sendError('fetch failed due to a server error.', [], 500);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
