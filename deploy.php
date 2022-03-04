<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:BladeRED/animalerie.git');

add('shared_files', []);
add('shared_dirs', ['public/uploads']);
add('writable_dirs', ['public/',]);

set('keep_releases', 5);
set('http_user', 'www-data');
set('writable_mode', 'chmod');
set('writable_use_sudo', true);
set('ssh_multiplexing', false);

// Hosts

host('51.178.42.85')
    ->set('keep_releases', 2)
    ->set('branch', 'main')
    ->setForwardAgent(true)
    ->set('remote_user', 'debian')
    ->set('deploy_path', '/var/www/La_Patate_De_Patrick');

// Tasks

task('build', function () {
    cd('{{release_path}}');
    run('npm run build');
});

// À dé-commenter si vous avez besoin de lancer le build sur le serveur
// after('deploy:vendors', 'build');

// Si le déploiement échoue, on débloque les déploiements sur le serveur
after('deploy:failed', 'deploy:unlock');

