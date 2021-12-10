# T-WEB-501-NAN-5-1-jobboard-raphael.guigon

run 'php -S 0.0.0.0:3000' into the step folder for start php server

run 'docker run --rm -e MARIADB_ROOT_PASSWORD=123456 -e MARIADB_DATABASE=jobboard -v $PWD:/docker-entrypoint-initdb.d -p 3306:3306 mariadb' into the step01 folder to start data base.

To see the website go to http://localhost:3000/view/index.php
