<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ${Vendorname}\${Modulename}\Controller\Adminhtml\${Entityname};

use Magento\Backend\App\Action;
use Magento\Cms\Model\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use ${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface
     */
    private $${entityname}Repository;

    /**
     * @param Action\Context                                                 $context
     * @param PostDataProcessor                                              $dataProcessor
     * @param \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface     $${entityname}Repository
     * @param DataPersistorInterface                                         $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        ${Entityname}RepositoryInterface $${entityname}Repository,
        /*${Entityname}QtysRepositoryInterface $${entityname}QtysRepository,*/
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
        $this->${entityname}Repository = $${entityname}Repository;
        /*$this->${entityname}QtysRepository = $${entityname}QtysRepository;*/
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
     * Save action.
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     *
     * @return \Magento\Framework\Controller\ResultInterface
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /*if (empty($data['date_to']) || $data['date_to'] == 'Invalid date') {
                $data['date_to'] = '0000-00-00 00:00:00';
            }*/

            $data = $this->dataProcessor->filter($data);

            $idName = $this->getRequest()->getParam('${entityname}_id');
            if ($idName) {
                $name = $this->${entityname}Repository->getById($idName);
                $data['${entityname}_id'] = (int) $name->get${Entityname}Id();
            } else {
                unset($data['${entityname}_id']);
            }

            if (!$this->dataProcessor->validateRequireEntry($data)) {
                if ($idName) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $fixedName->getId(), '_current' => true]);
                } else {
                    return $resultRedirect->setPath('*/*/');
                }
            }

            try {
                //$data['catalog_rules'] = serialize($data['catalog_rules']);//this will be used if at any point catalog rules should be considered

                $idName = (int) $this->${entityname}Repository ->saveData($data);
                /*
                $datesData = $data['rental-fixeddate']['${entityname}'];
                $this->${entityname}QtysRepository->deleteBy${fkField}Id($idName);
                foreach ($datesData as $dates) {
                    $dates['${entityname}_id'] = $idName;
                    unset($dates['date_id']);

                    $dateFrom = new \DateTime($dates['date_from']);
                    $dates['date_from'] = $dateFrom->format('Y-m-d H:i:s');
                    $dateTo = new \DateTime($dates['date_to']);
                    if ($dates['all_day']) {
                        $dateTo->add(new \DateInterval('PT23H59M'));
                    }
                    $dates['date_to'] = $dateTo->format('Y-m-d H:i:s');
                    if (isset($dates['repeat_days'])) {
                        $dates['repeat_days'] = serialize($dates['repeat_days']);
                    }
                    if (isset($dates['week_month'])) {
                        $dates['week_month'] = serialize($dates['week_month']);
                    }

                    $this->${entityname}QtysRepository->saveData($dates);
                }*/
                $this->messageManager->addSuccessMessage(__('You saved the predetermined date.'));
                $this->dataPersistor->clear('sirent_${entityname}');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $fixedName->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the page.'));
            }

            $this->dataPersistor->set('sirent_${entityname}', $data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('name_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
