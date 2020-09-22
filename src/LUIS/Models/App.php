<?php

namespace Goodjun\LUIS\Models;

class App extends ModelAbstract
{
    protected $name;

    protected $description;

    protected $culture = 'en-us';

    protected $tokenizerVersion = '1.0.0';

    protected $usageScenario = '';

    protected $domain = '';

    protected $initialVersionId = '0.1';

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
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $culture
     * @return $this
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
        return $this;
    }

    /**
     * @param string $tokenizerVersion
     * @return $this
     */
    public function setTokenizerVersion($tokenizerVersion)
    {
        $this->tokenizerVersion = $tokenizerVersion;
        return $this;
    }

    /**
     * @param string $usageScenario
     * @return $this
     */
    public function setUsageScenario($usageScenario)
    {
        $this->usageScenario = $usageScenario;
        return $this;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @param string $initialVersionId
     * @return $this
     */
    public function setInitialVersionId($initialVersionId)
    {
        $this->initialVersionId = $initialVersionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * @return string
     */
    public function getTokenizerVersion()
    {
        return $this->tokenizerVersion;
    }

    /**
     * @return string
     */
    public function getUsageScenario()
    {
        return $this->usageScenario;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getInitialVersionId()
    {
        return $this->initialVersionId;
    }
}
