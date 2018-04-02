<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{

    private $shelf;
    private $basket;


    public function __construct()
    {
        $this->shelf = new Shelf();
        $this->basket = new Basket($this->shelf);
    }

    /**
     * @Given there is a(n) :product, which costs $:price
     */
    public function thereIsAWhichCostsPs($product, $price)
    {
        $this->shelf->setProductPrice($product, floatval($price));

    }

    /**
     * @When I add the :product to the basket
     */
    public function iAddTheToTheBasket($product)
    {
        $this->basket->addProduct($product);
    }

    /**
     * @Then I should have :count product(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($count)
    {
        $this->visitPath('/');
        
        $pageTitle = $this->getSession()->getPage()->find('css', '.panel-heading');

        PHPUnit_Framework_Assert::assertEquals('List of Game of Thrones Characters',$pageTitle->getText());
        #PHPUnit_Framework_Assert::assertEquals('QUALQUER COISA',$pageTitle->getText());

        PHPUnit_Framework_Assert::assertCount(
            intval($count),
            $this->basket
        );
    }

    /**
     * @Then the overall basket price should be $:price
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        PHPUnit_Framework_Assert::assertSame(
            floatval($price),
            $this->basket->getTotalPrice()
        );
    }

}
