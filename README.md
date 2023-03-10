# Symfony-BEHAT


# Installation
Clone the project :
```sh
git clone git@github.com:abdelaziz-tleti/Symfony-BEHAT.git
cd Symfony-BEHAT
```
Init Project ( Install dependencies & start docker .. )  
```sh
bin/workspace init
```

Create sqlite test database 
Laod fixtures 
Execute Behat tests
```sh
bin/workspace behat
```
# Samples


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
    
    
 ![image](https://user-images.githubusercontent.com/3765550/224267733-bba94608-e258-4a24-a8db-767c96d87801.png)
