<?php

namespace ${Vendorname}\${Modulename}\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class FixedRentalDates.
 */
class ${Tableentityname} extends AbstractDb
{
    /**
     * Resource initialization.
     */
    protected function _construct()
    {
        $this->_init('${vendorname}_${modulename}_${tableentityname}', '${tableentityname}_id');
    }

    /**
     * Load Data.
     *
     * @param int $itemId
     *
     * @return array
     */
    public function loadBy${fkField}Id($itemId)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $this->getConnection();

        $quoteIdFieldName = $this->get${fkField}IdFieldName();
        /** @var \Magento\Framework\DB\Select $select */
        $select = $connection->select()
            ->from($this->getMainTable())//$columns
            ->where("{$quoteIdFieldName} = ?", $itemId);

        return $connection->fetchAll($select);
    }

    /**
     * Delete Data.
     *
     * @param int $itemId
     *
     * @return int The number of affected rows
     */
    public function deleteBy${fkField}Id($itemId)
    {
        /** @var \Magento\Framework\DB\Adapter\AdapterInterface $connection */
        $connection = $this->getConnection();

        $conds[] = $connection->quoteInto($this->get${fkField}IdFieldName().' = ?', $itemId);

        if (count($conds) > 1) {
            $where = implode(' OR ', $conds);
        } else {
            $where = implode(' ', $conds);
        }

        return $connection->delete($this->getMainTable(), $where);
    }

    /**
     * @return string
     */
    protected function get${fkField}IdFieldName()
    {
        return '${fkField}_id';
    }
}
