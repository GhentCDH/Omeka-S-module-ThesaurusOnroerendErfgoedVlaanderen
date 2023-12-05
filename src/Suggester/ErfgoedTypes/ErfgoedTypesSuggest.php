<?php
namespace ThesaurusOnroerendErfgoedVlaanderen\Suggester\ErfgoedTypes;

use ValueSuggest\Suggester\SuggesterInterface;

class ErfgoedTypesSuggest implements SuggesterInterface
{
    private $data = [];

    function __construct()
    {
        $this->data = require_once(sprintf('%s/data.php', __DIR__));
    }

    /**
     * Retrieve suggestions from the ErfgoedTypes dataset.
     *
     * @see https://thesaurus.onroerenderfgoed.be/conceptschemes/ERFGOEDTYPES
     * @param string $query
     * @param string $lang
     * @return array
     */
    public function getSuggestions($query, $lang = null)
    {
        $suggestions = [];
        foreach($this->data as $id => $item) {
            if (!isset($item['http://www.w3.org/1999/02/22-rdf-syntax-ns#type']) ||
                $item['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'][0]['value'] != 'http://www.w3.org/2004/02/skos/core#Concept') {
                continue;
            }

            $label = $item['http://www.w3.org/2004/02/skos/core#prefLabel'][0]['value'];
            if (stristr($label, $query)) {
                $info = [];
                if (isset($item['http://www.w3.org/2004/02/skos/core#scopeNote'])) {
                    $info[] = sprintf(
                        'Note: %s',
                        $item['http://www.w3.org/2004/02/skos/core#scopeNote'][0]['value']
                    );
                }

                $suggestions[] = [
                    'value' => $label,
                    'data' => [
                        'uri' => $id,
                        'info' => implode("\n", $info),
                    ],
                ];
            }
        }

        usort($suggestions, function ($a, $b) {
            return strcmp($a['value'], $b['value']);
        });
        return $suggestions;
    }

    public function getByLabel($_label)
    {
        $result = false;
        foreach($this->data as $id => $item) {
            if (!isset($item['http://www.w3.org/1999/02/22-rdf-syntax-ns#type']) ||
                $item['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'][0]['value'] != 'http://www.w3.org/2004/02/skos/core#Concept') {
                continue;
            }

            $label = $item['http://www.w3.org/2004/02/skos/core#prefLabel'][0]['value'];
            if ( $label == $_label ) {
                $info = [];
                if (isset($item['http://www.w3.org/2004/02/skos/core#scopeNote'])) {
                    $info[] = sprintf(
                        'Note: %s',
                        $item['http://www.w3.org/2004/02/skos/core#scopeNote'][0]['value']
                    );
                }

                $result = [
                    'value' => $label,
                    'data' => [
                        'uri' => $id,
                        'info' => implode("\n", $info),
                    ],
                ];
                break;
            }
        }

        return $result;
    }
}