@servers(['dev' => 'vagrant@192.168.10.10'])

@task('setup:dev', ['on' => 'dev'])
cd /home/vagrant/
rm -rf dev
git clone https://github.com/svpernova09/quickstart-basic-5.3.git dev
cd dev
git checkout exercise-5
cp .env.example .env
composer install
php artisan migrate
php artisan db:seed --force
php artisan up
@endtask

@task('deploy:dev', ['on' => 'dev'])
cd /home/vagrant/dev
php artisan down
git pull origin exercise-5
composer install
php artisan migrate --force
php artisan up
@endtask
