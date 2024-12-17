<?php

namespace App\Actions;

use App\Models\Conversion;
use App\Services\Contracts\IntegerConverterService;

class ProcessIntegerConverterAction
{
    public function __construct(protected IntegerConverterService $integerConverterService,){}
    public function execute($integer_value): Conversion
    {
        try {

            $roman_value = $this->integerConverterService->convertInteger($integer_value);
            return Conversion::create([
                'integer_value' => $integer_value,
                'roman_value' => $roman_value,
            ]);
        }catch (\Exception $exception){
            throw new $exception;
        }
    }

}
