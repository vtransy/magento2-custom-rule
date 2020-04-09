<?php

namespace Magently\CustomerRule\Observer;

/**
 * Class CustomerConditionObserver
 */
class CustomerConditionObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Execute observer.
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $additional = $observer->getAdditional();
        $conditions = (array) $additional->getConditions();

        $conditions = array_merge_recursive($conditions, [
            $this->getCustomerFirstOrderCondition()
        ]);

        $additional->setConditions($conditions);
        return $this;
    }

    /**
     * Get condition for customer first order.
     * @return array
     */
    private function getCustomerFirstOrderCondition()
    {
        return [
            'label'=> __('Customer first order'),
            'value'=> \Magently\CustomerRule\Model\Rule\Condition\Customer::class
        ];
    }
}