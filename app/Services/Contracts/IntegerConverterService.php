<?php

namespace App\Services\Contracts;


use App\Models\Conversion;
use App\Services\IntegerConverterInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class IntegerConverterService implements IntegerConverterInterface
{
    protected const array INTEGER_ROMAN_MAP = [
        1000 => 'M',
        900  => 'CM',
        500  => 'D',
        400  => 'CD',
        100  => 'C',
        90   => 'XC',
        50   => 'L',
        40   => 'XL',
        10   => 'X',
        9    => 'IX',
        5    => 'V',
        4    => 'IV',
        1    => 'I',
    ];
    public function convertInteger(int $number): string
    {
        $roman_symbol = '';
        foreach (self::INTEGER_ROMAN_MAP as $integer => $symbol) {
            if ($number === 0) break;
            $count = intdiv($number, $integer);
            $roman_symbol .= str_repeat($symbol, $count);
            $number %= $integer;
        }

        return $roman_symbol;
    }

    public function getRecentConversion(): LengthAwarePaginator
    {
        return Conversion::orderBy('created_at', 'desc')->paginate(15);
    }

    public function getTopTenConversion(): Collection
    {
        return Conversion::latest()->take(10)->get();
    }
}
