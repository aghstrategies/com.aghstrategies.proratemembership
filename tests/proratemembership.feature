Feature: Prorates new memberships based on when the user is signing up as compared to the rollover date and term.

Scenario: New Member is signing up

Given the membership type is fixed
And has the <rolloverDate>
And a start date of 1/01
And the membership type's term is <termLength> with <unit>
And the membership price is <amount> for <numberOfTerms>
And the user is registering on <date>
Then the user will be charged <total> for the membership


| rolloverDate | termLength | unit | amount | numberOfTerms | date   | total   |
| 9/30         | 1          | year | $12.00 | 1             | 2/01   | $11.00  |
| 9/30         | 1          | year | $12.00 | 1             | 10/31  | $15.00  |
