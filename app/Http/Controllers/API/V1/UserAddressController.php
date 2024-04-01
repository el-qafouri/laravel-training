<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserAddress\StoreRequest;
use App\Http\Resources\V1\AddressResource;
use App\Services\V1\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAddressController extends Controller
{
    public function __construct(protected $addressService = null)
    {
        $this->addressService = app(AddressService::class);
    }

    public function index(Request $request)
    {
        $addresses = $this->addressService->getUserAddresses($request->user());

        return $this->generateResponse(AddressResource::collection($addresses), true);
    }

    public function store(StoreRequest $request)
    {
        $address = $this->addressService->storeAddresses($request->validated(), $request->user());

        return $this->generateResponse(new AddressResource($address), code: Response::HTTP_CREATED);
    }
}
