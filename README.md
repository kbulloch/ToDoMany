#To Do List with Categories

#####By Kyle Bulloch and Brian Kropff

-----

#####Description
This app lists tasks and their categories, using many to many relationship in
SQL databases.  A task can have many categories and a category can hold many tasks.  The user can create, read, update and destroy tasks and categories.

#####Setup

Pre-requisites: Must have PHP installed.

These commands are for the user that chooses a Mac.  In your terminal, do:
```
git clone https://github.com/kbulloch/ToDoMany.git

cd ToDoMany/web

php -S localhost:8000

(then in a new window)

postgres

(then in a new tab)

psql

CREATE DATABASE to_do;
\c to_do;
CREATE TABLE categories (id serial PRIMARY KEY, name varchar);
CREATE TABLE tasks (id serial PRIMARY KEY, description varchar);
CREATE TABLE categories_tasks (id serial PRIMARY KEY, category_id int, task_id int);
CREATE DATABASE to_do_test WITH TEMPLATE to_do;
\c to_do_test;
```
You should now be able to open a browser and point it to localhost:8000 to
see the to do list site.

-----

Copyright (c) 2015 Kyle Bulloch and Brian Kropff

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
