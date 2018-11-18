<?php

namespace Comerline\RelationOldProduct\Block\Catalog\Product\View;

use Magento\Framework\Registry;

class RelationOldProduct extends \Magento\Framework\View\Element\Template {

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Product
     */
    private $product;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
            Registry $registry) {
        $this->registry = $registry;
        parent::__construct($context);
    }

    /**
     * @return Product
     */
    private function getProduct() {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }
        return $this->product;
    }

    /**
     * Get Attribute link_relation_old_product from Current Product
     * @return string
     */
    public function getLinkRelationOldProduct() {
        return $this->getProduct()->getData('link_relation_old_product');
    }

    /**
     * Get Attribute text_relation_old_product from Current Product
     * @return string
     */
    public function getTextRelationOldProduct() {
        return $this->getProduct()->getData('text_relation_old_product');
    }

    /**
     * return Template html
     * @return string
     */
    protected function _toHtml() {
        $html = '';
        $linkRelation = $this->getLinkRelationOldProduct();
        $textRelation = $this->getTextRelationOldProduct();
        if (!empty($linkRelation) && !empty($textRelation) && $this->getTemplate()) {
            $template = $this->getTemplateFile();
            $html = $this->fetchView($template);
        }
        return $html;
    }

}
