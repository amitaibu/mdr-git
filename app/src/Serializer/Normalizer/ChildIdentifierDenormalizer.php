<?php

namespace App\Serializer\Normalizer;


use App\Service\ChildManagerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ChildIdentifierDenormalizer extends ObjectNormalizer
{
    private $normalizer;
    private $childManager;

    public function __construct(ObjectNormalizer $normalizer, ChildManagerInterface $childManager)
    {
        $this->normalizer = $normalizer;
        $this->childManager = $childManager;
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {

        return 'App\Model\ChildIdentifier' === $type && is_string($data);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {

        return $this->childManager->getIdentifier($data);
    }


}