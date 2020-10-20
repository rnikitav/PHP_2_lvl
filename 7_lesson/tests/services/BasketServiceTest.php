<?php

namespace services;

use App\entities\Basket;
use App\repositories\BasketRepository;
use App\services\BasketService;
use App\services\Request;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{

    // Проверяем количество увеличилось и что не создался новый объект getOne
    public function testAddFoundSession()
    {
        /** @var MockObject|Request $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        /** @var MockObject|BasketRepository $requestMock */
        $basketRepoMock = $this->getMockBuilder(BasketRepository::class)
            ->disableOriginalConstructor()
            ->disallowMockingUnknownTypes()
            ->getMock();
        $basketRepoMock->expects($this->never())
            ->method('getOne');
        $sessionGood = new Basket();
        $sessionGood->id = 1;
        $sessionGood->price = 1000;
        $sessionGood->img = '1.jpg';
        $sessionGood->article = 'HTC';
        $sessionGood->name = 'HTC';
        $sessionGood->count = 1;
        $requestMock->method('getSession')
            ->will($this->returnValue($sessionGood));
        $service = new BasketService();

        $service->add(1, $requestMock, 'HTC');
        $this->assertEquals(2, $sessionGood->count);
//        $this->assertSame($sessionGood, $requestMock->getSession());

    }
    //Проверяем на false & getSession никогда не вызвался упал в первое условие
    public function testAddEmptyId()
    {
        /** @var MockObject|Request $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        $requestMock
            ->expects($this->never())
            ->method('getSession');
        $service = new BasketService();
        $article = 'HTC';
        $result = $service->add(null, $requestMock, $article);
        $this->assertFalse($result);

    }

    /**
     * @param $count
     * @param $sum
     * @param $expected
     *
     * @dataProvider getDataForSubTotal
     */
    public function testSubTotal($count, $sum, $expected)
    {
        $goods = [];
        $good = new Basket();
        $good->count = $count;
        $good->price = $sum;
        array_push($goods, $good);
        $service = new BasketService();
        $result = $service->subTotal($goods);
        $this->assertEquals($expected, $result);

    }

    public function getDataForSubTotal(){
        return
            [
                [4,10,40],
                [1,10,10],
                [5,10,50],
            ];
    }

    public function testSumPrivate()
    {
        $serviceReflection = new \ReflectionClass(BasketService::class);
        $method = $serviceReflection->getMethod('sumPrivate');
        $method->setAccessible(true);
        $service = new BasketService();
        $res = $method->invoke($service, 2, 2);
        $this->assertEquals(4, $res);
    }
}
