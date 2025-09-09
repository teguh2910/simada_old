## About SIMADA

SIMADA adalah Aplikasi Sistem Management Dokumen yang menyimpan serta mengelola dokumen Pada Fase SPTT tiap Projek

## Instalation with Docker Compose

1. git clone https://github.com/teguh2910/simada.git
2. cd simada
3. setting .env file
4. docker compose up -d --build
5. docker compose exec app composer install
6. docker compose exec app php artisan key:generate
7. docker compose exec app php artisan migrate
8. docker compose exec app php artisan db:seed
9. docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

## Jenkins Configuration
1. docker run \
  --name jenkins-docker \
  --rm \
  --detach \
  --privileged \
  --network jenkins \
  --network-alias docker \
  --env DOCKER_TLS_CERTDIR=/certs \
  --volume jenkins-docker-certs:/certs/client \
  --volume jenkins-data:/var/jenkins_home \
  --publish 2376:2376 \
  --publish 3000:3000 \
  docker:dind \
  --storage-driver overlay2

2. docker run \
  --name jenkins-blueocean \
  --detach \
  --network jenkins \
  --env DOCKER_HOST=tcp://docker:2376 \
  --env DOCKER_CERT_PATH=/certs/client \
  --env DOCKER_TLS_VERIFY=1 \
  --publish 8080:8080 \
  --publish 50000:50000 \
  --volume jenkins-data:/var/jenkins_home \
  --volume jenkins-docker-certs:/certs/client:ro \
  --volume "$HOME":/home \
  --restart=on-failure \
  --env JAVA_OPTS="-Dhudson.plugins.git.GitSCM.ALLOW_LOCAL_CHECKOUT=true" \
  teguhy2910/myjenkins-blueocean:2.346.1-1 

## Contributing

Thank you for considering contributing to the SIMADA Project!.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Teguh Yuhono at teguh.yuhono@student.unsia.ac.id. All security vulnerabilities will be promptly addressed.

## License

The SIMADA is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
