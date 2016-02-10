<?php

require 'recipe/common.php';


server('conoha', '157.7.236.208', 20022)
    ->user('sibukixxx')
    ->identityFile('~/.ssh/key/conohaVps_sercret.key')
    ->stage('conoha')
    ->env('deploy_path', '/home/sibukixxx/umjhome');

#set('repository', 'https://github.com/sibukixxx/Laravel5.SampleApplication');
set('repository', 'git@github.com:MarketingApplications/tracking-management.git');
#set('repository', 'https://github.com/laravel/laravel');




// Laravel shared dirs
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

// Laravel 5 shared file
set('shared_files', ['.env']); // 初回時どうしようかと迷う。デプロイサーバーからアップロードでも良いかもしれない

// Laravel writable dirs
set('writable_dirs', ['storage', 'vendor']);

/**
 * tasks
 */

// migrate
task('database:migrate', function () {
    run('php {{release_path}}/' . 'artisan migrate');
})->desc('Migrate database');

// optimize
task('deploy:optimize', function () {
    run('php {{release_path}}/' . 'artisan optimize');
#    run('php {{release_path}}/' . 'artisan route:cache');
    run('php {{release_path}}/' . 'artisan config:cache');
})->desc('Optimize Application');


/**
 * Main task list
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:shared',
    'deploy:symlink',
    'deploy:optimize',
])->desc('Deploy your project');
after('deploy', 'success');
