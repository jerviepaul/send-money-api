<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Provider as ResourcesProvider;
use App\Models\API\Provider as APIProvider;
use Illuminate\Http\Request;

class ProviderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = APIProvider::all();

        return $this->sendResponse(ResourcesProvider::collection($providers), 'Providers retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $provider = APIProvider::find($id);

        if (is_null($provider)) {
            return $this->sendError('Provider not found.');
        }

        return $this->sendResponse(new ResourcesProvider($provider), 'Provider retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    /**
     * Get Bank list by Provider ID.
     */
    public function banksByProvider(string $id) {
        $banks = APIProvider::where('id', $id)->with('banks')->get();

        if ($banks->isEmpty()) {
            return $this->sendError("No Banks found.");
        }

        return $this->sendResponse(ResourcesProvider::collection($banks), 'Banks retrieved successfully.');
    }
}
