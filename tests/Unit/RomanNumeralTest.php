<?php

namespace Tests\Unit;

use App\Models\Conversion;
use App\Services\Contracts\IntegerConverterService;
use App\Services\IntegerConverterInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RomanNumeralTest extends TestCase
{
    use RefreshDatabase;
    private Collection|Model $conversion;
    private IntegerConverterService $converter;
    public array $toTest = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->conversion = Conversion::factory()->create();

        $this->toTest = [
            'I' => 1,
            'IV' => 4,
            'V' => 5,
            'IX' => 9,
            'X' => 10,
            'C' => 100,
            'XL' => 40,
            'L' => 50,
            'XC' => 90,
            'CD' => 400,
            'D' => 500,
            'CM' => 900,
            'M' => 1000,
        ];

        $this->converter = new IntegerConverterService();
    }

    public function testConvertsIntegersToRomanNumerals(): void
    {
        foreach ($this->toTest as $returnValue => $integer) {
            $this->assertSame($returnValue, $this->converter->convertInteger($integer));
        }

        // Test more unique integers
        $this->assertSame('MMMCMXCIX', $this->converter->convertInteger(3999));
        $this->assertSame('MMXVI', $this->converter->convertInteger(2016));
        $this->assertSame('MMXVIII', $this->converter->convertInteger(2018));
    }

    public function testEmptyStringForZero(): void
    {
        $this->assertEquals('', $this->converter->convertInteger(0));
    }

    public function testRecentConversions(): void
    {
        $response = $this->getJson('/api/recent/conversion');
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'integer_value', 'roman_value']]]);
        $response->assertOk();
        $this->assertDatabaseHas('conversions', ['roman_value' => $this->conversion->roman_value]);
    }

    public function testTopTenConversions(): void
    {
        $this->conversion = Conversion::factory(10)->create();
        $response = $this->getJson('/api/top10/conversion');
        $response
            ->assertStatus(200);
        $response->assertOk();
        $this->assertSame(count($response->json()['data']), count($this->conversion));
    }
}
