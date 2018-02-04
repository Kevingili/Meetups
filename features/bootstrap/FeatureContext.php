<?php

// features/bootstrap/FeatureContext.php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

class FeatureContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     */
    private $meetup;

    public function __construct()
    {
        $this->meetup = new Meetup();
    }

    /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        Assert::assertTrue($arg1 == "/meetups/new");
    }

    /**
     * @When I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2)
    {
        if ($arg1 == "Title" && $arg2){
            $this->meetup->setTitle(trim($arg2));
            return true;
        }
        if ($arg1 == "Date Begin"){
            $this->meetup->setDatebegin($arg2);
            return true;
        }
        if ($arg1 == "Date End"){
            $this->meetup->setDateend($arg2);
            return true;
        }
        if ($arg2 == "Description"){
            $this->meetup->setDescription($arg2);
            return true;
        }
        Assert::assertTrue(false);
    }

    /**
     * @When I press :arg1
     */
    public function iPress($arg1)
    {
        if ($arg1 == "Submit"){
            return true;
        }
        Assert::assertTrue(false);
    }

    /**
     * @Then The meetup should be true
     */
    public function theMeetupShouldBeTrue()
    {
        Assert::assertTrue($this->meetup->isMeetupOk());
    }

    /**
     * @Then The meetup should be false
     */
    public function theMeetupShouldBeFalse()
    {
        Assert::assertFalse($this->meetup->isMeetupOk());
    }
}
