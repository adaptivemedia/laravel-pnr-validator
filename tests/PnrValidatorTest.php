<?php

use Adaptivemedia\PnrValidator\PersonalIdentityNumber;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase;

class PnrValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->post('/', function (\Illuminate\Http\Request $request) {
            $request->validate([
                'pnr' => ['required', 'pnr']
            ]);

            return 'ok';
        });
    }

    /**
     * @test
     * @dataProvider getCorrectNumbers
     * @param string $correctPnr
     */
    public function correct_pnr_is_validated_for_post_request(string $correctPnr)
    {
        $this->post('/', [
            'pnr' => $correctPnr
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertOk();
    }

    /**
     * @test
     * @dataProvider getIncorrectNumbers
     * @param string $incorrectPnr
     */
    public function incorrect_pnr_is_validated_for_post_request(string $incorrectPnr)
    {
        $this->post('/', [
            'pnr' => $incorrectPnr
        ])->assertSessionHasErrors(['pnr' => 'The personal identity number is incorrect']);
    }

    public function getCorrectNumbers(): array
    {
        return [
            ['19830603-0217'],
            ['198306030217'],
            ['19101227-9806'],
            ['191012279806'],
            ['830603-0217'],
            ['8306030217'],
            ['201412312397'],
            ['20141231-2397'],
        ];
    }

    public function getIncorrectNumbers(): array
    {
        return [
            ['19830603-0218'],
            ['830603-0218'],
            ['20830603-0218'],
        ];
    }

    /** @test */
    public function validator_uses_locales_for_error_messages()
    {
        app()->setLocale('sv');

        $this->post('/', [
            'pnr' => '834343434'
        ])->assertSessionHasErrors(['pnr' => 'Personnumret är inte korrekt']);
    }

    /**
     * @test
     */
    public function manual_validator_works()
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
        $this->assertEquals('The personal identity number is incorrect', $messages->first('pnr'));

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
        $this->assertEquals('The personal identity number is incorrect', $messages->first('pnr'));
    }

    protected function getPackageProviders($app)
    {
        return [
            Adaptivemedia\PnrValidator\PnrValidatorServiceProvider::class
        ];
    }

}