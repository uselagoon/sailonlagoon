ARG CLI_IMAGE
FROM ${CLI_IMAGE} as cli
FROM uselagoon/php-8.3-fpm

#######################################################
# Setup Laravel Directories needed
#######################################################
RUN mkdir -p /app/storage/framework/sessions
RUN mkdir -p /app/storage/framework/views
RUN mkdir -p /app/storage/framework/cache
RUN mkdir -p /app/storage/app/public
RUN mkdir -p /home/.config/psysh
RUN fix-permissions /home/.config/psysh

#######################################################
# Copy the prebuild laravel app to the Nginx container
#######################################################
COPY --from=cli /app /app

#######################################################
# Finalize Environment
#######################################################
COPY lagoon/01-entry-point-setup-laravel.sh /lagoon/entrypoints/98-env-setup-laravel.sh
