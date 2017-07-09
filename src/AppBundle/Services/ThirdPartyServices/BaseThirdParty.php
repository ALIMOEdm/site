<?php
namespace AppBundle\Services\ThirdPartyServices;

use AppBundle\Entity\Information\AdditionalInfo;
use AppBundle\Entity\Repository\Information\AdditionalInfoRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseThirdParty
 * @package AppBundle\Services\ThirdPartyServices
 */
class BaseThirdParty
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * BaseThirdParty constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getFields() : array
    {
        return $this->fields;
    }

    /**
     * @param array $data
     */
    public function save(array $data)
    {
        /** @var AdditionalInfoRepository $repository */
        $repository = $this->em->getRepository(AdditionalInfo::class);

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

    /**
     * @return array
     */
    public function getInformation() : array
    {
        /** @var AdditionalInfo[] $res */
        $res = $this->em->getRepository(AdditionalInfo::class)->getInformation($this->getFields());
        $return = array();
        if (count($res)) {
            foreach ($res as $r) {
                $return[$r->getParamName()] = $r->getParamValue();
            }
        }

        return $return;
    }
}