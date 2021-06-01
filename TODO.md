# PHP eCommerce with MVC OOP

Want to add an htaccess file to prevent users from accessing the app folder

Next make sure the website is viewed from the index.php page to avoid add ?? in the url ie in order to have clean URLs - we add an htaccess file which controls how requests are handled

use print_r() to view objects and debugging

created a class with default method since it's used nowhere else
then with a constructor that runs immediately

- creating views

* connect template to our mvc
* add assets

* login and signup page
  You could redirect user to the 404 page if the page doesn't exist or link is broken

* Posting on login and signup

Models are classes which do specific things
A simple model be used by many controller

Db connection instancing
DB read and write functions

- User class:
  add regular expression:
  signup validation

- Authentication

Sign up duplicates

apply Password hashing

add login feature

Check login function: display name
add logout feature: create logout controller

- Admin template
  create admin controller

- User profile
  to create a page start with the controller

- Modify admin page

- Limit admin access

- Populate admin sidebar:
  products-> add, edit & delete
  categories-> add, edit & delete
  orders->
  settings
  home->images
  customers
  admins
  website backup

  - product and category tables

  - add new categories view
    add categories table
    using ajax to create category
    collect category name and save to db - create model for creating the category

  - read category from db

  - disable / enable categories
  - delete categories

  - Edit category in UI
    populate input fields with category name
    
