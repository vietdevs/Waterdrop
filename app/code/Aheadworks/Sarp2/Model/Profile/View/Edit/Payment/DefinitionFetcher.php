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
namespace Aheadworks\Sarp2\Model\Profile\View\Edit\Payment;

use Magento\Framework\Config\Converter\Dom\Flat as FlatConverter;
use Magento\Framework\Config\Dom\ArrayNodeConfig;
use Magento\Framework\Config\Dom\NodePathMatcher;
use Magento\Framework\Data\Argument\InterpreterInterface;
use Magento\Framework\View\Layout\Element;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class DefinitionFetcher
 *
 * @package Aheadworks\Sarp2\Model\Profile\View\Edit\Payment
 */
class DefinitionFetcher
{
    /**
     * @var Element[]
     */
    private $layoutUpdates = [];

    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var FlatConverter
     */
    private $flatConverter;

    /**
     * @var InterpreterInterface
     */
    private $argumentInterpreter;

    /**
     * @var RecursiveMerger
     */
    private $recursiveMerger;

    /**
     * @param LayoutFactory $layoutFactory
     * @param InterpreterInterface $argumentInterpreter
     * @param RecursiveMerger $recursiveMerger
     */
    public function __construct(
        LayoutFactory $layoutFactory,
        InterpreterInterface $argumentInterpreter,
        RecursiveMerger $recursiveMerger
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->argumentInterpreter = $argumentInterpreter;
        $this->recursiveMerger = $recursiveMerger;
        $this->flatConverter = $this->initFlatConverter();
    }

    /**
     * Init flat converter
     *
     * @return FlatConverter
     */
    private function initFlatConverter()
    {
        return new FlatConverter(
            new ArrayNodeConfig(new NodePathMatcher(), ['(/item)+' => 'name'])
        );
    }

    /**
     * Fetch arguments definition data
     *
     * @param array|string $handles
     * @param string $xpath
     * @return array
     */
    public function fetchArgs($handles, $xpath)
    {
        $result = [];
        try {
            $layoutUpdateXml = $this->getLayoutUpdate($handles);
            $searchResult = $layoutUpdateXml->xpath($xpath);

            if ($searchResult) {
                foreach ($searchResult as $element) {
                    $elementDom = dom_import_simplexml($element);
                    $data = $this->argumentInterpreter->evaluate(
                        $this->flatConverter->convert($elementDom)
                    );
                    $result = $this->recursiveMerger->merge($result, $data);
                }
            }
        } catch (\Exception $e) {
        }
        return $result;
    }

    /**
     * Get layout update instance
     *
     * @param array|string $handles
     * @return Element
     * @throws LocalizedException
     */
    private function getLayoutUpdate($handles)
    {
        $key = is_array($handles)
            ? implode('-', $handles)
            : $handles;
        if (!isset($this->layoutUpdates[$key])) {
            $this->layoutUpdates[$key] = $this->layoutFactory->create()
                ->getUpdate()
                ->load($handles)
                ->asSimplexml();
        }
        return $this->layoutUpdates[$key];
    }
}
