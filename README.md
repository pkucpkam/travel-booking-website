# Travel Booking Website - PHP

Travel Booking Website is a web application for browsing, booking, and managing travel destinations. It allows users to explore travel places, view hot deals, leave comments, plan trips, view detailed information about destinations, and search for locations. The application includes user and admin authentication and is built with PHP, MySQL, and runs in a Dockerized environment with phpMyAdmin for database management.

## Features
- **User Authentication**: Register and log in as a user or admin.
- **Place Listings**: View travel destinations (e.g., Hanoi, Ho Chi Minh City, Da Nang) with hot deals.
- **Comments**: Add and view comments for each destination.
- **Trip Planning**: Create and manage travel plans via the planning feature.
- **Detailed Views**: Access detailed information about specific destinations.
- **Search Functionality**: Search for travel destinations by name or location.
- **Admin Dashboard**: Manage travel data (accessible via admin login).
- **Responsive Design**: Mobile-friendly interface with CSS and JavaScript enhancements.

## Technologies
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Containerization**: Docker, Docker Compose
- **Database Management**: phpMyAdmin

## Prerequisites
- [Docker](https://www.docker.com/get-started) and [Docker Compose](https://docs.docker.com/compose/install/) installed.
- Basic knowledge of PHP, MySQL, and Docker.

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/<pkucpkam>/travel-booking-website.git
cd travel-booking-website
```

### 2. Configure Docker Compose
Ensure the `docker-compose.yml` file is set up as follows:

```yaml
version: '3.8'

services:
  php_web:
    image: php:8.0-apache
    container_name: php_web
    volumes:
      - ./src:/var/www/html
    ports:
      - "8081:80"
    depends_on:
      - mysql_db

  mysql_db:
    image: mysql:8.0
    container_name: mysql_db
    environment:
      MYSQL_ROOT_PASSWORD: rootpass123
      MYSQL_DATABASE: travel1
      MYSQL_USER: app_user
      MYSQL_PASSWORD: app_pass
    volumes:
      - mysql_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    environment:
      PMA_HOST: mysql_db
      MYSQL_ROOT_PASSWORD: rootpass123
    ports:
      - "8082:80"
    depends_on:
      - mysql_db

volumes:
  mysql_data:
```

### 3. Initialize the Database
1. Start the containers:
   ```bash
   docker-compose up -d --build
   ```

2. Access phpMyAdmin at `http://localhost:8082`:
   - Login with:
     - Username: `root`
     - Password: `rootpass123`
   - Select the `travel1` database.
   - Go to the **Import** tab, choose the `travel1.sql`, and click **Go** to import the database schema and sample data.

3. Grant privileges to `app_user` (if not included in `travel1.sql`):
   ```sql
   GRANT ALL PRIVILEGES ON travel1.* TO 'app_user'@'%' IDENTIFIED BY 'app_pass';
   FLUSH PRIVILEGES;
   ```

### 4. Run the Application
1. Start the Docker containers (if not already running):
   ```bash
   docker-compose up -d
   ```

2. Access the web application:
   - Website: `http://localhost:8081`
   - phpMyAdmin: `http://localhost:8082`

3. Test login credentials (default accounts from `travel1.sql`):
   - User: `testuser` / `testpass`
   - Admin: `admin1` / `adminpass`

### 5. Stop the Application
To stop the containers:
```bash
docker-compose down
```

To stop and remove volumes (reset database):
```bash
docker-compose down -v
```