<?php

use Adaptivemedia\PnrValidator\PnrValidator;

class PnrValidatorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testPassedForOkPnr()
    {
        $trans = $this->getTranslator();

        $rules = [
            'pnr' => 'pnr'
        ];

        $data = [
            'pnr' => '19830603-0217',
        ];

        $v = new PnrValidator($trans, $data, $rules);
        $this->assertTrue($v->passes());
    }

    protected function getTranslator()
    {
        return Mockery::mock('Symfony\Component\Translation\TranslatorInterface');
    }

}