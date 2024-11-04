## How i setup the redis for this project

1. Configuring Docker for Redis
Objective: To add Redis as a caching service to optimize data retrieval in the Laravel application.

Steps Taken:
Created a docker-compose.yml file in the project root to define the Redis service.
Added the Redis service with the image redis:alpine for a lightweight, production-ready Redis setup.
Exposed Redis on port 6379 and linked it to a named volume redis-data to persist Redis data across container restarts.

version: "3.1"
services:
 redis:
      image: redis:alpine
      container_name: myapp-redis
      command: redis-server --appendonly yes --requirepass "${REDIS_PASSWORD}"
      volumes:
      - ./data/redis:/data
      ports:
        - "8002:6379"



2. Configuring Laravel to Use Redis

   Objective: Set Laravel’s cache, session, and queue drivers to use Redis for optimized performance.

   Steps Taken:
Updated the .env file with Redis connection details:

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379


Set REDIS_HOST=redis to match the service name defined in docker-compose.yml (Docker’s internal network makes this possible).
Confirmed Redis configurations in config/database.php, with Laravel’s default setup for Redis.

3. Starting Docker Services
Command: Ran docker-compose up -d to start the Laravel application along with the Redis service.
Result: Both services (app and Redis) are now running in separate containers, allowing the Laravel app to access Redis for caching and other optimizations.

4. Testing the Redis Setup in Laravel
Objective: To ensure Redis is functioning correctly as a caching layer in Laravel.
Testing Steps:
i created a controller called TestRedisConnection to see that the connection returned PONG after it was pinged and it worked successfully

Redis::connection()->ping();



