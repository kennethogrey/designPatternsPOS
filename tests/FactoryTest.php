<?php
use PHPUnit\Framework\TestCase;
use App\ProductFactory;
use App\Clothing;
use App\Electronics;
use App\Groceries;

class FactoryTest extends TestCase
{
    public function testCreateElectronicsProduct()
    {
        $_POST["name"] = "iPhone";
        $_POST["cost"] = 1000;
        $_POST["category"] = "Electronics";

        $factory = new ProductFactory();
        $product = $factory->create($_POST["category"]);

        $this->assertInstanceOf(Electronics::class, $product);
        $this->assertEquals($_POST["name"], $product->getName());
        $this->assertEquals($_POST["cost"], $product->getCost());
        $this->assertEquals($_POST["category"], $product->getCategory());
    }

    public function testCreateClothingProduct()
    {
        $_POST["name"] = "T-Shirt";
        $_POST["cost"] = 20;
        $_POST["category"] = "Clothing";

        $factory = new ProductFactory();
        $product = $factory->create($_POST["category"]);

        $this->assertInstanceOf(Clothing::class, $product);
        $this->assertEquals($_POST["name"], $product->getName());
        $this->assertEquals($_POST["cost"], $product->getCost());
        $this->assertEquals($_POST["category"], $product->getCategory());
    }

    public function testCreateGroceriesProduct()
    {
        $_POST["name"] = "Milk";
        $_POST["cost"] = 2;
        $_POST["category"] = "Groceries";

        $factory = new ProductFactory();
        $product = $factory->create($_POST["category"]);

        $this->assertInstanceOf(Groceries::class, $product);
        $this->assertEquals($_POST["name"], $product->getName());
        $this->assertEquals($_POST["cost"], $product->getCost());
        $this->assertEquals($_POST["category"], $product->getCategory());
    }
}