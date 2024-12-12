News Aggregator API - Laravel Backend
Description
This project is a RESTful API built using Laravel that acts as a news aggregator. It fetches news articles from multiple external news sources and provides endpoints to retrieve articles, manage user preferences, and more. It includes authentication via Laravel Sanctum, article management, user preference management, and data aggregation from external news APIs.

Features
User authentication with registration, login, logout, and password reset (via Laravel Sanctum).
Fetch articles with pagination, keyword search, and filtering by category, source, and date.
Personalized news feed based on user preferences (news sources, categories, and authors).
Regular aggregation of articles from multiple external APIs like NewsAPI, The Guardian, and BBC News.
API documentation provided via Swagger/OpenAPI.

Table of Contents

Installation
Running the Project with Docker
API Documentation
Endpoints

Additional Notes
Installation
To set up the News Aggregator API on your local machine, follow these steps:

Prerequisites
Docker
Docker Compose
Composer


Steps:
Clone the repository:
git clone https://github.com/firoz16/news-aggregator.git
cd news-aggregator


Install PHP dependencies:
composer install


Set up environment variables:
Copy the .env.example file to .env:
cp .env.example .env
Modify the .env file to include your configuration, such as your database settings and API keys for external news sources (NewsAPI, Guardian, etc.).

Example:

env
Copy code
APP_NAME=NewsAggregator
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aggregator_db
DB_USERNAME=root
DB_PASSWORD=secret

NEWS_API_KEY=your_news_api_key
GUARDIAN_API_KEY=your_guardian_api_key
BBC_API_KEY=your_bbc_api_key


Run the Docker containers (if using Docker):
Ensure Docker and Docker Compose are installed, and then run:
docker-compose up --build
This will set up the Laravel app, MySQL database, and other required services in containers.


Access the Laravel application:

Once the containers are running, you can access the API at:

http://localhost/news-aggregator


Access the MySQL Database:

You can also access the MySQL database using a database management tool (e.g., DBeaver, phpMyAdmin) or through the command line:

docker-compose exec mysql bash
mysql -u root -p

Stopping Docker Containers:

To stop the containers, use:
docker-compose down


API Documentation
The API is fully documented using Swagger/OpenAPI. You can access the API documentation once the application is running at:
http://localhost/api/documentation
Alternatively, if you have the Swagger UI hosted elsewhere, provide the URL here.

Endpoints
Here are the key endpoints provided by the API:

User Authentication
POST /api/register: Register a new user.
POST /api/login: Login and get an API token.
POST /api/logout: Logout the user.
POST /api/password-reset: Request a password reset link.
POST /api/password-update: Reset the user's password.
Articles
GET /api/articles: Get a list of articles with pagination and filtering by category, source, and date.
GET /api/articles/{id}: Retrieve a single article's details.
POST /api/articles/fetch: Fetch articles from external APIs and store them in the database.
User Preferences
GET /api/preferences: Get the current user's news preferences (sources, categories, authors).
POST /api/preferences: Set or update the user's preferences for news sources, categories, and authors.

Additional Notes
Database: The application uses a MySQL database for storing user data, preferences, and articles.

Caching: The API uses caching to optimize performance for frequently requested data, such as articles.

Security: The application uses Laravel Sanctum for API token authentication and implements proper authorization checks for protected routes.

Testing: The project includes unit and feature tests for the API endpoints. You can run the tests with the following command:


docker-compose exec app php artisan test
