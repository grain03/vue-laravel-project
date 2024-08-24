# VueJS & Laravel Project

## Introduction

This project created in order to gain some new skills in using *VueJS* with *Laravel* and *RESTful APIs*, I chose to build a **Post Management Application**, where user can authenticate and have all CRUD options to manage his posts, and also abilty to see other users posts.

### Key Features of the Application

- User Authentication (Sign in and Sign up)
- Profile Management (Update Profile and Upload Profile Image)
- Post Management (Create, Read, Update, Delete posts)
- View Posts of Other Users

### Technologies Used

- [Laravel](https://laravel.com/): A PHP framework for building web applications.
- [VueJS](https://vuejs.org/): A progressive JavaScript framework for building user interfaces.
- [Axios](https://axios-http.com/): A promise-based HTTP client for making requests to APIs.
- [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum): A lightweight package for API authentication.
- [Vue Router](https://router.vuejs.org/): The official router for Vue.js applications.
- [Pinia](https://pinia.vuejs.org/): A state management library for Vue.js.

## Installation

### Frontend

Navigate to the frontend directory and install dependencies:

```bash
cd /frontend 

npm install
```

To start the development server:

```bash
npm run serve
```

### Backend

Navigate to the backend directory and install dependencies:

```bash
cd /backend 

composer install
```

Copy the .env.example file to .env:

```bash
copy .env.example .env

```

(*Note: If you are using Linux/MacOS, you can type cp, instead of copy*)

Run the migrations and seed the database:

```bash
php artisan migrate --seed
```

Start the Laravel development server:

```bash
php artisan serve
```

After completing these installation commands, open the following link in your browser: [http://localhost:8080/](http://localhost:8080/)

## API Documentation

### Base URL

```text
http://127.0.0.1:8000/api
```

### Endpoints

- Auth Endpoint
  - **/auth/login :** User login
  - **/auth/signup :** User registration
  - **/auth/logout :** User logout (requires authentication)

- Posts Endpoint
  - **/posts :** Get all posts
  - **/posts/show/{id} :** Get a specific post by ID
  - **/posts/store :** Create a new post (requires authentication)
  - **/posts/update/{id} :** Update a specific post by ID (requires authentication)
  - **/posts/delete/{id} :** Delete a specific post by ID (requires authentication)

- Profile Endpoint
  - **/profile :** Get user profile details (requires authentication)
  - **/profile/EditProfile :** Edit user profile (requires authentication)

- Token Validation Endpoint
  - **/TokenValidation :** Validate the authentication token
