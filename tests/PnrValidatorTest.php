<?php

use Adaptivemedia\PnrValidator\PnrValidator;
use Illuminate\Contracts\Translation\Translator;

class PnrValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @dataProvider getCorrectNumbers
     */
    public function testCorrect(string $number)
    {
        $trans = $this->getTranslator();
        $rules = [
            'pnr' => 'pnr'
        ];

        $data = [
            'pnr' => $number,
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());
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

    /**
     * @dataProvider getIncorrectNumbers
     */
    public function testIncorrect(string $number)
    {
        $trans = $this->getTranslator();
        $trans->shouldReceive('trans');

        $rules = [
            'pnr' => 'pnr'
        ];


        $data = [
            'pnr' => $number,
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertFalse($v->passes());
    }

    public function getIncorrectNumbers(): array
    {
        return [
            ['19830603-0218'],
            ['830603-0218'],
            ['20830603-0218'],
        ];
    }

    protected function getTranslator(): Translator
    {
        return Mockery::mock(Translator::class);
    }
}
