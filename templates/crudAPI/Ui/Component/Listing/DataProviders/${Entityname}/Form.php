<?php

namespace ${Vendorname}\${Modulename}\Ui\Component\Listing\DataProviders\${Entityname};

use Magento\Ui\DataProvider\Modifier\PoolInterface;

class Form extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;

    private $resOrderId;
    /**
     * @var \Magento\Ui\DataProvider\Modifier\PoolInterface
     */
    private $pool;

    /**
     * Grid constructor.
     *
     * @param string                                                                    $name
     * @param string                                                                    $primaryFieldName
     * @param string                                                                    $requestFieldName
     * @param \${Vendorname}\${Modulename}\Model\ResourceModel\${Entityname}\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\RequestInterface                                   $request
     * @param \Magento\Framework\Registry                                               $registry
     * @param \Magento\Ui\DataProvider\Modifier\PoolInterface                           $pool
     * @param array                                                                     $meta
     * @param array                                                                     $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \${Vendorname}\${Modulename}\Model\ResourceModel\${Entityname}\CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Registry $registry,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->pool = $pool;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getData()
    {
        parent::getData();

        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->data = $modifier->modifyData($this->data);
        }

        return $this->data;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMeta()
    {
        $meta = parent::getMeta();

        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }
}
