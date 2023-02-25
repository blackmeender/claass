<?php

namespace Test\Arguments;


use Php2\Argument\Argument;
use Php2\Exceptions\ArgumentException;
use PHPUnit\Framework\TestCase;

class ArgumentTest extends TestCase
{
    public function testItReturnArgumentValueByName(): void
    {
        //Подготовили данные
        $argument = new Argument(['some_key' => 'some_value']);

        //Дествие
        $value = $argument->get('some_key');

        //Проверка
        $this->assertEquals('some_value', $value);
    }

    public function testItThrowExeptionWhenArgumentAbsent(): void
    {
        //Подготовили данные
        $argument = new Argument([]);

        //Тип ожидаемого исключения
        $this->expectException(ArgumentException::class);


        //Событие
        $this->expectExceptionMessage("no such argument: some_key");
        //Действие, которое приводит к исключению
        $argument->get('some_key');
    }
    public function argumentsProvider(): iterable
    {
        return [
            ['some_string', 'some_string'],
            ['some_string', 'some_string'],
            ['some_string', 'some_string'],
            [123, '123'],
            [12.3, '12.3']
        ];
    }

    /**
     * @dataProvider argumentsProvider
     */

//     public function testItConvertsArgumentsToString($inputValue, $expectedValue): void
//     {
//         $argument = new Argument(['some_key' => $inputValue]);
//         $value = $argument->get('some_key');
//         $this->assertContainsEquals($expectedValue, $value);
//     }
}
