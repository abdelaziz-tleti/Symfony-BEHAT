# Symfony-BEHAT
bin/workspace init

docker-compose exec php vendor/bin/behat


docker-compose exec php bin/console doctrine:fixtures:load --append



    Scenario: Basket with one product 5 from database
        Given loaded fixtures
        When I add a new 5 to the basket
        Then the basket price is 10 €

    Scenario: Basket with one product 10 from database
        Given loaded fixtures
        When I add a new 10 to the basket ok
        Then the basket price is 10 €


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