<?php declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\Test\Unit\Data\Form\Element;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * Test for \Magento\Framework\Data\Form\Element\Hidden.
 */
class HiddenTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\Framework\Data\Form\Element\Hidden
     */
    private $element;

    protected function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->element = $objectManager->getObject(\Magento\Framework\Data\Form\Element\Hidden::class);
    }

    /**
     * @param mixed $value
     *
     * @dataProvider getElementHtmlDataProvider
     */
    public function testGetElementHtml($value)
    {
        $form = $this->createMock(\Magento\Framework\Data\Form::class);
        $this->element->setForm($form);
        $this->element->setValue($value);
        $html = $this->element->getElementHtml();

        if (is_array($value)) {
            foreach ($value as $item) {
                $this->assertContains($item, $html);
            }
            return;
        }
        $this->assertContains($value, $html);
    }

    public function getElementHtmlDataProvider()
    {
        return [
            ['some_value'],
            ['store_ids[]' => ['1', '2']],
        ];
    }
}
