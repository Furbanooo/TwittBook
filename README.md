# 📘 Tweetbook

**Tweetbook** is a school project demonstrating the development of a secure and modular RESTful API using **PHP** and **MySQL**. The application focuses on key backend principles such as user authentication, structured routing, and secure data handling.

---

## Features

- **User Authentication**  
  Registration, login, and token-based session management.

- **RESTful API Design**  
  Clean, modular, and resource-oriented routing for full CRUD support.

- **Data Security**  
  Input validation, password hashing, and prepared SQL statements to prevent injection attacks.

---

## API Overview

The API provides full CRUD functionality for two core resources: **Users** and **Posts (Tweets)**.

### Authentication Routes

| Method | Endpoint         | Description                         |
|--------|------------------|-------------------------------------|
| POST   | `/api/register`  | Register a new user                 |
| POST   | `/api/login`     | Authenticate user and return token |
| POST   | `/api/logout`    | Logout and invalidate token        |

---

### User Routes

| Method | Endpoint           | Description                       |
|--------|--------------------|-----------------------------------|
| GET    | `/api/users`       | Retrieve all users (admin/public)|
| GET    | `/api/users/{id}`  | Get a specific user profile      |
| PUT    | `/api/users/{id}`  | Update user profile              |
| DELETE | `/api/users/{id}`  | Delete user account              |

---

### Post (Tweet) Routes

| Method | Endpoint           | Description                         |
|--------|--------------------|-------------------------------------|
| GET    | `/api/posts`       | Fetch all posts                     |
| GET    | `/api/posts/{id}`  | Retrieve a specific post by ID      |
| POST   | `/api/posts`       | Create a new post (auth required)   |
| PUT    | `/api/posts/{id}`  | Update a post (author only)         |
| DELETE | `/api/posts/{id}`  | Delete a post (author or admin)     |

---

> Built as part of a web development course project to demonstrate secure backend practices and modern API architecture.

