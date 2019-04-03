<?php

use Adaptivemedia\PnrValidator\PersonalIdentityNumber;
use Orchestra\Testbench\TestCase;

class ValidateServiceProviderTest extends TestCase
{
    /**
     * Bootstraps Laravel application. Tests service providers work on a basic level.
     *
     * @return void
     */
    public function testBootstrap()
    {
        $correctPnr = '830603-0217';
        $incorrectPnr = '8322223217';


        // Pass
        $validator = $this->app['validator']->make(
            [
                'pnr' => $correctPnr,
            ],
            [
                'pnr' => 'pnr'
            ]
        );
        $this->assertTrue($validator->passes());

        // Success with rule
        $validator = $this->app['validator']->make(
            [
                'pnr' => $correctPnr,
            ],
            [
                'pnr' => new PersonalIdentityNumber()
            ]
        );

        $this->assertTrue($validator->passes());

        // Fail
        $validator = $this->app['validator']->make(
            [
                'pnr' => $incorrectPnr,
            ],
            [
                'pnr' => 'pnr'
            ]
        );

        $this->assertTrue($validator->fails());
        $messages = $validator->messages();
        $this->assertEquals('The personal number is incorrect', $messages->first('pnr'));

        // Fail with rule
        $validator = $this->app['validator']->make(
            [
                'pnr' => $incorrectPnr,
            ],
            [
                'pnr' => new PersonalIdentityNumber()
            ]
        );

        $this->assertTrue($validator->fails());
        $messages = $validator->messages();
        $this->assertEquals('The personal number is incorrect', $messages->first('pnr'));
    }

    protected function getPackageProviders($app)
    {
        return [
            'Adaptivemedia\PnrValidator\ValidationServiceProvider'
        ];
    }

}