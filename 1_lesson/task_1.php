<?php

/* Задание 1-4*/

class Transport{

    protected $classOfTransport;
    protected $weight;
    protected $name;
    protected $info;
    protected $properties = [];

    public function __construct($classOfTransport, $weight, $name, $info)
    {
        $this->classOfTransport = $classOfTransport;
        $this->weight = $weight;
        $this->name = $name;
        $this->info = $info;
    }
    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }
    public function sendASignal(){
        return "<h1>$this->classOfTransport</h1>" . $this->getName() . "<p>подает сигнал</p>";
    }
    protected function getName()
    {
        return "<p>{$this->name}</p>";
    }
}
class Car extends Transport
{
    protected $power;

    public function __construct($classOfTransport, $weight, $name, $info, $power)
    {
        $this->power = $power;
        parent::__construct($classOfTransport, $weight, $name, $info);
    }
    public function sendASignal()
    {
       return "<h1>$this->classOfTransport</h1>" . $this->getName() . "<p>подает сигнал. Мощность: " . $this->power . "</p>" ;
    }
}
class Product
{
    public $name;
    public $price;

    function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    function inference()
    {
        echo $this->name . " стоит " . $this->price . "р. <br>";
    }
}

class Sale extends Product
{
    public $discount;

    public function __construct($name, $price, $discount)
    {
        parent::__construct($name, $price);
        $this->discount = $discount;
    }

    public function discountSale()
    {
        echo $this->name . " стоит " . $this->price . "р. <b>скидка " . $this->discount . "%</b><br>";
    }
    private function getTotal()
    {
        return ($this->price / 100) * $this->discount;
    }
    public function showPriceWithDiscount()
    {
        echo "Скидка на товар составит: " . $this->getTotal();
    }

}

$transport = new Transport('Транспорт', '-', '-', 'Some info');
$transport->test = 100;
echo $transport->sendASignal();
$car = new Car('Автомобиль', '1500kg', 'BMW', 'Some info', '200л/с');
echo $car->sendASignal();




$rez = new Product ('Товар', '15000');
$rez->inference();

$rez1 = new Sale('Товар', 25000, 20);
$rez1->discountSale();
$rez1->showPriceWithDiscount();

echo '<hr>';



/* Задание 5*/

//создаем класс А
class A
{
    //создаем метод foo()
    public function foo()
    {
        static $x = 0;
        echo ++$x . "<br>";
    }
}

$a1 = new A(); //присваиваем переменной экземпляр класса А
$a2 = new A(); //аналогично пред. шагу

$a1->foo(); //вызываем метод foo() и получаем "1"
$a2->foo(); //вызываем метод foo() и получаем "2", т.к. используется static значение переменной $x не перезаписывается, следовательно ++1 = 2
$a1->foo(); //аналогично получаем "3"
$a2->foo(); //аналогично получаем "4"
echo '<h3>Задание 6</h3>';


///* Задание 6*/

class A2
{
    public function foo()
    {
        static $x = 0;
        echo ++$x . "<br>";
    }
}

//класс В наследует класс А (без добавления новых свойств)
class B extends A2
{
}

$a1 = new A2(); //присваиваем переменной экземпляр класса А
$b1 = new B(); //присваиваем переменной экземпляр класса В
$a1->foo(); //вызываем метод foo() класса А и получаем на выходе "1"
$b1->foo(); //вызываем метод foo() класса В и получаем аналогичный результат, в сделствии полного наследования свойств без каких либо изменений
$a1->foo(); //аналогично предыдущему заданию получаем на выходе "2" т.к. используется static
$b1->foo(); //полностью дуюлируем запись, в следствии наследования свойств класса
echo '<h3>Задание 7</h3>';



/* Замечание:

В случае отсутствия аргументов в конструктор класса,
круглые скобки после названия класса можно опустить. */
class D {
    public function foo() {
        static $x = 0;
        echo ++$x . '<br>';
    }
}
class E extends D {
}
$a1 = new D;
$b1 = new E;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

//Вывод будет такой же как и в 6 задании
