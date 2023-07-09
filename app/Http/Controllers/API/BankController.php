<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Bank as ResourcesBank;
use App\Models\API\Bank;
use App\Models\API\Provider;
use Illuminate\Http\Request;

class BankController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::all()->sortBy('name');

        return $this->sendResponse(ResourcesBank::collection($banks), 'Banks retrieved successfully.');
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
        $bank = Bank::find($id);

        if (is_null($bank)) {
            return $this->sendError('Bank not found.');
        }
        return $this->sendResponse(new ResourcesBank($bank), 'Bank retrieved successfully.');
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

}
