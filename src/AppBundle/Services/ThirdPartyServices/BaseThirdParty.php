<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 16.08.2016
 * Time: 23:29
 */

namespace AppBundle\Services\ThirdPartyServices;


use AppBundle\Entity\Information\AdditionalInfo;

class BaseThirdParty
{
    protected $fields = array();

    protected $em;
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFields()
    {
        return $this->fields;
    }


    public function save($data)
    {
        $repository = $this->em->getRepository('AppBundle:Information\AdditionalInfo');

        if (is_array($this->getFields())) {
            foreach ($this->getFields() as $field) {
                $db_obj = $repository->findOneBy(array('param_name' => $field));
                if ($db_obj) {
                    $db_obj->setParamValue($data[$field]);
                } else {
                    if (isset($data[$field])) {
                        $db_obj = new AdditionalInfo();
                        $db_obj->setParamName($field);
                        $db_obj->setParamValue($data[$field]);
                    }
                }
                $this->em->persist($db_obj);
            }
            $this->em->flush();
        }
    }

    public function getInformation()
    {
        $res = $this->em->getRepository('AppBundle:Information\AdditionalInfo')->getInformation($this->getFields());
        $return = array();
        if (count($res)) {
            foreach ($res as $r) {
                $return[$r->getParamName()] = $r->getParamValue();
            }
        }

        return $return;
    }
}