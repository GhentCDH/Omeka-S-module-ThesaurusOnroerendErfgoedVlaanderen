<?php
namespace ThesaurusOnroerendErfgoedVlaanderen\DataType\ErfgoedTypes;

use ValueSuggest\DataType\AbstractDataType;
use ThesaurusOnroerendErfgoedVlaanderen\Suggester\ErfgoedTypes\ErfgoedTypesSuggest;

class ErfgoedTypes extends AbstractDataType
{
    public function getSuggester()
    {
        return new ErfgoedTypesSuggest;
    }

    public function getName()
    {
        return 'valuesuggest:thesaurusonroerenderfgoed:erfgoedtypes';
    }

    public function getLabel()
    {
        return 'Thesaurus Onroerend Erfgoed Vlaanderen: Erfgoedtypes'; // @translate
    }
}