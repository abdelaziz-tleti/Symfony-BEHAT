<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\DataFixtures\ProductFixtures;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\Basket;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\Assert;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class DemoContext  extends WebTestCase implements Context
{

    /**
     * @var AbstractDatabaseTool
     */
    protected $databaseTool;



    /** @var Response|null */
    private $response;

    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    /**
     * @When a demo scenario sends a request to :path
     */
    public function aDemoScenarioSendsARequestTo(string $path): void
    {
        $this->response = $this->kernel->handle(Request::create($path, 'GET'));
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived(): void
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }


    /**
     * @Given loaded fixtures
     */
    public function loadedFixtures()
    {
        // $basket = new Basket();


        $basket  = new Basket();
        $product = $this->productRepository->findOneBy(array('price' => 5));
        //$product = $this->productRepository->findOneBy(array('price' => 10));

        $basket->add($product);
    }

    /**
     * @When I add a new product costing :arg1 € to the basket
     */
    public function iAddANewProductCostingEurToTheBasket($arg1)
    {
        // $this->databaseTool->loadFixtures([ProductFixtures::class]);



        $basket = new Basket();
        $product = $this->productRepository->findOneBy(array('price' => 5));
        //$product = $this->productRepository->findOneBy(array('price' => 10));

        $basket->add($product);
    }

    /**
     * @Then the basket price is :arg1 €
     */
    public function theBasketPriceIsEur($arg1)
    {
        // if($this->basket->price() != $arg1){
        //     throw new Exception('Le prix ne correspond pas');
        // }
    }

    /**
     * @When I add a new :arg1 to the :arg2
     */
    public function iAddANewProductToTheBasket($arg1)
    {
        $basket = new Basket();
        $product = $this->productRepository->findOneBy(array('price' => $arg1));
        $basket->add($product);
        Assert::assertNotEquals($basket->price(), '10');
    }

    /**
     * @When I add a new :arg1 to the basket ok
     */
    public function iAddANewToTheBasketOk($arg1)
    {
        $basket = new Basket();
        $product = $this->productRepository->findOneBy(array('price' => $arg1));
        $basket->add($product);
        Assert::assertEquals($basket->price(), '10');
    }
}
