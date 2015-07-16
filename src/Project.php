<?php

namespace CloudManaged\FreeAgent;

use CloudManaged\FreeAgent\Api\ApiResource;
use CloudManaged\FreeAgent\Errors\ApiError;
use CloudManaged\FreeAgent\Errors\ProjectError;
use CloudManaged\FreeAgent\Entities\Project\ProjectEntity;

class Project extends ApiResource
{
    public function getProjectUrl($id = 0, $page = 0)
    {
        $url = $this->getUrlBase() . 'projects/';
        if ($id > 0) {
            $url .= abs(intval($id));
        } elseif ($page > 0) {
            $url .= '?page=' . abs(intval($page));
        }
        return $url;
    }

    /**
     * General project information
     * The list of basic information about a project held by FreeAgent.
     *
     * @see https://dev.freeagent.com/docs/projects
     * @return ProjectEntity
     */
    public function getGeneralProjectInformation($id = 0, $page = 0)
    {
        $response = $this->fetchProjectDetails($id, $page);
        return $this->projectDetails($response);
    }

    protected function fetchProjectDetails($id = 0, $page = 0)
    {
        try {
            $url = $this->getProjectUrl($id, $page);
            return $this->retrieve($url, []);
        } catch (ApiError $e) {
            throw new ProjectError($e);
        }
    }

    protected function projectDetails($response)
    {
        if (isset($response['projects'])) {
            $projects = array();
            foreach ($response['projects'] as $project) {
                $projects[] = new ProjectEntity($response);
            }
            return $projects;
        } else {
            return new ProjectEntity($response['project']);
        }
    }
}
