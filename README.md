# Project Management Tool

## Overview

This project is a web-based project management tool with a backend built using Laravel and a frontend using Vue.js. The application allows users to manage projects and tasks efficiently. It also utilizes Docker for easy setup and deployment.

## Features

- **Backend**: Developed using Laravel, with RESTful APIs for project and task management.
  - **Project Management**:
    - Create, read, update, and delete projects.
    - Assign tasks to projects.
    - Repository pattern for data access.
    - Authentication using Laravel Sanctum.
    - API Postman collection included.
- **Frontend**: Built with Vue.js. Currently includes:
    - **Login Page**: User authentication.
    - **Project List**: Display a list of projects.
    - **Task List**: Display tasks for a selected project.

## Getting Started

### Prerequisites

Ensure you have the following installed:
- Docker
- Docker Compose
- Node.js and npm (for frontend development)
- PHP and Composer (for backend development, if not using Docker)

### Setup with Docker

To set up the project using Docker, follow these steps:

1. **Clone the Repository**:

    ```bash
    git clone git remote add origin https://github.com/Alhessan/project-task.git
    cd project-management-tool
    ```

2. **Build and Start Containers**:

   This will build the Docker images and start the containers.

    ```bash
    docker-compose up --build
    ```

3. **Access the Application**:

    - **Frontend**: Open [http://localhost:8080](http://localhost:8080) or port 8081 in your browser.
    - **Backend**: The Laravel backend runs inside a Docker container and can be accessed via the API endpoints exposed.

4. **Database Migrations** (if using Docker):

   Run migrations inside the Laravel container:

    ```bash
    docker-compose exec app php artisan migrate
    ```

### Frontend Development

The frontend is currently incomplete. The following features are available:
- **Login Page**: Accessible at `/login`.
- **Project List**: Displays a list of projects.
- **Task List**: Displays tasks for the selected project.

### Additional Notes

- **Backend**: The backend is fully functional and provides RESTful endpoints for projects and tasks.
- **Frontend**: Work is ongoing to complete additional features. The current state includes basic functionality for login, project listing, and task listing.

### Directory Structure

- `frontend/` - Vue.js frontend application.
- `backend/` - Laravel backend application.
- `docker-compose.yml` - Docker Compose configuration.
