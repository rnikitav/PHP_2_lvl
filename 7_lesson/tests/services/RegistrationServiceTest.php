<?php

namespace services;

use App\services\RegistrationService;
use PHPUnit\Framework\TestCase;

class RegistrationServiceTest extends TestCase
{
    /**
     * @param $arr
     * @param $expected
     *
     * @dataProvider getDataForReg
     */
    public function testRegister($arr, $expected)
    {
        $service = new RegistrationService();
        $res = $service->register($arr);
        $this->assertEquals($res, $expected);
    }
    public function getDataForReg(){
        return
            [
                [['Login' => '', 'password' => ''], 'Вы ввели некорректный логин'],
                [['Login' => 'asd', 'password' => ''], 'Вы ввели некорректный логин'],
            ];
    }
}
