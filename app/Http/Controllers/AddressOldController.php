<?php

declare(strict_types=1);

namespace Modules\Address\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Modules\Address\Http\Requests\AddressRequest;
use Modules\Address\Models\Address;
use Modules\Address\Resources\AddressResource;

#[Middleware('auth:sanctum')]
class AddressOldController extends Controller
{
    #[Authorize('viewAny', Address::class)]
    public function index(Request $request): JsonResponse
    {
        $addresses = $request->user()->addresses;

        return response()->json([
            'message' => 'Success',
            'addresses' => AddressResource::collection($addresses),
        ], Response::HTTP_OK);
    }

    #[Authorize('create', Address::class)]
    public function store(AddressRequest $request): JsonResponse
    {
        $address = $request->user()->addresses()->create($request->validated());

        return response()->json([
            'message' => 'Address created successfully',
            'address' => new AddressResource($address),
        ], Response::HTTP_CREATED);
    }

    #[Authorize('view', Address::class)]
    public function show(Address $address): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'address' => new AddressResource($address),
        ], Response::HTTP_OK);
    }

    #[Authorize('update', Address::class)]
    public function update(AddressRequest $request, Address $address): JsonResponse
    {
        $address->update($request->validated());

        return response()->json([
            'message' => 'Address updated successfully',
            'address' => new AddressResource($address),
        ], Response::HTTP_OK);
    }

    #[Authorize('delete', Address::class)]
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return response()->json([
            'message' => 'Address deleted successfully',
        ], Response::HTTP_OK);
    }
}
