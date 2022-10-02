## Requirement Version

 PHP 8.0

 Mysql 5.7

 composer  2.1.8


## Installation

Step 1:-composer uppdate

Step 2:-Setup the .env change the DB crednetial if requirement.

Step 3:-Run the command php artisan passport:install

Step 4:-Run the command php artisan migrate

Step 5:run the command php artisan db:seed

Step 6:-Run the command php artisan serve

Step 7:Run the api 

# case and validation

#Unauthenticated

this case genrated when user not login.

when the "message": "Your loan request is already exist.Your loan request has been sent to the admin and will be approved soon.",

# Then :-
you get this validation, you will have to approved the status from the databse by goin to the loan_requests table, which will be done by the admin.


## POSTMAN Collection link
https://www.getpostman.com/collections/2455c714e26d86fbd7bb

# HOW TO USE API

after the import collection.
# Login
 First the user will login then he will get a token in response.For that token you have to go to postman Authorisation section and select the type Barrier token and paste the token.

# First Api (loan request)

user create the loan request.

# Second Api (user-payment)

user paid the payment minimum three step.

# Third Api (user-payment)

Weekly will hit this api when user has to pay to loan.

# Fourth Api (current-loan)

this api will show the current loan of the user.

# next Api (loan-history)

this api will show the All loan history of the user.


#if any issue please comment 

