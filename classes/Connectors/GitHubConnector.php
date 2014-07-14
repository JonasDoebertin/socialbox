<?php
namespace jdpowered\SocialBox\Connectors;

class GitHubConnector extends BaseConnector implements ConnectorInterface {

    /**
     * [fire description]
     *
     * @param  array $args
     * @return array
     */
    public function fire()
    {
        /*
            Fetch data from GitHub API
         */
        $result = $this->get('https://api.github.com/users/' . $this->args['id']);

        /*
            Check for common errors
         */
        $this->checkForCommonErrors($result);

        /* Decode response */
        $data = json_decode(wp_remote_retrieve_body($result));

        /*
            Check for incorrect data
         */
        if (is_null($data) or ! isset($data->followers)) {
            throw new MalformedDataException($data);
        }

        /*
            Return value
         */
        return $data->followers;
    }
}
