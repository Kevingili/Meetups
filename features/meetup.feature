Feature: Meetup
  In order to create a meetup
  As guest
  I need to give a title, date begin, date end and description

  Rules:
  - field can't be empty
  - date begin must be like XX-XX-XXXX and must be a correct date
  - date end must be like XX-XX-XXXX and must be a correct date
  - date begin must be inferior to date end



  Scenario: Create a meetup with correct field
    Given I am on "/meetups/new"
    When I fill in "Title" with "Title"
    And I fill in "Date Begin" with "2018-04-04"
    And I fill in "Date End" with "2018-05-05"
    And I fill in "Description" with "Description"
    And I press "Submit"
    Then The meetup should be true

  Scenario: Create a meetup with wrong date
    Given I am on "/meetups/new"
    When I fill in "Title" with "Title"
    And I fill in "Date Begin" with "aaaaaa"
    And I fill in "Date End" with "2018-05-05"
    And I fill in "Description" with "Description"
    And I press "Submit"
    Then The meetup should be false

  Scenario: Create a meetup with empty title
    Given I am on "/meetups/new"
    When I fill in "Title" with " "
    And I fill in "Date Begin" with "2018-04-04"
    And I fill in "Date End" with "2018-05-05"
    And I fill in "Description" with "Description"
    And I press "Submit"
    Then The meetup should be false

  Scenario: Create a meetup with date begin superior to date end
    Given I am on "/meetups/new"
    When I fill in "Title" with "Title"
    And I fill in "Date Begin" with "2018-09-09"
    And I fill in "Date End" with "2018-05-05"
    And I fill in "Description" with "Description"
    And I press "Submit"
    Then The meetup should be false