<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 *
 */

namespace ${Vendorname}\${Modulename}\Block\Adminhtml\${Entityname}\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton.
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface
     */
    protected $${Entityname}Repository;

    /**
     * @param Context $context
     * @param \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface $${Entityname}Repository
     */
    public function __construct(
        Context $context,
        \${Vendorname}\${Modulename}\Api\${Entityname}RepositoryInterface $${Entityname}Repository
    ) {
        $this->context = $context;
        $this->${Entityname}Repository = $${Entityname}Repository;
    }

    /**
     * Return ${Entityname} ID.
     *
     * @return int|null
     */
    public function get${TableEntityname}Id()
{
        if ($this->context->getRequest()->getParam('id')) {
            try {
                return $this->${Entityname}Repository->getById(
                    $this->context->getRequest()->getParam('id')
                )->getId();
            } catch (NoSuchEntityException $e) {
            }
        }

        return null;
    }

    /**
     * Generate url by route and parameters.
     *
     * @param string $route
     * @param array  $params
     *
     * @return string
     */
    public function getUrl($route = '', $params = [])
{
    return $this->context->getUrlBuilder()->getUrl($route, $params);
}
}
