This Extension:
--------------

Prorates membership dues based for fixed roll over date memberships based on when the user is signing up.

Ex: If for the membership type the rollover date is 12/31 and the membership rate is $12.00 and the term is one year If the user signs up for a membership on 12/1 they will only be charged $1.00.

If there are options for more than one term this still works..

EX: If for the membership type the rollover date is 12/31 and the membership rate is $12.00  and the term is one year If the user signs up for a membership on 12/1 for two terms they will be charged $13.00.


TODO:

Add a setting to set which membership types get prorated

+ Make a setting for proratefixedmembership that is a checkbox
+ using the buildform hook add the checkbox to the edit price field (in this example for 455)
+ using the postprocess hook when the edit price field form is submitted save the setting to the database
