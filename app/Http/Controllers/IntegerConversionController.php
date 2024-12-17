<?php

namespace App\Http\Controllers;

use App\Actions\ProcessIntegerConverterAction;
use App\Actions\RetrieveRecentConversionAction;
use App\Actions\RetrieveTopTenConversionAction;
use App\Http\Requests\ConvertIntegerToRomanRequest;
use App\Http\Resources\ConversionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\NoReturn;

class IntegerConversionController extends Controller
{
    public function __construct(
        protected ProcessIntegerConverterAction $converterAction,
        protected RetrieveRecentConversionAction $retrieveRecentAction,
        protected RetrieveTopTenConversionAction $retrieveTopTenAction,
    ){}

    /**
     * @throws \Exception
     */
    #[NoReturn] public function integerConversion(ConvertIntegerToRomanRequest $request): ConversionResource
    {
        $data = $request->validated();
        $response = $this->converterAction->execute($data['integer_value']);
        return new ConversionResource($response);
    }

    public function recentConversion(): AnonymousResourceCollection
    {
        return ConversionResource::collection($this->retrieveRecentAction->execute());
    }

    public function topTenConversion(): AnonymousResourceCollection
    {
        return ConversionResource::collection($this->retrieveTopTenAction->execute());
    }
}
