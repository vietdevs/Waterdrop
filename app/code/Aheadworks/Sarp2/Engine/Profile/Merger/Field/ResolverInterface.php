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
 * @version    2.15.0
 * @copyright  Copyright (c) 2021 Aheadworks Inc. (https://aheadworks.com/)
 * @license    https://aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Sarp2\Engine\Profile\Merger\Field;

/**
 * Interface ResolverInterface
 * @package Aheadworks\Sarp2\Engine\Profile\Merger\Field
 */
interface ResolverInterface
{
    /**
     * Resolve merging field value
     *
     * @param array $entities
     * @param string $field
     * @return mixed
     */
    public function getResolvedValue($entities, $field);
}