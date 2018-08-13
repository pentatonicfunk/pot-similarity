<?php

namespace PotSimilarity\Library;

use Gettext\Translation;

class SimilarWith extends Translation
{
    /**
     * @var float
     */
    public $similarityPercentage = 0;

    public function __construct(
        string $context,
        string $original,
        string $plural = ''
    ) {
        parent::__construct($context, $original, $plural);
    }
}
