FROM uselagoon/redis-7-persistent

#######################################################
# Finalize Environment
#######################################################

# Horizon runs nicely with multiple databases
ENV DATABASES=5
