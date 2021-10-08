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
namespace Aheadworks\Sarp2\Engine\Payment\Engine\Logger\DataFormatter;

use Aheadworks\Sarp2\Engine\Payment\Engine\LoggerInterface;
use Aheadworks\Sarp2\Engine\Payment\Engine\Logger\DataFormatterInterface;
use Aheadworks\Sarp2\Engine\Payment\Engine\Logger\DataFormatter\Processing\Base as BaseProcessingFormatter;
use Aheadworks\Sarp2\Engine\Payment\Engine\Logger\DataFormatter\Schedule\Base as BaseScheduleFormatter;

/**
 * Class Pool
 * @package Aheadworks\Sarp2\Engine\Payment\Engine\Logger\DataFormatter
 */
class Pool
{
    /**
     * @var array
     */
    private $formatters = [
        LoggerInterface::SOURCE_ACTION_SCHEDULE => [
            'default' => BaseScheduleFormatter::class
        ],
        LoggerInterface::SOURCE_ACTION_PROCESSING => [
            'default' => BaseProcessingFormatter::class
        ]
    ];

    /**
     * @var DataFormatterInterface[]
     */
    private $formatterInstances = [];

    /**
     * @var Factory
     */
    private $formatterFactory;

    /**
     * @param Factory $formatterFactory
     * @param array $formatters
     */
    public function __construct(
        Factory $formatterFactory,
        array $formatters = []
    ) {
        $this->formatterFactory = $formatterFactory;
        $this->formatters = array_merge($this->formatters, $formatters);
    }

    /**
     * Get log data formatter instance
     *
     * @param string $sourceAction
     * @param string $entryType
     * @return DataFormatterInterface
     */
    public function getFormatter($sourceAction, $entryType)
    {
        $key = $sourceAction . '-' . $entryType;
        if (!isset($this->formatterInstances[$key])) {
            $className = isset($this->formatters[$sourceAction][$entryType])
                ? $this->formatters[$sourceAction][$entryType]
                : $this->formatters[$sourceAction]['default'];
            $this->formatterInstances[$key] = $this->formatterFactory->create($className);
        }
        return $this->formatterInstances[$key];
    }
}
