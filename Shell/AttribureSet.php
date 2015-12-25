<?php
/**
 * AttribureSet
 * script create attribute set
 * 
 * @package  tools/magento/attribute-set
 * @author daniel.luo <daniel.luo@silksoftware.com>
 * 
 * relate tables
 * eav_entity_type
 * eav_attribute_set
 * eav_attribute_group
 * eav_entity_attribute
 */
namespace Shell;

class AttribureSet extends AbstructMod
{
    protected $_attrSetInsert = "INSERT INTO `eav_attribute_set` (`entity_type_id`, `attribute_set_name`, `sort_order`) VALUES (:entity_type_id, :attribute_set_name, :sort_order)";

    protected $_attrSetSelect = "SELECT * FROM `eav_attribute_set` WHERE `attribute_set_name` = :attribute_set_name";

    /**
     * Create attribute set the following params is required
     * 
     * @param $this->getEntityTypeId()
     * @param $this->getAttributeSetName()
     * @param $this->getSortOrder()
     * @throws \Exception AttribureSet have exist !
     * @return last insert id
     */
    public function createAttributeSet()
    {
        if (!$this->isUnique($this->_attrSetSelect, [':attribute_set_name' => $this->getAttributeSetName()])) {
            return $this->execute($this->_attrSetInsert, [':entity_type_id' => $this->getEntityTypeId(), ':attribute_set_name' => $this->getAttributeSetName(), ':sort_order' => $this->getSortOrder()]);
        } else {
            $this->error('AttribureSet have exist ! [' . $this->getAttributeSetName() . ']', 20001);
        }
    }

}
