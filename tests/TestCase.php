<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Login to sentinel
     * @param  $email
     * @return void
     */
    public function sentryUserBe($email='admin@admin.com')
    {
        $user = \Sentry::findUserByLogin($email);
        \Sentry::login($user);
       \Event::fire('sentinel.user.login', ['user' => $user]);
    }
}
