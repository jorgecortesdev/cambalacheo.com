<?php

namespace Cambalacheo\Social\Facebook;

use Facebook;

class Token
{
    public function requestUserToken($callback_url)
    {
        try {
            $token = Facebook::getAccessTokenFromRedirect($callback_url);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        if (! $token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = Facebook::getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        return $token;
    }

    public function requestPageToken($page_id, $callback_url)
    {
        $accessToken = $this->requestUserToken($callback_url);

        try {
            $response = Facebook::get('/me/accounts', $accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $graphEdge = $response->getGraphEdge('GraphPage');
        $pageToken = '';
        foreach ($graphEdge as $graphObject) {
            if ($graphObject->getId() == $page_id) {
                $pageToken = $graphObject->getAccessToken();
                break;
            }
        }

        return $pageToken;
    }
}
