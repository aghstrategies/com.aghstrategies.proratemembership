Feature: Prorates new memberships based on when the user is signing up as compared to the rollover date and term.

Scenario: New Member is signing up

Given the membership type is fixed
And has the <rolloverDate>
And the membership type's term is <termLength> with <unit>
And the membership price is <amount> for <numberOfTerms>
And the user is registering on <date>
Then the user will be charged <total> for the membership


| rolloverDate | termLength | unit | amount | numberOfTerms | date  | total  |
| 12/31        | 1          | year | $12.00 | 1             | 12/01 | $1.00  |
| 12/31        | 1          | year | $12.00 | 2             | 12/01 | $13.00 |
