<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 15/03/2017
 * Time: 12:08.
 */

namespace AppBundle\Serializer\Normalizer;

use AppBundle\Entity\Task;

class TaskNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /* @var Task $object */
        $data = [
            'id' => $object->getId(),
            'name' => $object->getType(),
            'description' => $object->getDescription(),
            'status' => $object->getStatus(),
            'category' => $this->normalizeObject($object->getCategory(), $format, $context),
        ];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Task;
    }
}
