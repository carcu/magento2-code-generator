<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See https://rentalbookingsoftware.com/license.html for license details.
 *
 */

namespace ${Vendorname}\${Modulename}\Model;

use Magento\Framework\Model\AbstractModel;
use ${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface;

class ${Tableentityname} extends AbstractModel implements ${Tableentityname}Interface
{
    protected function _construct()
    {
        $this->_init('${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname}');
    }

   /**
    * here comes the data from beans folder
    */
}
