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


