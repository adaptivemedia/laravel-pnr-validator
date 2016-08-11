<?php

use Orchestra\Testbench\TestCase;

class ValidateServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Adaptivemedia\PnrValidator\ValidationServiceProvider'
        ];
    }
    /**
     * Bootstraps Laravel application. Tests service providers work on a basic level.
     *
     * @return void
     */
    public function testBootstrap()
    {
        // Pass
        $validator = $this->app['validator']->make(
            [
                'pnr' => '830603-0217',
            ],
            [
                'pnr' => 'pnr'
            ]
        );
        $this->assertTrue($validator->passes());

        // Fail
        $validator = $this->app['validator']->make(
            [
                'pnr' => '8322223217',
            ],
            [
                'pnr' => 'pnr'
            ]
        );

        $this->assertTrue($validator->fails());

        $messages = $validator->messages();
        $this->assertEquals('The personal number is incorrect', $messages->first('pnr'));
    }
}