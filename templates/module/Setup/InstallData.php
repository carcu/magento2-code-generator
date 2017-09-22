<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 */

namespace SalesIgniter\Warehouses\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogAttribute;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $catalogSetupFactory;

    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->catalogSetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        /** @var \Magento\Catalog\Setup\CategorySetup $catalogSetup */
        $catalogSetup = $this->catalogSetupFactory->create(['setup' => $setup]);

        // Add Rentals Tab To Product Edit for Rental Products
        $entityTypeId = $catalogSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
        $attributeSetId = $catalogSetup->getDefaultAttributeSetId($entityTypeId);
        //$catalogSetup->addAttributeGroup($entityTypeId, $attributeSetId, 'Warehouses', 60);
        /*
         * this option is per store. So someone could assign only some warehouses qtys to be served
         * to specific stores

        $catalogSetup->addAttribute(Product::ENTITY, 'siwarehouses_warehouses_ids', [
            'label' => 'Warehouses Associated',
            'group' => 'Warehouses',
            'input' => 'multiselect',
            'visible_on_front' => false,
            'required' => true,
            'global' => CatalogAttribute::SCOPE_STORE,
            'apply_to' => 'sirent,simple',
            'source' => 'SalesIgniter\Warehouses\Model\Attribute\Sources\WarehousesAssociated',
            'backend' => 'SalesIgniter\Warehouses\Model\Attribute\Backend\WarehousesAssociated',
            'default' => 1,
            'default_value' => 1,
            'type' => 'text',
            'sort_order' => 51,
        ]);

      */
    }
}
