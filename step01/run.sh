docker run --rm -e MARIADB_ROOT_PASSWORD=123456 -e MARIADB_DATABASE=jobboard -v $PWD:/docker-entrypoint-initdb.d -p 3306:3306 mariadb

# save db
# docker exec -it CONTAINER /usr/bin/mysqldump -u root --password=123456 jobboard > jobboard.sql