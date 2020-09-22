<?php

namespace Goodjun\LUIS\Models;

class Utterance extends ModelAbstract
{
    protected $text;

    protected $intentName;

    protected $entityLabels;

    /**
     * App constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param mixed $intentName
     * @return $this
     */
    public function setIntentName($intentName)
    {
        $this->intentName = $intentName;
        return $this;
    }

    /**
     * @param mixed $entityLabels
     * @return $this
     */
    public function setEntityLabels($entityLabels)
    {
        $this->entityLabels = $entityLabels;
        return $this;
    }

    /**
     * @param $entityName
     * @param $startCharIndex
     * @param $endCharIndex
     * @return $this
     */
    public function addEntityLabel($entityName, $startCharIndex, $endCharIndex)
    {
        $this->entityLabels[] = [
            'entityName' => $entityName,
            'startCharIndex' => $startCharIndex,
            'endCharIndex' => $endCharIndex,
        ];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getIntentName()
    {
        return $this->intentName;
    }

    /**
     * @return mixed
     */
    public function getEntityLabels()
    {
        return $this->entityLabels;
    }
}
