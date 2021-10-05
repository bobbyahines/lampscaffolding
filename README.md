# bobbyahines/lamp-scaffolding
A small web application framework for rapid prototyping.

## Getting Started

### Docker

Docker is treated as a first class platform in this stack, and assumes your familiarity.

### Development Mode

1. Run `docker-compose -f docker-compose.yml up -d`
2. docker exec -it app composer install
3. docker exec -it app chown -R www-data:www-data storage/
4. Copy example.env to .env
5. Check your localhost in a browser.

### Running Unit Tests

`docker exec -it app php vendor/bin/phpunit tests`