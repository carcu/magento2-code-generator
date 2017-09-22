<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ${Vendorname}\${Modulename}\Controller\Adminhtml\${Entityname};

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use ${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface
     */
    private $${entityname}Repository;

    /**
     * @param Context                                                    $context
     * @param \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface $${entityname}Repository
     * @param PageFactory                                                $resultPageFactory
     */
    public function __construct(
        Context $context,
        ${Entityname}RepositoryInterface $${entityname}Repository,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;

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
     * Init actions.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('${Vendorname}_${Modulename}::${entityname}');
        $resultPage->addBreadcrumb(__('${Entityname}'), __('${Entityname}'));

        return $resultPage;
    }

    /**
     * Edit CMS page.
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $idName = $this->getRequest()->getParam('id');
        if ($idName) {
            $fixedName = $this->${entityname}Repository->getById($idName);

            if (!$fixedName->getId()) {
                $this->messageManager->addErrorMessage(__('This ${entityname} no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        //$this->_coreRegistry->register('cms_page', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $idName ? __('Edit ${Entityname}') : __('New ${Entityname}'),
            $idName ? __('Edit ${Entityname}') : __('New ${Entityname}')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('${Entityname}'));
        $resultPage->getConfig()->getTitle()
            ->prepend($idName ? __('Edited').$idName : __('New ${Entityname}'));

        return $resultPage;
    }
}
