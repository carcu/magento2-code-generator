<?php

namespace ${Vendorname}\${Modulename}\Ui\Component\Listing\DataProviders\${Entityname}\Column;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                $id = 0;
                if (isset($item['${entityname}_id'])) {
                    $id = $item['${entityname}_id'];
                }
                $item[$name]['view'] = [
                    'href' => $this->getContext()->getUrl(
                        '${vendorname}_${modulename}/${entityname}/edit', ['id' => $id]),
                    'label' => __('Edit'),
                ];
            }
        }

        return $dataSource;
    }
}
