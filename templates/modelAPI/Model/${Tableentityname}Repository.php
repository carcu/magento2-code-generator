<?php
/**
 * THIS IS THE REPOSITORY
 */

namespace ${Vendorname}\${Modulename}\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use ${Vendorname}\${Modulename}\Api\${Tableentityname}RepositoryInterface;
use ${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname} as ${Tableentityname}Resource;
use ${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname}\CollectionFactory;

/**
 * Class ${Tableentityname}Repository
 *
 * @package ${Vendorname}\${Modulename}\Model
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class ${Tableentityname}Repository implements ${Tableentityname}RepositoryInterface
{
    /**
     * @var $${tableentityname}Resource
     */
    private $${tableentityname}Resource;
    /**
     * @var $${tableentityname}Factory
     */
    private $${tableentityname}Factory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * ${Tableentityname}Repository constructor.
     *
     * @param \${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname}                   $${tableentityname}Resource
     * @param \${Vendorname}\${Modulename}\Model\${Tableentityname}Factory                          $${tableentityname}Factory
     * @param \${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname}\CollectionFactory $collectionFactory
     * @param \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(${Tableentityname}Resource $${tableentityname}Resource,
        ${Tableentityname}Factory $${tableentityname}Factory,
        CollectionFactory $collectionFactory,
        \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->${tableentityname}Resource = $${tableentityname}Resource;
        $this->${tableentityname}Factory = $${tableentityname}Factory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface $${tableentityname}
     *
     * @return int
     */
    public function save(\${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface $${tableentityname})
    {
        $this->${tableentityname}Resource->save($${tableentityname});
        return $${tableentityname}->getId();
    }

    /**
     * @param int $${tableentityname}Id
     *
     * @return \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface $${tableentityname}Item
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($${tableentityname}Id)
    {
        $${tableentityname}Item = $this->${tableentityname}Factory->create();
        $this->${tableentityname}Resource->load($${tableentityname}Item, $${tableentityname}Id);
        if (!$${tableentityname}Item->getId()) {
            throw new NoSuchEntityException('Custom does not exist');
        }
        return $${tableentityname}Item;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}SearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        /** @var Magento\Framework\Api\SortOrder $sortOrder */
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $field = $sortOrder->getField();
            $collection->addOrder(
                $field,
                $this->getDirection($sortOrder->getDirection())
            );
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->load();
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setCriteria($searchCriteria);

        $${tableentityname}s = [];
        foreach ($collection as $${tableentityname}) {
            $${tableentityname}s[] = $${tableentityname};
        }
        $searchResults->setItems($${tableentityname}s);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param int $${tableentityname}Id
     *
     * @return bool
     */
    public function delete($${tableentityname}Id)
    {
        $${tableentityname} = $this->getById($${tableentityname}Id);
        if ($this->${tableentityname}Resource->delete($${tableentityname})) {
            return true;
        } else {
            return false;
        }
    }

    private function getDirection($direction)
    {
        return $direction === SortOrder::SORT_ASC ?: SortOrder::SORT_DESC;
    }

    /**
     * @param \Magento\Framework\Api\Search\FilterGroup $group
     * @param ${Tableentityname}Resource\Collection             $collection
     */
    private function addFilterGroupToCollection($group, $collection)
    {
        $fields = [];
        $conditions = [];

        foreach ($group->getFilters() as $filter) {
            $condition = $filter->getConditionType() ?: 'eq';
            $field = $filter->getField();
            $value = $filter->getValue();
            $fields[] = $field;
            $conditions[] = [$condition => $value];
        }
        $collection->addFieldToFilter($fields, $conditions);
    }

    /**
     * @param DataObject $dataObject
     *
     * @return int
     */
    public function saveFromObjectData(DataObject $dataObject)
    {
        $${tableentityname}Item = $this->${tableentityname}Factory->create();
        $${tableentityname}Item->setData($dataObject->getData());
        return $this->save($${tableentityname}Item);
    }

    /**
     * @param $${tableentityname}Id
     *
     * @return array
     */
    public function getByIdAsArray($${tableentityname}Id)
    {
        $${tableentityname}Item = $this->getById($${tableentityname}Id);
        return $${tableentityname}Item->getData();
    }
     /**
      * @param $${fkField}Id
      *
      * @return array
      */
    public function getBy${fkField}IdAsArray($${fkField}Id)
{
    return $this->${tableentityname}Resource->loadBy${fkField}Id($nameId);
}

    /**
     * @param $${fkField}Id
     *
     * @return bool
     */
    public function deleteBy${fkField}Id($${fkField}Id)
{
    $rowsAffected = $this->${tableentityname}Resource->deleteBy${fkField}Id($nameId);
    if ($rowsAffected > 0) {
        return true;
    } else {
        return false;
    }
}

}
