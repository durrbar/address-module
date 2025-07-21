<?php

namespace Modules\Address\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Address\Http\Requests\AddressRequest;
use Modules\Address\Models\Address;
use Modules\Address\Resources\AddressResource;

class AddressOldController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $addresses = $user->addresses;

        return response()->json([
            'message' => 'Success',
            'addresses' => AddressResource::collection($addresses),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request): JsonResponse
    {
        $user = $request->user();

        // Authorize the user to create an address
        $this->authorize('create', Address::class);

        // Create the address using validated data
        $address = $user->addresses()->create($request->validated());

        return response()->json([
            'message' => 'Address created successfully',
            'address' => new AddressResource($address),
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the specified resource.
     */
    public function show(Address $address): JsonResponse
    {
        // Authorize the user to view the address
        $this->authorize('view', $address);

        return response()->json([
            'message' => 'Success',
            'address' => new AddressResource($address),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address): JsonResponse
    {
        // Authorize the user to update the address
        $this->authorize('update', $address);

        // Update the address using validated data
        $address->update($request->validated());

        return response()->json([
            'message' => 'Address updated successfully',
            'address' => new AddressResource($address),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): JsonResponse
    {
        // Authorize the user to delete the address
        $this->authorize('delete', $address);

        $address->delete();

        return response()->json([
            'message' => 'Address deleted successfully',
        ], Response::HTTP_OK);
    }
}
