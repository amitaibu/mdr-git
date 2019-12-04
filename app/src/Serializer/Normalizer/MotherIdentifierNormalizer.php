<?php

namespace App\Serializer\Normalizer;


use App\Model\MotherIdentifier;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MotherIdentifierNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization(
      $data,
      string $format = null,
      array $context = []
    ) {

        dump($data);
        return $data instanceof MotherIdentifier;
    }

    public function normalize(
      $object,
      string $format = null,
      array $context = []
    ) {

        dump($object);
        return ['foo'];


    }


}