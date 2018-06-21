# Morsum Coding Challenge

Challenge:
  - In this test we will ask you to create your own tool, to speed things up in the future. The purpose is to build a light-weight MVC framework. The exercise should emphasis traditional MVC directory structure.
  - There should be a single point of entry. All request should go through the root's index.php
  - At least a model, a controller and a view should be done.
  - Brief explanation of multiple HTTP requests (GET, POST, ?) and responses (headers and status codes) to the application
  - Create another controller or use the same controller to serve an AJAX request, using jQuery to retrieve it.
  - Use a MySQL backend for the data.

# Setup
```sh
  - $ git clone https://github.com/dechadou/morsum-cc.git
  - $ cd morsum-cc
  - $ composer install
  - $ import the db file located on ./db/database.sql
  - Find .env.example file on the root, rename it to .env, and fill the DB credentials
```
Access site: http://localhost/morsum-cc
`Please do not use Built in php server`

# Notes
 - While there are a couple of AJAX request methods and some reload page, this was an intent to show different forms of request.
 - Multiple dependencies has been used in order to not redo code standards
 - Display errors is ON, you can turn them off on the index.php file located on the public folder
