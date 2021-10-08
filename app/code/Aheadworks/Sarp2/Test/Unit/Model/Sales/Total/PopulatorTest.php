<?php
/**
 * Aheadworks Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://aheadworks.com/end-user-license-agreement/
 *
 * @package    Sarp2
 * @version    2.15.3
 * @copyright  Copyright (c) 2021 Aheadworks Inc. (https://aheadworks.com/)
 * @license    https://aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Sarp2\Test\Unit\Model\Sales\Total;

use Aheadworks\Sarp2\Model\Sales\Total\Populator;
use Magento\Framework\DataObject;
use Magento\Framework\DataObject\Factory;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * Test for \Aheadworks\Sarp2\Model\Sales\Total\Populator
 */
class PopulatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Populator
     */
    private $populator;

    /**
     * @var PriceCurrencyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $priceCurrencyMock;

    /**
     * @var Factory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $dataObjectFactoryMock;

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);
        $this->priceCurrencyMock = $this->createMock(PriceCurrencyInterface::class);
        $this->dataObjectFactoryMock = $this->createMock(Factory::class);
        $this->populator = $objectManager->getObject(
            Populator::class,
            [
                'priceCurrency' => $this->priceCurrencyMock,
                'dataObjectFactory' => $this->dataObjectFactoryMock
            ]
        );
    }

    public function testGetAmountsMap()
    {
        $map = [
            'from_amount_field' => 'to_amount_field',
            'from_non_amount_field' => 'to_non_amount_field'
        ];
        $nonAmountFields = ['from_non_amount_field'];

        $class = new \ReflectionClass($this->populator);

        $mapProperty = $class->getProperty('map');
        $mapProperty->setAccessible(true);
        $mapProperty->setValue($this->populator, $map);

        $nonAmountFieldsProperty = $class->getProperty('nonAmountFields');
        $nonAmountFieldsProperty->setAccessible(true);
        $nonAmountFieldsProperty->setValue($this->populator, $nonAmountFields);

        $method = $class->getMethod('getAmountsMap');
        $method->setAccessible(true);

        $this->assertEquals(
            ['from_amount_field' => 'to_amount_field'],
            $method->invoke($this->populator)
        );
    }

    public function testGetBaseAmountsMap()
    {
        $map = [
            'from_amount_field' => 'to_amount_field',
            'from_non_amount_field' => 'to_non_amount_field'
        ];
        $nonAmountFields = ['from_non_amount_field'];

        $class = new \ReflectionClass($this->populator);

        $mapProperty = $class->getProperty('map');
        $mapProperty->setAccessible(true);
        $mapProperty->setValue($this->populator, $map);

        $nonAmountFieldsProperty = $class->getProperty('nonAmountFields');
        $nonAmountFieldsProperty->setAccessible(true);
        $nonAmountFieldsProperty->setValue($this->populator, $nonAmountFields);

        $method = $class->getMethod('getBaseAmountsMap');
        $method->setAccessible(true);

        $this->assertEquals(
            ['from_amount_field' => 'base_to_amount_field'],
            $method->invoke($this->populator)
        );
    }

    public function testGetNonAmountsMap()
    {
        $map = [
            'from_amount_field' => 'to_amount_field',
            'from_non_amount_field' => 'to_non_amount_field'
        ];
        $nonAmountFields = ['from_non_amount_field'];

        $class = new \ReflectionClass($this->populator);

        $mapProperty = $class->getProperty('map');
        $mapProperty->setAccessible(true);
        $mapProperty->setValue($this->populator, $map);

        $nonAmountFieldsProperty = $class->getProperty('nonAmountFields');
        $nonAmountFieldsProperty->setAccessible(true);
        $nonAmountFieldsProperty->setValue($this->populator, $nonAmountFields);

        $method = $class->getMethod('getNonAmountsMap');
        $method->setAccessible(true);

        $this->assertEquals(
            ['from_non_amount_field' => 'to_non_amount_field'],
            $method->invoke($this->populator)
        );
    }

    public function testConvert()
    {
        $amount = 10.00;
        $convertedAmount = 15.00;
        $data = ['from_amount_field' => $amount];
        $convertedData = ['from_amount_field' => $convertedAmount];
        $map = ['from_amount_field' => 'to_amount_field'];

        $totalsDetailsMock = $this->createMock(DataObject::class);
        $convertedTotalsDetailsMock = $this->createMock(DataObject::class);

        $class = new \ReflectionClass($this->populator);

        $mapProperty = $class->getProperty('map');
        $mapProperty->setAccessible(true);
        $mapProperty->setValue($this->populator, $map);

        $nonAmountFieldsProperty = $class->getProperty('nonAmountFields');
        $nonAmountFieldsProperty->setAccessible(true);
        $nonAmountFieldsProperty->setValue($this->populator, []);

        $totalsDetailsMock->expects($this->once())
            ->method('getData')
            ->willReturn($data);
        $this->priceCurrencyMock->expects($this->once())
            ->method('convert')
            ->with($amount)
            ->willReturn($convertedAmount);
        $this->dataObjectFactoryMock->expects($this->once())
            ->method('create')
            ->with($convertedData)
            ->willReturn($convertedTotalsDetailsMock);

        $method = $class->getMethod('convert');
        $method->setAccessible(true);

        $this->assertSame(
            $convertedTotalsDetailsMock,
            $method->invokeArgs($this->populator, [$totalsDetailsMock])
        );
    }
}
