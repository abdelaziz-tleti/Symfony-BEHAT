# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    In order to prove that the Behat Symfony extension is correctly installed
    As a user
    I want to have a demo scenario

    # Scenario: It receives a response from Symfony's kernel
    #     When a demo scenario sends a request to "/"
    #     Then the response should be received


    Scenario: Basket with one product
        Given loaded fixtures
        When I add a new product costing 10 € to the basket
        Then the basket price is 10 €


    Scenario: Basket with one product 5 from database
        #Given loaded fixtures
        When I add a new 9 to the basket
        Then the basket price is 9 €

    Scenario: Basket with one product 10 from database
        #Given loaded fixtures
        When I add a new 10 to the basket ok
        Then the basket price is 10 €