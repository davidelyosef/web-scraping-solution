# Web Crawler Project Readme

## Project Overview

This Laravel-based web crawler project extracts URLs from a given website by utilizing MongoDB as the database, GuzzleHttp for HTTP requests, Jenssegers for MongoDB Eloquent, Maarwebsite/Excel for Excel file support, and Weidner/Goutte for web scraping. 
The front end is designed using HTML, CSS, Bootstrap, jQuery, and AJAX to enhance user experience.
There is also an angular project inside the frontend directory that can be connected to the backend.

## Backend Project Structure

- **app/Console/Commands/WebCrawlerCommand.php:**
  - Laravel console command for initiating the web crawling process.

- **app/Models/Link.php:**
  - Eloquent model representing the Link entity, storing crawled URL data.

- **resources/views/welcome.blade.php:**
  - Main view file containing the HTML structure and user interface.

- **public/css/app.css:**
  - Custom CSS styles for styling the user interface.

- **public/js/app.js:**
  - JavaScript file containing jQuery and AJAX scripts for dynamic interactions.

- **routes/web.php:**
  - Laravel routes defining web routes for the application.

- **storage/app/public/excel/:**
  - Storage directory for generated Excel files.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/davidelyosef/web-scraping-solution.git
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Copy the `.env.example` file to `.env` and configure your database settings.

4. Run migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

5. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

6. Access the application in your browser: [http://localhost:8000](http://localhost:8000)

## Usage

1. Open the web application in your browser.

2. Enter the target URL in the provided input field.

3. Click the "Crawl" button to initiate the crawling process.

4. View the crawled URLs on the web interface.

5. Download the crawled URLs in Excel format using the "Download Excel" button.

## Dependencies

- Laravel: [https://laravel.com/](https://laravel.com/)
- MongoDB: [https://www.mongodb.com/](https://www.mongodb.com/)
- GuzzleHttp: [https://docs.guzzlephp.org/](https://docs.guzzlephp.org/)
- Jenssegers/Mongodb: [https://github.com/jenssegers/laravel-mongodb](https://github.com/jenssegers/laravel-mongodb)
- Maarwebsite/Excel: [https://github.com/Maatwebsite/Laravel-Excel](https://github.com/Maatwebsite/Laravel-Excel)
- Weidner/Goutte: [https://github.com/FriendsOfPHP/Goutte](https://github.com/FriendsOfPHP/Goutte)

## Contributors

- David el Yosef
- davidyf96@gmail.com

## License

This project is licensed under the [MIT License](LICENSE).