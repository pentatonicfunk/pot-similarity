<?php

namespace PotSimilarity\Library;

use Gettext\Translation;
use Gettext\Translations;

class Parser
{
    private $pot_file = '';

    /**
     * @var Similars|null
     */
    private $similars = null;

    private $percentage_threshold = 70;

    /**
     * Parser constructor.
     *
     * @param $pot_file
     * @param $percentage_threshold
     */
    public function __construct($pot_file, $percentage_threshold)
    {
        $this->pot_file             = $pot_file;
        $this->percentage_threshold = $percentage_threshold;
    }

    public function parse()
    {
        //import from a .po file:
        $translations = Translations::fromPoFile($this->pot_file);

        /** @var Translation[] $items */
        $items = array();
        foreach ($translations->getIterator() as $item) {
            /**@var Translation $item */
            $items[] = $item;
        }

        $this->similars = new Similars();
        while (! empty($items)) {
            $this->findSimilar($items);
        }
    }

    /**
     *
     * @param Translation[] $items
     *
     * @return bool
     */
    public function findSimilar(&$items)
    {
        $compare = array_shift($items);

        $similar = new Similar(
            $compare->getContext(),
            $compare->getOriginal(),
            $compare->getPlural()
        );
        $similar->mergeWith($compare);

        foreach ($items as $key => $item) {
            $a = trim(strtolower($similar->getOriginal()));
            $b = trim(strtolower($item->getOriginal()));
            similar_text(
                $a,
                $b,
                $percent
            );

            if ($percent >= $this->percentage_threshold) {
                $similar->addSimilarityWith($item, $percent);
                unset($items[$key]);
            }
        }

        if (! empty($similar->similarWiths)) {
            $this->similars[] = $similar;
        }

        $items = array_values($items);

        return true;
    }

    public function getSimilars(): Similars
    {
        return $this->similars;
    }
}
