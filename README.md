# cs496
This project is for a senior software project. The intention of this project is to create a web application simulator that allows users to create decks of cards that can be used to compete with other player's deck either as an attacker or a defender.
 
# Installation
1. Make sure you have php>7.2 and node>8
2. run `composer install`
3. Change values under `DATABASE_URL` in `.env`
4. (optional) change values under `MAILER_URL` in `.env` to be able to send emails
5. Run `php bin/console doctrine:schema:create`
6. Run `yarn install`
7. Run `yarn run encore dev`
8. (optional) To run the server use `php bin/console server:run`
