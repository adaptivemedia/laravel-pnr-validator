<?php

use Adaptivemedia\PnrValidator\PnrValidator;

class PnrValidatorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testPassedForCorrectPnrs()
    {
        $trans = $this->getTranslator();

        $rules = [
            'pnr' => 'pnr'
        ];

        // With year and hyphen
        $data = [
            'pnr' => '19830603-0217',
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());

        // With year without hyphen
        $data = [
            'pnr' => '198306030217',
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());

        // Without year and hyphen
        $data = [
            'pnr' => '830603-0217',
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());

        // Without year without hyphen
        $data = [
            'pnr' => '8306030217',
        ];
        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());
    }

    public function testFailsForIncorrectPnr()
    {
        $trans = $this->getTranslator();
        $trans->shouldReceive('trans');

        $rules = [
            'pnr' => 'pnr'
        ];

        $data = [
            'pnr' => '19830603-0218',
        ];

        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->fails());
    }

    protected function getTranslator()
    {
        return Mockery::mock('Symfony\Component\Translation\TranslatorInterface');
    }

}