<?php

namespace App\Serializer\Normalizer;


use App\Service\MotherManagerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MotherIdentifierDenormalizer extends ObjectNormalizer
{
    private $motherManager;

    public function __construct(MotherManagerInterface $childManager)
    {
        $this->motherManager = $childManager;
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {

        return 'App\Model\MotherIdentifier' === $type && is_string($data);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {

        return $this->motherManager->getIdentifier($data);
    }


}