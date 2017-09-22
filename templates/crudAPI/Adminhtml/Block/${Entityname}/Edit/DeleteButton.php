<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 *
 */

namespace ${Vendorname}\${Modulename}\Block\Adminhtml\${Entityname}\Edit

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton.
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getNameId()) {
            $data = [
                'label' => __('Delete ${Entityname}'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''.__(
                        'Are you sure you want to do this?'
                    ).'\', \''.$this->getDeleteUrl().'\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['${tableentityname}_id' => $this->get${TableEntityName}Id()]);
    }
}
