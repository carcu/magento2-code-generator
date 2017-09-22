<?php
/**
 * THIS IS A SERVICE CONTRACT
 */
namespace ${Vendorname}\${Modulename}\Api;

use Magento\Framework\DataObject;

/**
 * @api
 * Interface CustomRepositoryInterface
 * @package Namespace\Custom\api
 */
interface ${Tableentityname}RepositoryInterface
{
    /**
     * @param \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface $${tableentityname}
     *
     * @return int
     */
    public function save(\${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface $${tableentityname});

    /**
     * @param $${tableentityname}Id
     *
     * @return \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($${tableentityname}Id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}SearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $${tableentityname}Id
     *
     * @return bool
     */
    public function delete($${tableentityname}Id);

    /**
     * @param DataObject $dataObject
     *
     * @return int
     */
    public function saveFromObjectData(DataObject $dataObject);

    /**
     * @param $${tableentityname}Id
     *
     * @return array
     */
    public function getByIdAsArray($${tableentityname}Id);

    public function getBy${fkField}IdAsArray($${fkField}Id);

    public function deleteBy${fkField}Id($${fkField}Id)

}
