# Shopping List

A shopping list app built using Laravel.

# Tech used
- Frameworks
  - Laravel
  - Angularjs
  - Bootstrap
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
