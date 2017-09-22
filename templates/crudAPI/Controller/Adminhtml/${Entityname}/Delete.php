<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ${Vendorname}\${Modulename}\Controller\Adminhtml\${Entityname};

use Magento\Backend\App\Action\Context;
use ${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface
     */
    private $${entityname}Repository;

    /**
     * @param Context                                                    $context
     * @param \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface $${entityname}Repository
     *
     */
    public function __construct(
        Context $context,
        ${Entityname}RepositoryInterface $${entityname}Repository
    ) {
        parent::__construct($context);

        $this->${entityname}Repository = $${entityname}Repository;
    }

    /**
     * Check the permission to run it.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('${Vendorname}_${Modulename}::${entityname}');
    }

    /**
     * Delete action.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $idName = $this->getRequest()->getParam('${entityname}_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($idName) {
            try {
                $this->${entityname}Repository->delete($idName);
                // display success message
                $this->messageManager->addSuccessMessage(__('Entity was deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['${entityname}_id' => $idName]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a warehouse to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
