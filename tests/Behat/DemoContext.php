<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\Basket;
use App\Entity\Product;
/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class DemoContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
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
     * @Given an empty basket
     */
    public function anEmptyBasket()
    {
        $this->basket = new Basket();
    }   


    /**
     * @When I add a new product costing :arg1 € to the basket
     */
    public function iAddANewProductCostingEurToTheBasket($arg1)
    {
        $product = new Product($arg1);
        $this->basket->add($product);
    }

   /**
     * @Then the basket price is :arg1 €
     */
    public function theBasketPriceIsEur($arg1)
    {
        if($this->basket->price() != $arg1){
            throw new Exception('Le prix ne correspond pas');
        }    }


}
