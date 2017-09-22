<?php
/**
 *
 */

namespace ${Vendorname}\${Modulename}\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CustomSearchResultsInterface
 *
 * @package ${Vendorname}\${Modulename}\Api\Data
 * @api
 */
interface ${Tableentityname}SearchResultsInterface extends SearchResultsInterface
{

    /**
     * @return \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface[]
     */
    public function getItems();

    /**
     * @param \${Vendorname}\${Modulename}\Api\Data\${Tableentityname}Interface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
