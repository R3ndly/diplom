<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Products;

class getPriceWithTaxTest extends TestCase
{
    public function test_get_rigth_price_with_tax()
    {
        // Создаем экземпляр продукта с ценой 100
        $product = new Products();
        $product->price = 100;

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
