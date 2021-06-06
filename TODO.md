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
    -update edit data

- Product Class
  create a product controller and class file
  add a products view template

  - Save products to db
  - collect product data to db
  - save to db
  - add images to products
  - display images

- Add sub categories

- Edit product feature
- collect edit product data
- save images data to db

- Display products to UI

  - first thing is to read from db and modify the Home controller
  - then add a loop in the index.php page to display products from db

  - add product details page
  - add product image edit preview

  - add product slug
