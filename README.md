# Laravel Book Store Backend

This is the backend API for the Book Store application, built with Laravel.

## Installation and Setup

1. Clone the repository: 

- `git clone` https://github.com/NibrasMohamed/book_store_backend.git

2. Navigate to the project directory: 

- `cd book-store-backend`

3. Install the Composer dependencies:

- `composer install`

4. Create a copy of the `.env.example` file and rename it to `.env`:

- `cp .env.example .env`

5. Generate a new application key:

- `php artisan key:generate`

6. Configure your database connection in the `.env` file.

7. Run the database migrations and seed the database:

- `php artisan migrate --seed`

8. Install Laravel Passport for OAuth2 authentication:

- `php artisan passport:install`

9. Make Sure to Link the Storage

- `php artisan storage:link`

10. Start the Laravel development server:

- `php artisan serve`


## API Endpoints

The following are the main API endpoints:

- `POST /api/register`: Register a new user.
- `POST /api/login`: Authenticate and log in a user.
- `GET /api/authors`: Get a list of authors.
- `GET /api/books`: Get a list of books.
- `GET /api/books/{id}`: Get a specific book by ID.
- `POST /api/books`: Create a new book (requires authentication).
- `PUT /api/books/{id}`: Update an existing book (requires authentication).
- `DELETE /api/books/{id}`: Delete a book (requires authentication).

## Authentication

The API uses Laravel Passport for OAuth2 authentication. To authenticate API requests, obtain an access token by registering a user and logging in.



