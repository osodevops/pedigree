start: ## Start the environment.
	docker-compose up -d --build
	@echo ""
	@echo "You can now run \`make build\` if you it's the first time you're starting the environment."
build: # Install dependencies and prepare the application
	# Set up the back-end
	docker-compose exec application composer install
	docker-compose exec application cp .env.example .env
	docker-compose exec application php artisan key:generate
	docker-compose exec application php artisan migrate:fresh --seed
	docker-compose exec application php artisan cache:clear

	@echo ""
	@echo "Website hosted at: http://localhost:8000"