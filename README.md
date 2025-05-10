# CRUD Application

A simple and CRUD (Create, Read, Update, Delete) application built with Laravel. 


Installation

Follow these steps to set up and run this project:

    Clone the Repository:
    bash

git clone https://github.com/3kassi/CRUD.git
cd CRUD

Install Dependencies:
bash

composer install
npm install

Set Up the Environment:

    Copy the .env.example file to .env:
    bash

    cp .env.example .env

    Update the .env file with your database and other configurations.

Generate Application Key:
bash

php artisan key:generate

Run Database Migrations:
bash

php artisan migrate

Start the Local Development Server:
bash

    php artisan serve

    Access the Application: Open your browser and go to http://localhost:8000.

Usage

    Open the application in your browser.
    Use the navigation menu to create, read, update, or delete ProductCard records.
    Export data to CSV for reporting or backup.

File Structure

Key files and their purposes:

    
    app/Http/Controllers/ProductCardController.php: Handles CRUD operations for ProductCard.
    app/Models/ProductCard.php: Represents the ProductCard database model.
    resources/views/  product_cards/: Contains all views (Blade templates) related to the ProductCard features .
    2025_05_09_085928_product_cards_table.php
     database/factories/UserFactory.php: This factory is used to generate sample data for the User model.

Table structure

    Table Name: product_cards
    Fields:
        id: Primary key (Auto-incrementing).
        sku: String, unique identifier for the product.
        product_name: String, name of the product.
        product_group: String, group/category of the product.
        expiration_date: Date, expiration date of the product.
        description: Text, optional description for the product.
        timestamps: Automatically managed created_at and updated_at fields.


