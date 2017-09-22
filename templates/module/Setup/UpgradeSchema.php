<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 */

namespace SalesIgniter\Warehouses\Setup;

use Magento\Framework\DB\Ddl\Table as DdlTable;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     *
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $installer = $setup;

        if (version_compare($context->getVersion(), '1.0.20170917') < 0) {
            /*$tableName = $setup->getTable('sirental_serialnumber_details');
            $setup->getConnection()->addColumn(
                $tableName,
                'warehouse_id',
                [
                    'type' => DdlTable::TYPE_INTEGER,
                    'nullable' => false,
                    'default' => 1,
                    'comment' => 'FK Warehouse id',
                ]
            );*/
        }

        $setup->endSetup();
    }
}
