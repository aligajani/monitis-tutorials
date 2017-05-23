<?php
class MCustomJob extends MApi{
    /*
     * string $apiKey, string $secretKey, string $authToken, string $version, string $apiUrl, string $publicKey
     */
    public function __construct($apiKey = null, $secretKey = null, $authToken = null, $version = null, $apiUrl = null, $publicKey = null){
        if($apiUrl == null) $apiUrl = self::URL_CUSTOM;
        parent::__construct($apiKey, $secretKey, $authToken, $version, $apiUrl, $publicKey);
    }
    /*
     * unsigned int $agentId, unsigned int $lastJobId
     * return [[id,interval,params,type],...] or [error]
     */
    public function requestJobs($agentId, $lastJobId = null){
        $fields = array();
        $fields['agentId'] = $agentId;
        if($lastJobId != null) $fields['lastJobId'] = $lastJobId;
        return $this->makeGetRequest('getJobs', $fields);
    }
    /*
     * unsigned int $agentId, string $jobType, array $params, unsigned int $interval (minutes), unsigned int $monitorId
     * return [status,data] or [error]
     */
    public function addJob($agentId, $jobType, $params, $interval, $monitorId = null){
        $fields = array();
        $fields['agentId'] = $agentId;
        $fields['type'] = $jobType;
        $fields['params'] = json_encode($params);
        $fields['interval'] = $interval;
        if($monitorId != null) $fields['monitorId'] = $monitorId;
        return $this->makePostRequest('addJob', $fields);
    }
    /*
     * unsigned int $jobId, string $jobType, array $params, unsigned int $interval (minutes)
     * return [status] or [error]
     */
    public function editJob($jobId, $jobType, $params = null, $interval = null){
        $fields = array();
        $fields['jobId'] = $jobId;
        if($jobType != null) $fields['type'] = $jobType;
        if($params != null) $fields['params'] = json_encode($params);
        if($interval != null) $fields['interval'] = $interval;
        return $this->makePostRequest('editJob', $fields);
    }
    /*
     * unsigned int|array $jobIds
     * return [status] or [error]
     */
    public function deleteJobs($jobIds){
        $fields = array();
        if(is_array($jobIds)) $fields['jobIds'] = join(',',$jobIds);
        else $fields['jobIds'] = $jobIds;
        return $this->makePostRequest('deleteJob', $fields);
    }
}
?>