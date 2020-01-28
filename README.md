# Shopping List

A shopping list app built using Laravel.

# Features
- View/refresh list
- add item to list
- remove item from list
- update item
- sort by item name, id number, date created, date modified; fowrard and reverse
- add new list
- remove list
- switch between lists

# Tech used
- Frameworks
  - Laravel, api
  - Angularjs, front end logic
  - Bootstrap, style
- Server
  - nginx
  - Amazon EC2

# SQL Schema
## Table: items
- Columns:
  - id bigint(20) UN AI PK 
  - list_id bigint(20) 
  - item varchar(240) 
  - created datetime 
  - modified datetime
  
## Table: lists
- Columns:
  - list_id bigint(20) AI PK 
  - list_name varchar(45) 
  - description varchar(240)
