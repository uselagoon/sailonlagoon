FROM uselagoon/lagoon-cli:latest as LAGOONCLI
FROM uselagoon/php-8.3-cli

#######################################################
# Install PHP extensions
#######################################################
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install posix
RUN docker-php-ext-install exif

#######################################################
# Setup Laravel Directories needed for composer install
#######################################################
RUN mkdir -p /app/storage/framework/sessions
RUN mkdir -p /app/storage/framework/views
RUN mkdir -p /app/storage/framework/cache
RUN mkdir -p /app/storage/app/public
RUN mkdir -p /home/.config/psysh
RUN fix-permissions /home/.config/psysh

#######################################################
# Install Lagoon Tools Globally
#######################################################
# Lagoon CLI
COPY --from=LAGOONCLI /lagoon /usr/bin/lagoon

# Lagoon Sync
RUN DOWNLOAD_PATH=$(curl -sL "https://api.github.com/repos/uselagoon/lagoon-sync/releases/latest" | grep "browser_download_url" | cut -d \" -f 4 | grep linux_386) && wget -O /usr/bin/lagoon-sync $DOWNLOAD_PATH && chmod +x /usr/bin/lagoon-sync

#######################################################
# Copy files, and run installs for composer and yarn
#######################################################
COPY . /app
RUN if [ -f "composer.json" ]; then \
    COMPOSER_MEMORY_LIMIT=-1 composer install --no-interaction --prefer-dist --optimize-autoloader; \
    php artisan storage:link; \
  fi

RUN if [ -f "package.json" ]; then \
    npm install; \
    npm ci; \
    npm run build; \
  fi

#######################################################
# Finalize Environment
#######################################################
COPY lagoon/01-entry-point-setup-laravel.sh /lagoon/entrypoints/98-env-setup-laravel.sh
ENV WEBROOT=public
# ENV PHP_MEMORY_LIMIT=8192M
