<?php

namespace Goodjun\LUIS;

use Goodjun\LUIS\Models\Utterance;
use \Exception;

class LuisAppClient extends LuisAbstract
{
    private $appId;

    private $versionId = '0.1';

    /**
     * LuisAppClient constructor.
     * @param $primaryKey
     * @param $location
     * @param $appId
     */
    public function __construct($primaryKey, $location, $appId)
    {
        $this->primaryKey = $primaryKey;
        $this->location = $location;
        $this->appId = $appId;
    }

    /**
     * Version
     *
     * @param $versionId
     * @return $this
     */
    public function version($versionId)
    {
        $this->versionId = $versionId;
        return $this;
    }

    /**
     * The update only rename and change description
     *
     * @param $name
     * @param $description
     * @return mixed
     * @throws Exception
     */
    public function update($name, $description)
    {
        return $this->request('PUT', 'apps/' . $this->appId, [
            'name' => $name,
            'description' => $description,
        ]);
    }

    /**
     * Delete app
     *
     * @throws Exception
     */
    public function delete()
    {
        return $this->request('DELETE', 'apps/' . $this->appId);
    }

    /**
     * Create intent
     *
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function createIntent($name)
    {
        return $this->request('POST', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/intents', [
            'name' => $name
        ]);
    }

    /**
     * Update intent
     *
     * @param $intentId
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function updateIntent($intentId, $name)
    {
        return $this->request('PUT', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/intents/' . $intentId, [
            'name' => $name
        ]);
    }

    /**
     * Delete intent
     *
     * @param $intentId
     * @return mixed
     * @throws Exception
     */
    public function deleteIntent($intentId)
    {
        return $this->request('DELETE', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/intents/' . $intentId);
    }

    /**
     * Create entity
     *
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function createEntity($name)
    {
        return $this->request('POST', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/entities', [
            'name' => $name
        ]);
    }

    /**
     * Update entity
     *
     * @param $entityId
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function updateEntity($entityId, $name)
    {
        return $this->request('PUT', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/entities/' . $entityId, [
            'name' => $name
        ]);
    }

    /**
     * Delete entity
     *
     * @param $entityId
     * @return mixed
     * @throws Exception
     */
    public function deleteEntity($entityId)
    {
        return $this->request('DELETE', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/entities/' . $entityId);
    }

    /**
     * Add utterance
     *
     * @param Utterance $utterance
     * @return mixed
     * @throws Exception
     */
    public function addUtterance(Utterance $utterance)
    {
        $response = $this->request('POST', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/example', $utterance->toArray());

        return $response->ExampleId;
    }

    /**
     * Delete utterance
     *
     * @param $utteranceId
     * @return mixed
     * @throws Exception
     */
    public function deleteUtterance($utteranceId)
    {
        return $this->request('DELETE', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/examples/' . $utteranceId);
    }

    /**
     * Get version training status
     *
     * @return mixed
     * @throws Exception
     */
    public function trainingStatus()
    {
        return $this->request('GET', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/train');
    }

    /**
     * Train application version
     *
     * @return mixed
     * @throws Exception
     */
    public function train()
    {
        return $this->request('POST', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/train');
    }

    /**
     * predict
     *
     * @return mixed
     * @throws Exceptions\LuisResponseException
     */
    public function predict($texts)
    {
        return $this->request('POST', 'apps/' . $this->appId . '/versions/' . $this->versionId . '/predict', $texts, 'webApi');
    }
}
