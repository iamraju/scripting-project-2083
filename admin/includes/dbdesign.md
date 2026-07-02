# Ecommerce Database Design

dbName: swastik_ecom

## Tables

### users - to store administrative users

- id (integer(10)) auto_increment
- name (varchar(200)) not null
- email (as username) (varchar(200)) not null (unique)
- password (md5 encrypted password) (varchar(32)) not null
- status (boolean: tinyint(1)) 1: active 0: inactive default '1'
- last_login_time (timestamp) default current_timestamp

### categories - product categories

- id (integer(10)) auto_increment
- name - varchar(200) not null
- description (text) nullable
- status (boolean: tinyint(1)) 1: active 0: inactive default 1

### products - products to sell

- id (integer(10)) auto_increment
- sku char(5) not null (unique)
- category_id (integer(10)) not null
- name varchar(200) not null
- short_info (text) nullable
- description (text) nullable
- price double(8,2) 23.55
- sale_price double(8,2) default 0.00
- is_featured boolean: tinyint(1) 1: yes 0: - default 0
- is_sale boolean: tinyint(1) 1: yes 0: no - default 0
- image_name varchar(255) not null
- status boolean: tinyint(1) 1: active 0: inactive - default 1

# todo (to design tables)

- cart
- orders
- order_items
- customers
- contents (CMS pages)
