# Parameters (optional)
# * `arg`: arbitrary arguments to pass to rules (default: none)
arg ?=

# Docker containers
LIB_SERVICE = memio-memio

# Executables
COMPOSER = docker exec $(LIB_SERVICE) composer
PHP_CS_FIXER = docker exec $(LIB_SERVICE) php vendor/bin/php-cs-fixer
PHPSTAN = docker exec $(LIB_SERVICE) php vendor/bin/phpstan --memory-limit=256M
PHPUNIT = docker exec $(LIB_SERVICE) php vendor/bin/phpunit
RECTOR = docker exec $(LIB_SERVICE) php vendor/bin/rector
SWISS_KNIFE = docker exec $(LIB_SERVICE) php vendor/bin/swiss-knife

# Misc
.DEFAULT_GOAL = help
.PHONY: *

## ——  🔭 The Super Secret Makefile  ——————————————————————————————————————————————
## Based on https://github.com/dunglas/symfony-docker
## (arg) denotes the possibility to pass "arg=" parameter to the target
##     this allows to add command and options, example: make composer arg='dump --optimize'
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' \
		| sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
docker: ## Runs Docker (arg, eg `arg='ps'`)
	@docker $(arg)

docker-init: ## Builds the Docker image and starts the container in detached mode
	@docker build --platform linux/amd64 --pull -t $(LIB_SERVICE) .
	@docker run -d --platform linux/amd64 --name $(LIB_SERVICE) -v .:/app $(LIB_SERVICE) tail -f /dev/null

docker-down: ## Stops and removes the container
	@docker rm -f $(LIB_SERVICE) 2>/dev/null || true

docker-bash: ## Opens a (bash) shell in the container
	@docker exec -it $(LIB_SERVICE) bash

## —— PHP 🐘 ———————————————————————————————————————————————————————————————————
composer: ## Runs Composer (arg, eg `arg='outdated'`)
	@$(COMPOSER) $(arg)

composer-install: ## Install dependencies (arg, eg `arg='--no-dev'`)
	@$(COMPOSER) install --optimize-autoloader $(arg)

composer-update: ## Updates dependencies (arg, eg `arg='--no-dev'`)
	@$(COMPOSER) update --optimize-autoloader $(arg)

composer-dump: ## Dumps autoloader (arg, eg `arg='--classmap-authoritative'`)
	@$(COMPOSER) dump-autoload --optimize --strict-psr --strict-ambiguous $(arg)

cs-check: ## Checks CS with PHP-CS-Fixer (arg, eg `arg='../monolith/web'`)
	@$(PHP_CS_FIXER) fix --dry-run --verbose $(arg)

cs-fix: ## Fixes CS with Swiss Knife and PHP-CS-Fixer
	@$(SWISS_KNIFE) namespace-to-psr-4 config --namespace-root 'Memio\\Memio\\Config\\'
	@$(SWISS_KNIFE) namespace-to-psr-4 examples --namespace-root 'Memio\\Memio\\Examples\\'
	@$(PHP_CS_FIXER) fix --verbose $(arg)

phpstan: ## Static Analysis with PHPStan (arg, eg `arg='--level=6'`)
	@$(PHPSTAN) analyze $(arg)

swiss-knife: ## Automated refactorings with Swiss Knife (arg, eg `arg='namespace-to-psr-4 src --namespace-root \'App\\\''`)
	@$(SWISS_KNIFE) $(arg)

phpunit: ## Runs the tests with phpunit (arg, eg `arg='--filter=testFoo'`)
	@$(PHPUNIT) $(arg)

rector-fix: ## Automated refactorings with Rector (arg, eg `arg='--clear-cache'`)
	@$(RECTOR) $(arg)

rector-check: ## Refactoring checks with Rector
	@$(RECTOR) process --dry-run

## —— Lib 📚 ———————————————————————————————————————————————————————————————————
lib-init: ## First install / resetting (Docker build, up, etc)
	@echo ''
	@echo '  // Installing git hooks...'
	@git config core.hooksPath hooks
	@echo ''
	@echo '  // Stopping lib docker services...'
	@$(MAKE) docker-down
	@echo ''
	@echo '  // Starting lib docker services...'
	@$(MAKE) docker-init
	@echo ''
	@echo '  [OK] Lib initialized'

lib-qa: ## Runs full QA pipeline (composer-dump, cs-check, phpstan, rector-check, phpunit)
	@echo ''
	@echo '  // Running composer dump...'
	@$(MAKE) composer-dump
	@echo ''
	@echo '  // Running PHP CS Fixer...'
	@$(MAKE) cs-check
	@echo ''
	@echo '  // Running PHPStan...'
	@$(MAKE) phpstan
	@echo ''
	@echo '  // Running Rector...'
	@$(MAKE) rector-check
	@echo ''
	@echo '  // Running phpunit...'
	@$(MAKE) phpunit
	@echo ''
	@echo '  [OK] QA done'
