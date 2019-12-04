<?php

namespace App\Serializer\Normalizer;


use App\Service\MotherManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MotherIdentifierDenormalizer extends ObjectNormalizer
{
    private $normalizer;
    private $motherManager;

    public function __construct(ObjectNormalizer $normalizer, MotherManagerInterface $motherManager)
    {
        $this->normalizer = $normalizer;
        $this->motherManager = $motherManager;
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {

        return 'App\Model\MotherIdentifier' === $type && is_string($data);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {

        dump($type);
        $dataFromFile =  $this->motherManager->getIdentifier($data);
        dump($dataFromFile);
        return $this->normalizer->denormalize($dataFromFile, $type, $format, $context);
    }


}