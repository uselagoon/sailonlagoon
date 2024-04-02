FROM amazeeio/redis-persistent

#######################################################
# Finalize Environment
#######################################################

# Horizon runs nicely with multiple databases
ENV DATABASES=5
