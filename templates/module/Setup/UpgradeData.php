<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 *
 */

namespace SalesIgniter\Warehouses\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Upgrade Data script.
 *
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * Catalog setup factory.
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * @var \Magento\Framework\Logger\Monolog
     */
    protected $_logger;

    /**
     * @var
     */
    protected $_currentVersion;

    /**
     * @var EavSetup
     */
    protected $_eavSetup;
    /**
     * @var \SalesIgniter\Warehouses\Helper\Data
     */
    private $helperWarehouses;
    /**
     * @var \Magento\Framework\App\State
     */
    private $state;

    /**
     * UpgradeData constructor.
     *
     * @param EavSetupFactory                      $_eavSetupFactory
     * @param \SalesIgniter\Warehouses\Helper\Data $helperWarehouses
     * @param \Magento\Framework\App\State         $state
     * @param \Magento\Framework\Logger\Monolog    $logger
     */
    public function __construct(
        EavSetupFactory $_eavSetupFactory,
        //\SalesIgniter\Warehouses\Helper\Data $helperWarehouses,
        \Magento\Framework\App\State $state,
        \Magento\Framework\Logger\Monolog $logger
    ) {
        $this->_eavSetupFactory = $_eavSetupFactory;

        $this->_logger = $logger;
        $this->_logger->pushHandler(new \Monolog\Handler\StreamHandler(BP.'/var/log/rental_upgrade_data.log'));
        //$this->helperWarehouses = $helperWarehouses;
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     *
     * @throws \Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->_currentVersion = $context->getVersion();
        $this->_logger->addDebug('Current Version: '.$this->_currentVersion);

        $this->_eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        if ($this->shouldProcessUpdate('1.0.20170918')) {
            $this->_logger->addDebug('Running Updates For Version: 1.0.20170918');

        }

        $setup->endSetup();
    }

    protected function shouldProcessUpdate($CheckVersion)
    {
        $this->_logger->addDebug('Checking If Update Should Run For Version: '.(string) $CheckVersion);
        if (version_compare((string) $this->_currentVersion, (string) $CheckVersion) < 0) {
            $ShouldProcess = true;
        } else {
            $ShouldProcess = false;
        }

        return $ShouldProcess;
    }

    protected function addEavAttribute($EntityTypeId, $AttributeCode, $AttributeData)
    {
        $this->_eavSetup->addAttribute($EntityTypeId, $AttributeCode, $AttributeData);

        return $this;
    }

    protected function addProductEavAttribute($AttributeCode, $AttributeData)
    {
        $this->_logger->addDebug('Adding Product Eav Attribute: '.$AttributeCode.' :: '.print_r($AttributeData, true));

        $this->_eavSetup->addAttribute(Product::ENTITY, $AttributeCode, $AttributeData);

        return $this;
    }

    protected function addProductEavAttributes($Attributes)
    {
        foreach ($Attributes as $AttributeCode => $AttributeData) {
            $this->addProductEavAttribute($AttributeCode, $AttributeData);
        }

        return $this;
    }

    protected function removeEavAttribute($EntityTypeId, $AttributeCode)
    {
        $this->_eavSetup->removeAttribute($EntityTypeId, $AttributeCode);

        return $this;
    }

    protected function removeProductEavAttribute($AttributeCode)
    {
        $this->_logger->addDebug('Removing Product Eav Attribute: '.$AttributeCode);

        return $this->removeEavAttribute(Product::ENTITY, $AttributeCode);
    }

    protected function removeProductEavAttributes($AttributeCodes)
    {
        foreach ($AttributeCodes as $AttributeCode) {
            $this->removeProductEavAttribute($AttributeCode);
        }

        return $this;
    }

    protected function updateEavAttribute($EntityTypeId, $AttributeCode, $UpdateKey, $UpdateValue)
    {
        $this->_eavSetup->updateAttribute(
            $EntityTypeId,
            $AttributeCode,
            $UpdateKey,
            $UpdateValue
        );

        return $this;
    }

    protected function updateProductEavAttribute($AttributeCode, $Updates)
    {
        $this->_logger->addDebug('Updating Product Eav Attribute: '.$AttributeCode.' :: '.print_r($Updates, true));

        foreach ($Updates as $UpdateKey => $UpdateValue) {
            $this->updateEavAttribute(
                Product::ENTITY,
                $AttributeCode,
                $UpdateKey,
                $UpdateValue
            );
        }

        return $this;
    }

    protected function updateProductEavAttributes($Attributes)
    {
        foreach ($Attributes as $UpdateKey => $UpdateArr) {
            $this->updateProductEavAttribute($UpdateKey, $UpdateArr);
        }

        return $this;
    }
}
