<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Products;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminProductController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class getPriceWithTaxTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_rigth_price_with_tax()
    {
        // Создаем экземпляр продукта с ценой 100
        $product = new Products();
        $product->price = 100; // Устанавливаем цену

        $taxRate = 0.2; // 20% налог
        $result = $this->getPriceWithTax($product->price, $taxRate);
        
        // Ожидаемая цена с налогом: 100 + (100 * 0.2) = 120 , а не 999
        $this->assertEquals(120, $result);
    }

    private function getPriceWithTax($price, $taxRate)
    {
        return $price + ($price * $taxRate);
    }

}
