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

    protected $_attrGroupSelect = "SELECT * FROM `eav_attribute_group` WHERE `attribute_set_id` = :attribute_set_id";

    protected $_attrGroupInsert = "INSERT INTO `eav_attribute_group` (`attribute_set_id`, `attribute_group_name`, `sort_order`, `default_id`) VALUES (:attribute_set_id, :attribute_group_name, :sort_order, :default_id)";

    protected $_attrEntitySelect = "SELECT * FROM `eav_entity_attribute` WHERE `attribute_set_id` = :attribute_set_id";

    protected $_groupInfo;

    protected $_attributeEntity;




    /**
     * Create attribute set the following params is required
     * 
     * @param $this->getEntityTypeId()
     * @param $this->getAttributeSetName()
     * @param $this->getSortOrder()
     * @throws \Exception AttribureSet have exist !
     * @return last insert id
     */
    public function createAttributeSet($data)
    {
        if (!$this->isUnique($this->_attrSetSelect, [':attribute_set_name' => $data['attribute_set_name']])) {
            $this->setAttributeSetId($this->insert($this->_attrSetInsert, [':entity_type_id' => $data['entity_type_id'], ':attribute_set_name' => $data['attribute_set_name'], ':sort_order' => $data['sort_order']]));
            return $this->getAttributeSetId();
        } else {
            $this->error('AttribureSet have exist ! [' . $this->getAttributeSetName() . ']', 20001);
        }
    }


    /**
     * Create Attribute Group
     *
     * @param array $data 
     *     $data = [':attribute_set_id' => , ':attribute_group_name' => , ':sort_order' => , ':default_id' => ]
     * @return  int last insert id
     */
    public function createAttributeGroup($data){
        return $this->insert($this->_attrGroupInsert, $data);
    }


    /**
     * get attribute set group info
     *
     * @return array
     */
    public function getAttrGroupInfo($attrSetId)
    {
        $this->_groupInfo = $this->select($this->_attrGroupSelect, [':attribute_set_id' => $attrSetId]);
        return $this->_groupInfo;
    }


    /**
     * get attribute entity info
     *
     * @param int $attrSetId
     * @return array
     */
    public function getAttributeEntity($attrSetId)
    {
        $this->_attributeEntity = $this->select($this->_attrEntitySelect, [':attribute_set_id' => $attrSetId]);
        return $this->_attributeEntity;
    }

}
