<?php

namespace PotSimilarity\Library;

use Gettext\Translation;

class Similar extends Translation
{
    /**
     * @var SimilarWith[]
     */
    public $similarWiths = array();

    public function __construct(
        string $context,
        string $original,
        string $plural = ''
    ) {
        parent::__construct($context, $original, $plural);
    }

    public function addSimilarityWith(
        Translation $translation,
        float $percentSimilarity
    ) {
        $similarityWith = new SimilarWith(
            $translation->getContext(),
            $translation->getOriginal(),
            $translation->getPlural()
        );
        $similarityWith->mergeWith($translation);

        $similarityWith->similarityPercentage = $percentSimilarity;

        $this->similarWiths[] = $similarityWith;
    }
}
