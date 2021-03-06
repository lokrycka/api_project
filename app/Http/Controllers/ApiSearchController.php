<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\ApiGitHubServiceProvider;

/**
 * @group GitHub Search
 */
class ApiSearchController extends Controller
{
    /**
     * Code search
     * 
     * @queryParam search required Szukana fraza
     * @queryParam user|repo|org required Nazwa użytkownika|Nazwa repozytorium|Nazwa organizacji
     * @queryParam order optional Sortowanie asc lub desc
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * 
     * @response status=200 { 
     *    "status": 200,
     *    "message": "Wyniki wyszukiwania",
     *    "response": {
     *      "total_count": 7,
     *      "incomplete_results": false,
     *      "items": [
     *      {
     *          "name": "classes.js",
     *          "path": "src/attributes/classes.js",
     *          "sha": "d7212f9dee2dcc18f084d7df8f417b80846ded5a",
     *          "url": "https://api.github.com/repositories/167174/contents/src/attributes/classes.js?ref=825ac3773694e0cd23ee74895fd5aeb535b27da4",
     *          "git_url": "https://api.github.com/repositories/167174/git/blobs/d7212f9dee2dcc18f084d7df8f417b80846ded5a",
     *          "html_url": "https://github.com/jquery/jquery/blob/825ac3773694e0cd23ee74895fd5aeb535b27da4/src/attributes/classes.js",
     *          "repository": {
     *              "id": 167174,
     *              "node_id": "MDEwOlJlcG9zaXRvcnkxNjcxNzQ=",
     *              "name": "jquery",
     *              "full_name": "jquery/jquery",
     *              "owner": {
     *                  "login": "jquery",
     *                  "id": 70142,
     *                  "node_id": "MDQ6VXNlcjcwMTQy",
     *                  "avatar_url": "https://0.gravatar.com/avatar/6906f317a4733f4379b06c32229ef02f?d=https%3A%2F%2Fidenticons.github.com%2Ff426f04f2f9813718fb806b30e0093de.png",
     *                  "gravatar_id": "",
     *                  "url": "https://api.github.com/users/jquery",
     *                  "html_url": "https://github.com/jquery",
     *                  "followers_url": "https://api.github.com/users/jquery/followers",
     *                  "following_url": "https://api.github.com/users/jquery/following{/other_user}",
     *                  "gists_url": "https://api.github.com/users/jquery/gists{/gist_id}",
     *                  "starred_url": "https://api.github.com/users/jquery/starred{/owner}{/repo}",
     *                  "subscriptions_url": "https://api.github.com/users/jquery/subscriptions",
     *                  "organizations_url": "https://api.github.com/users/jquery/orgs",
     *                  "repos_url": "https://api.github.com/users/jquery/repos",
     *                  "events_url": "https://api.github.com/users/jquery/events{/privacy}",
     *                  "received_events_url": "https://api.github.com/users/jquery/received_events",
     *                  "type": "Organization",
     *                  "site_admin": false
     *              },
     *              "private": false,
     *              "html_url": "https://github.com/jquery/jquery",
     *              "description": "jQuery JavaScript Library",
     *              "fork": false,
     *              "url": "https://api.github.com/repos/jquery/jquery",
     *              "forks_url": "https://api.github.com/repos/jquery/jquery/forks",
     *              "keys_url": "https://api.github.com/repos/jquery/jquery/keys{/key_id}",
     *              "collaborators_url": "https://api.github.com/repos/jquery/jquery/collaborators{/collaborator}",
     *              "teams_url": "https://api.github.com/repos/jquery/jquery/teams",
     *              "hooks_url": "https://api.github.com/repos/jquery/jquery/hooks",
     *              "issue_events_url": "https://api.github.com/repos/jquery/jquery/issues/events{/number}",
     *              "events_url": "https://api.github.com/repos/jquery/jquery/events",
     *              "assignees_url": "https://api.github.com/repos/jquery/jquery/assignees{/user}",
     *              "branches_url": "https://api.github.com/repos/jquery/jquery/branches{/branch}",
     *              "tags_url": "https://api.github.com/repos/jquery/jquery/tags",
     *              "blobs_url": "https://api.github.com/repos/jquery/jquery/git/blobs{/sha}",
     *              "git_tags_url": "https://api.github.com/repos/jquery/jquery/git/tags{/sha}",
     *              "git_refs_url": "https://api.github.com/repos/jquery/jquery/git/refs{/sha}",
     *              "trees_url": "https://api.github.com/repos/jquery/jquery/git/trees{/sha}",
     *              "statuses_url": "https://api.github.com/repos/jquery/jquery/statuses/{sha}",
     *              "languages_url": "https://api.github.com/repos/jquery/jquery/languages",
     *              "stargazers_url": "https://api.github.com/repos/jquery/jquery/stargazers",
     *              "contributors_url": "https://api.github.com/repos/jquery/jquery/contributors",
     *              "subscribers_url": "https://api.github.com/repos/jquery/jquery/subscribers",
     *              "subscription_url": "https://api.github.com/repos/jquery/jquery/subscription",
     *              "commits_url": "https://api.github.com/repos/jquery/jquery/commits{/sha}",
     *              "git_commits_url": "https://api.github.com/repos/jquery/jquery/git/commits{/sha}",
     *              "comments_url": "https://api.github.com/repos/jquery/jquery/comments{/number}",
     *              "issue_comment_url": "https://api.github.com/repos/jquery/jquery/issues/comments/{number}",
     *              "contents_url": "https://api.github.com/repos/jquery/jquery/contents/{+path}",
     *              "compare_url": "https://api.github.com/repos/jquery/jquery/compare/{base}...{head}",
     *              "merges_url": "https://api.github.com/repos/jquery/jquery/merges",
     *               "archive_url": "https://api.github.com/repos/jquery/jquery/{archive_format}{/ref}",
     *              "downloads_url": "https://api.github.com/repos/jquery/jquery/downloads",
     *              "issues_url": "https://api.github.com/repos/jquery/jquery/issues{/number}",
     *              "pulls_url": "https://api.github.com/repos/jquery/jquery/pulls{/number}",
     *              "milestones_url": "https://api.github.com/repos/jquery/jquery/milestones{/number}",
     *              "notifications_url": "https://api.github.com/repos/jquery/jquery/notifications{?since,all,participating}",
     *              "labels_url": "https://api.github.com/repos/jquery/jquery/labels{/name}",
     *              "deployments_url": "http://api.github.com/repos/octocat/Hello-World/deployments",
     *              "releases_url": "http://api.github.com/repos/octocat/Hello-World/releases{/id}"
     *          },
     *          "score": 1
     *          }
     *       ]
     *    }
     *  }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "errors": [
     *            {
     *              "message": "Must include at least one user, organization, or repository",
     *              "resource": "Search",
     *              "field": "q",
     *              "code": "invalid"
     *            }
     *          ],
     *          "documentation_url": "https://docs.github.com/v3/search/"
     *      }
     *  }
     * 
     */
    public function code(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('code', $request);
        return $response;
    }

    /**
     * Commits search
     * 
     * @queryParam search required Szukana fraza
     * @queryParam user|repo|org required Nazwa użytkownika|Nazwa repozytorium|Nazwa organizacji
     * @queryParam order optional Sortowanie asc lub desc
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * 
     * @response status=200 {
     *  "total_count": 1,
     *  "incomplete_results": false,
     *  "items": [
     *      {
     *          "url": "https://api.github.com/repos/octocat/Spoon-Knife/commits/bb4cc8d3b2e14b3af5df699876dd4ff3acd00b7f",
     *          "sha": "bb4cc8d3b2e14b3af5df699876dd4ff3acd00b7f",
     *          "html_url": "https://github.com/octocat/Spoon-Knife/commit/bb4cc8d3b2e14b3af5df699876dd4ff3acd00b7f",
     *          "comments_url": "https://api.github.com/repos/octocat/Spoon-Knife/commits/bb4cc8d3b2e14b3af5df699876dd4ff3acd00b7f/comments",
     *          "commit": {
     *              "url": "https://api.github.com/repos/octocat/Spoon-Knife/git/commits/bb4cc8d3b2e14b3af5df699876dd4ff3acd00b7f",
     *              "author": {
     *                  "date": "2014-02-04T14:38:36-08:00",
     *                  "name": "The Octocat",
     *                  "email": "octocat@nowhere.com"
     *              },
     *              "committer": {
     *                  "date": "2014-02-12T15:18:55-08:00",
     *                  "name": "The Octocat",
     *                  "email": "octocat@nowhere.com"
     *              },
     *              "message": "Create styles.css and updated README",
     *              "tree": {
     *                  "url": "https://api.github.com/repos/octocat/Spoon-Knife/git/trees/a639e96f9038797fba6e0469f94a4b0cc459fa68",
     *                  "sha": "a639e96f9038797fba6e0469f94a4b0cc459fa68"
     *              },
     *              "comment_count": 8
     *          },
     *          "author": {
     *              "login": "octocat",
     *              "id": 583231,
     *              "node_id": "MDQ6VXNlcjU4MzIzMQ==",
     *              "avatar_url": "https://avatars.githubusercontent.com/u/583231?v=3",
     *              "gravatar_id": "",
     *              "url": "https://api.github.com/users/octocat",
     *              "html_url": "https://github.com/octocat",
     *              "followers_url": "https://api.github.com/users/octocat/followers",
     *              "following_url": "https://api.github.com/users/octocat/following{/other_user}",
     *              "gists_url": "https://api.github.com/users/octocat/gists{/gist_id}",
     *              "starred_url": "https://api.github.com/users/octocat/starred{/owner}{/repo}",
     *              "subscriptions_url": "https://api.github.com/users/octocat/subscriptions",
     *              "organizations_url": "https://api.github.com/users/octocat/orgs",
     *              "repos_url": "https://api.github.com/users/octocat/repos",
     *              "events_url": "https://api.github.com/users/octocat/events{/privacy}",
     *              "received_events_url": "https://api.github.com/users/octocat/received_events",
     *              "type": "User",
     *              "site_admin": false        
     *          },
     *          "committer": {},
     *          "parents": [
     *           {
     *              "url": "https://api.github.com/repos/octocat/Spoon-Knife/commits/a30c19e3f13765a3b48829788bc1cb8b4e95cee4",
     *              "html_url": "https://github.com/octocat/Spoon-Knife/commit/a30c19e3f13765a3b48829788bc1cb8b4e95cee4",
     *              "sha": "a30c19e3f13765a3b48829788bc1cb8b4e95cee4"
     *           }
     *          ],
     *          "repository": {
     *              "id": 1300192,
     *              "node_id": "MDEwOlJlcG9zaXRvcnkxMzAwMTky",
     *              "name": "Spoon-Knife",
     *              "full_name": "octocat/Spoon-Knife",
     *              "owner": {
     *              "login": "octocat",
     *              "id": 583231,
     *              "node_id": "MDQ6VXNlcjU4MzIzMQ==",
     *              "avatar_url": "https://avatars.githubusercontent.com/u/583231?v=3",
     *              "gravatar_id": "",
     *              "url": "https://api.github.com/users/octocat",
     *              "html_url": "https://github.com/octocat",
     *              "followers_url": "https://api.github.com/users/octocat/followers",
     *              "following_url": "https://api.github.com/users/octocat/following{/other_user}",
     *              "gists_url": "https://api.github.com/users/octocat/gists{/gist_id}",
     *              "starred_url": "https://api.github.com/users/octocat/starred{/owner}{/repo}",
     *              "subscriptions_url": "https://api.github.com/users/octocat/subscriptions",
     *              "organizations_url": "https://api.github.com/users/octocat/orgs",
     *              "repos_url": "https://api.github.com/users/octocat/repos",
     *              "events_url": "https://api.github.com/users/octocat/events{/privacy}",
     *              "received_events_url": "https://api.github.com/users/octocat/received_events",
     *              "type": "User",
     *              "site_admin": false
     *           },
     *          "private": false,
     *          "html_url": "https://github.com/octocat/Spoon-Knife",
     *          "description": "This repo is for demonstration purposes only.",
     *          "fork": false,
     *          "url": "https://api.github.com/repos/octocat/Spoon-Knife",
     *          "forks_url": "https://api.github.com/repos/octocat/Spoon-Knife/forks",
     *          "keys_url": "https://api.github.com/repos/octocat/Spoon-Knife/keys{/key_id}",
     *          "collaborators_url": "https://api.github.com/repos/octocat/Spoon-Knife/collaborators{/collaborator}",
     *          "teams_url": "https://api.github.com/repos/octocat/Spoon-Knife/teams",
     *          "hooks_url": "https://api.github.com/repos/octocat/Spoon-Knife/hooks",
     *          "issue_events_url": "https://api.github.com/repos/octocat/Spoon-Knife/issues/events{/number}",
     *          "events_url": "https://api.github.com/repos/octocat/Spoon-Knife/events",
     *          "assignees_url": "https://api.github.com/repos/octocat/Spoon-Knife/assignees{/user}",
     *          "branches_url": "https://api.github.com/repos/octocat/Spoon-Knife/branches{/branch}",
     *          "tags_url": "https://api.github.com/repos/octocat/Spoon-Knife/tags",
     *          "blobs_url": "https://api.github.com/repos/octocat/Spoon-Knife/git/blobs{/sha}",
     *          "git_tags_url": "https://api.github.com/repos/octocat/Spoon-Knife/git/tags{/sha}",
     *          "git_refs_url": "https://api.github.com/repos/octocat/Spoon-Knife/git/refs{/sha}",
     *          "trees_url": "https://api.github.com/repos/octocat/Spoon-Knife/git/trees{/sha}",
     *          "statuses_url": "https://api.github.com/repos/octocat/Spoon-Knife/statuses/{sha}",
     *          "languages_url": "https://api.github.com/repos/octocat/Spoon-Knife/languages",
     *          "stargazers_url": "https://api.github.com/repos/octocat/Spoon-Knife/stargazers",
     *          "contributors_url": "https://api.github.com/repos/octocat/Spoon-Knife/contributors",
     *          "subscribers_url": "https://api.github.com/repos/octocat/Spoon-Knife/subscribers",
     *          "subscription_url": "https://api.github.com/repos/octocat/Spoon-Knife/subscription",
     *          "commits_url": "https://api.github.com/repos/octocat/Spoon-Knife/commits{/sha}",
     *          "git_commits_url": "https://api.github.com/repos/octocat/Spoon-Knife/git/commits{/sha}",
     *          "comments_url": "https://api.github.com/repos/octocat/Spoon-Knife/comments{/number}",
     *          "issue_comment_url": "https://api.github.com/repos/octocat/Spoon-Knife/issues/comments{/number}",
     *          "contents_url": "https://api.github.com/repos/octocat/Spoon-Knife/contents/{+path}",
     *          "compare_url": "https://api.github.com/repos/octocat/Spoon-Knife/compare/{base}...{head}",
     *          "merges_url": "https://api.github.com/repos/octocat/Spoon-Knife/merges",
     *          "archive_url": "https://api.github.com/repos/octocat/Spoon-Knife/{archive_format}{/ref}",
     *          "downloads_url": "https://api.github.com/repos/octocat/Spoon-Knife/downloads",
     *          "issues_url": "https://api.github.com/repos/octocat/Spoon-Knife/issues{/number}",
     *          "pulls_url": "https://api.github.com/repos/octocat/Spoon-Knife/pulls{/number}",
     *          "milestones_url": "https://api.github.com/repos/octocat/Spoon-Knife/milestones{/number}",
     *          "notifications_url": "https://api.github.com/repos/octocat/Spoon-Knife/notifications{?since,all,participating}",
     *          "labels_url": "https://api.github.com/repos/octocat/Spoon-Knife/labels{/name}",
     *          "releases_url": "https://api.github.com/repos/octocat/Spoon-Knife/releases{/id}",
     *          "deployments_url": "https://api.github.com/repos/octocat/Spoon-Knife/deployments"
     *      },
     *      "score": 1,
     *      "node_id": "MDQ6VXNlcjU4MzIzMQ=="
     *      }
     *   ]
     * }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "errors": [
     *            {
     *              "message": "The listed users and repositories cannot be searched either because the resources do not exist or you do not have permission to view them.",
     *              "resource": "Search",
     *              "field": "q",
     *              "code": "invalid"
     *            }
     *          ],
     *          "documentation_url": "https://docs.github.com/v3/search/"
     *      }
     *  }
     * 
     */ 

    public function commits(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('commits', $request);
        return $response;
    }
    
    /**
     * Issues search
     * 
     * @queryParam search required Szukana fraza
     * @queryParam user|repo|org required Nazwa użytkownika|Nazwa repozytorium|Nazwa organizacji
     * @queryParam order optional Sortowanie asc lub desc
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * 
     * @response status=200 {
     *  "total_count": 280,
     *  "incomplete_results": false,
     *  "items": [
     *   {
     *      "url": "https://api.github.com/repos/batterseapower/pinyin-toolkit/issues/132",
     *      "repository_url": "https://api.github.com/repos/batterseapower/pinyin-toolkit",
     *      "labels_url": "https://api.github.com/repos/batterseapower/pinyin-toolkit/issues/132/labels{/name}",
     *      "comments_url": "https://api.github.com/repos/batterseapower/pinyin-toolkit/issues/132/comments",
     *      "events_url": "https://api.github.com/repos/batterseapower/pinyin-toolkit/issues/132/events",
     *      "html_url": "https://github.com/batterseapower/pinyin-toolkit/issues/132",
     *      "id": 35802,
     *      "node_id": "MDU6SXNzdWUzNTgwMg==",
     *      "number": 132,
     *      "title": "Line Number Indexes Beyond 20 Not Displayed",
     *      "user": {
     *      "login": "Nick3C",
     *      "id": 90254,
     *      "node_id": "MDQ6VXNlcjkwMjU0",
     *      "avatar_url": "https://secure.gravatar.com/avatar/934442aadfe3b2f4630510de416c5718?d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png",
     *      "gravatar_id": "",
     *      "url": "https://api.github.com/users/Nick3C",
     *      "html_url": "https://github.com/Nick3C",
     *      "followers_url": "https://api.github.com/users/Nick3C/followers",
     *      "following_url": "https://api.github.com/users/Nick3C/following{/other_user}",
     *      "gists_url": "https://api.github.com/users/Nick3C/gists{/gist_id}",
     *      "starred_url": "https://api.github.com/users/Nick3C/starred{/owner}{/repo}",
     *      "subscriptions_url": "https://api.github.com/users/Nick3C/subscriptions",
     *      "organizations_url": "https://api.github.com/users/Nick3C/orgs",
     *      "repos_url": "https://api.github.com/users/Nick3C/repos",
     *      "events_url": "https://api.github.com/users/Nick3C/events{/privacy}",
     *      "received_events_url": "https://api.github.com/users/Nick3C/received_events",
     *      "type": "User",
     *      "site_admin": true
     *    },
     *    "labels": [
     *      {
     *          "id": 4,
     *          "node_id": "MDU6TGFiZWw0",
     *          "url": "https://api.github.com/repos/batterseapower/pinyin-toolkit/labels/bug",
     *          "name": "bug",
     *          "color": "ff0000"
     *      }
     *     ],
     *     "state": "open",
     *     "assignee": null,
     *     "milestone": {
     *          "url": "https://api.github.com/repos/octocat/Hello-World/milestones/1",
     *          "html_url": "https://github.com/octocat/Hello-World/milestones/v1.0",
     *          "labels_url": "https://api.github.com/repos/octocat/Hello-World/milestones/1/labels",
     *          "id": 1002604,
     *          "node_id": "MDk6TWlsZXN0b25lMTAwMjYwNA==",
     *          "number": 1,
     *          "state": "open",
     *          "title": "v1.0",
     *          "description": "Tracking milestone for version 1.0",
     *          "creator": {
     *              "login": "octocat",
     *              "id": 1,
     *              "node_id": "MDQ6VXNlcjE=",
     *              "avatar_url": "https://github.com/images/error/octocat_happy.gif",
     *              "gravatar_id": "",
     *              "url": "https://api.github.com/users/octocat",
     *              "html_url": "https://github.com/octocat",
     *              "followers_url": "https://api.github.com/users/octocat/followers",
     *              "following_url": "https://api.github.com/users/octocat/following{/other_user}",
     *              "gists_url": "https://api.github.com/users/octocat/gists{/gist_id}",
     *              "starred_url": "https://api.github.com/users/octocat/starred{/owner}{/repo}",
     *              "subscriptions_url": "https://api.github.com/users/octocat/subscriptions",
     *              "organizations_url": "https://api.github.com/users/octocat/orgs",
     *              "repos_url": "https://api.github.com/users/octocat/repos",
     *              "events_url": "https://api.github.com/users/octocat/events{/privacy}",
     *              "received_events_url": "https://api.github.com/users/octocat/received_events",
     *              "type": "User",
     *              "site_admin": false
     *          },
     *          "open_issues": 4,
     *          "closed_issues": 8,
     *          "created_at": "2011-04-10T20:09:31Z",
     *          "updated_at": "2014-03-03T18:58:10Z",
     *          "closed_at": "2013-02-12T13:22:01Z",
     *          "due_on": "2012-10-09T23:39:01Z"
     *      },
     *      "comments": 15,
     *      "created_at": "2009-07-12T20:10:41Z",
     *      "updated_at": "2009-07-19T09:23:43Z",
     *      "closed_at": null,
     *      "pull_request": {
     *          "url": "https://api/github.com/repos/octocat/Hello-World/pull/1347",
     *          "html_url": "https://github.com/octocat/Hello-World/pull/1347",
     *          "diff_url": "https://github.com/octocat/Hello-World/pull/1347.diff",
     *          "patch_url": "https://api.github.com/repos/octocat/Hello-World/pulls/1347"
     *       },
     *       "body": "...",
     *       "score": 1,
     *       "locked": true,
     *       "author_association": "COLLABORATOR"
     *      }
     *   ]
     * }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "errors": [
     *            {
     *              "message": "The listed users and repositories cannot be searched either because the resources do not exist or you do not have permission to view them.",
     *              "resource": "Search",
     *              "field": "q",
     *              "code": "invalid"
     *            }
     *          ],
     *          "documentation_url": "https://docs.github.com/v3/search/"
     *      }
     *  }
     * 
     */

    public function issues(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('issues', $request);
        return $response;
    }
    
    /**
     * Labels search
     * 
     * @queryParam search required Szukana fraza
     * @queryParam user|repo|org required Nazwa użytkownika|Nazwa repozytorium|Nazwa organizacji
     * @queryParam order optional Sortowanie asc lub desc
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * @queryParam repository_id integer optional Id repozytorium
     * 
     * @response status=200 {
     *    "total_count": 2,
     *    "incomplete_results": false,
     *    "items": [
     *      {
     *          "id": 418327088,
     *          "node_id": "MDU6TGFiZWw0MTgzMjcwODg=",
     *          "url": "https://api.github.com/repos/octocat/linguist/labels/enhancement",
     *          "name": "enhancement",
     *          "color": "84b6eb",
     *          "default": true,
     *          "description": "New feature or request.",
     *          "score": 1
     *      },
     *      {
     *          "id": 418327086,
     *          "node_id": "MDU6TGFiZWw0MTgzMjcwODY=",
     *          "url": "https://api.github.com/repos/octocat/linguist/labels/bug",
     *          "name": "bug",
     *          "color": "ee0701",
     *          "default": true,
     *          "description": "Something isn't working.",
     *          "score": 1
     *       }
     *     ]
     * }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "documentation_url": "https://docs.github.com/rest/reference/search#search-labels"
     *      }
     *  }
     * 
     */

    public function labels(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('labels', $request);
        return $response;
    }

    /**
     * Repositories search
     * 
     * @queryParam search required Szukana fraza
     * @queryParam user|repo|org required Nazwa użytkownika|Nazwa repozytorium|Nazwa organizacji
     * @queryParam order optional Sortowanie asc lub desc
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * 
     * @response staatus=200 {
     *   "total_count": 40,
     *   "incomplete_results": false,
     *   "items": [
     *    {
     *      "id": 3081286,
     *      "node_id": "MDEwOlJlcG9zaXRvcnkzMDgxMjg2",
     *      "name": "Tetris",
     *      "full_name": "dtrupenn/Tetris",
     *      "owner": {
     *          "login": "dtrupenn",
     *          "id": 872147,
     *          "node_id": "MDQ6VXNlcjg3MjE0Nw==",
     *          "avatar_url": "https://secure.gravatar.com/avatar/e7956084e75f239de85d3a31bc172ace?d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png",
     *          "gravatar_id": "",
     *          "url": "https://api.github.com/users/dtrupenn",
     *          "received_events_url": "https://api.github.com/users/dtrupenn/received_events",
     *          "type": "User",
     *          "html_url": "https://github.com/octocat",
     *          "followers_url": "https://api.github.com/users/octocat/followers",
     *          "following_url": "https://api.github.com/users/octocat/following{/other_user}",
     *          "gists_url": "https://api.github.com/users/octocat/gists{/gist_id}",
     *          "starred_url": "https://api.github.com/users/octocat/starred{/owner}{/repo}",
     *          "subscriptions_url": "https://api.github.com/users/octocat/subscriptions",
     *          "organizations_url": "https://api.github.com/users/octocat/orgs",
     *          "repos_url": "https://api.github.com/users/octocat/repos",
     *          "events_url": "https://api.github.com/users/octocat/events{/privacy}",
     *          "site_admin": true
     *      },
 *          "private": false,
 *          "html_url": "https://github.com/dtrupenn/Tetris",
 *          "description": "A C implementation of Tetris using Pennsim through LC4",
 *          "fork": false,
 *          "url": "https://api.github.com/repos/dtrupenn/Tetris",
 *          "created_at": "2012-01-01T00:31:50Z",
 *          "updated_at": "2013-01-05T17:58:47Z",
 *          "pushed_at": "2012-01-01T00:37:02Z",
 *          "homepage": "https://github.com",
 *          "size": 524,
 *          "stargazers_count": 1,
 *          "watchers_count": 1,
 *          "language": "Assembly",
 *          "forks_count": 0,
 *          "open_issues_count": 0,
 *          "master_branch": "master",
 *          "default_branch": "master",
 *          "score": 1,
 *          "archive_url": "https://api.github.com/repos/dtrupenn/Tetris/{archive_format}{/ref}",
 *          "assignees_url": "https://api.github.com/repos/dtrupenn/Tetris/assignees{/user}",
 *          "blobs_url": "https://api.github.com/repos/dtrupenn/Tetris/git/blobs{/sha}",
 *          "branches_url": "https://api.github.com/repos/dtrupenn/Tetris/branches{/branch}",
 *          "collaborators_url": "https://api.github.com/repos/dtrupenn/Tetris/collaborators{/collaborator}",
 *          "comments_url": "https://api.github.com/repos/dtrupenn/Tetris/comments{/number}",
 *          "commits_url": "https://api.github.com/repos/dtrupenn/Tetris/commits{/sha}",
 *          "compare_url": "https://api.github.com/repos/dtrupenn/Tetris/compare/{base}...{head}",
 *          "contents_url": "https://api.github.com/repos/dtrupenn/Tetris/contents/{+path}",
 *          "contributors_url": "https://api.github.com/repos/dtrupenn/Tetris/contributors",
 *          "deployments_url": "https://api.github.com/repos/dtrupenn/Tetris/deployments",
 *          "downloads_url": "https://api.github.com/repos/dtrupenn/Tetris/downloads",
 *          "events_url": "https://api.github.com/repos/dtrupenn/Tetris/events",
 *          "forks_url": "https://api.github.com/repos/dtrupenn/Tetris/forks",
 *          "git_commits_url": "https://api.github.com/repos/dtrupenn/Tetris/git/commits{/sha}",
 *          "git_refs_url": "https://api.github.com/repos/dtrupenn/Tetris/git/refs{/sha}",
 *          "git_tags_url": "https://api.github.com/repos/dtrupenn/Tetris/git/tags{/sha}",
 *          "git_url": "git:github.com/dtrupenn/Tetris.git",
 *          "issue_comment_url": "https://api.github.com/repos/dtrupenn/Tetris/issues/comments{/number}",
 *          "issue_events_url": "https://api.github.com/repos/dtrupenn/Tetris/issues/events{/number}",
 *          "issues_url": "https://api.github.com/repos/dtrupenn/Tetris/issues{/number}",
 *          "keys_url": "https://api.github.com/repos/dtrupenn/Tetris/keys{/key_id}",
 *          "labels_url": "https://api.github.com/repos/dtrupenn/Tetris/labels{/name}",
 *          "languages_url": "https://api.github.com/repos/dtrupenn/Tetris/languages",
 *          "merges_url": "https://api.github.com/repos/dtrupenn/Tetris/merges",
 *          "milestones_url": "https://api.github.com/repos/dtrupenn/Tetris/milestones{/number}",
 *          "notifications_url": "https://api.github.com/repos/dtrupenn/Tetris/notifications{?since,all,participating}",
 *          "pulls_url": "https://api.github.com/repos/dtrupenn/Tetris/pulls{/number}",
 *          "releases_url": "https://api.github.com/repos/dtrupenn/Tetris/releases{/id}",
 *          "ssh_url": "git@github.com:dtrupenn/Tetris.git",
 *          "stargazers_url": "https://api.github.com/repos/dtrupenn/Tetris/stargazers",
 *          "statuses_url": "https://api.github.com/repos/dtrupenn/Tetris/statuses/{sha}",
 *          "subscribers_url": "https://api.github.com/repos/dtrupenn/Tetris/subscribers",
 *          "subscription_url": "https://api.github.com/repos/dtrupenn/Tetris/subscription",
 *          "tags_url": "https://api.github.com/repos/dtrupenn/Tetris/tags",
 *          "teams_url": "https://api.github.com/repos/dtrupenn/Tetris/teams",
 *          "trees_url": "https://api.github.com/repos/dtrupenn/Tetris/git/trees{/sha}",
 *          "clone_url": "https://github.com/dtrupenn/Tetris.git",
 *          "mirror_url": "git:git.example.com/dtrupenn/Tetris",
 *          "hooks_url": "https://api.github.com/repos/dtrupenn/Tetris/hooks",
 *          "svn_url": "https://svn.github.com/dtrupenn/Tetris",
 *          "forks": 1,
 *          "open_issues": 1,
 *          "watchers": 1,
 *          "has_issues": true,
 *          "has_projects": true,
 *          "has_pages": true,
 *          "has_wiki": true,
 *          "has_downloads": true,
 *          "archived": true,
 *          "disabled": true,
 *          "license": {
     *          "key": "mit",
     *          "name": "MIT License",
     *          "url": "https://api.github.com/licenses/mit",
     *          "spdx_id": "MIT",
     *          "node_id": "MDc6TGljZW5zZW1pdA==",
     *          "html_url": "https://api.github.com/licenses/mit"
     *         }
     *        }
     *    ]
     *  }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "errors": [
     *            {
     *              "message": "The listed users and repositories cannot be searched either because the resources do not exist or you do not have permission to view them.",
     *              "resource": "Search",
     *              "field": "q",
     *              "code": "invalid"
     *            }
     *          ],
     *          "documentation_url": "https://docs.github.com/v3/search/"
     *      }
     *  }
     * 
     */

    public function repositories(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('repositories', $request);
        return $response;
    }

    /**
     * Topics search
     * 
     * @queryParam search string required Szukana fraza
     * @queryParam page integer optional Numer strony wyników do pobrania
     * @queryParam per_page integer optional Wyniki na stronę (max 100)
     * 
     * @response status=200 {
     *      "total_count": 6,
     *      "incomplete_results": false,
     *      "items": [
     *      {
     *          "name": "ruby",
     *          "display_name": "Ruby",
     *          "short_description": "Ruby is a scripting language designed for simplified object-oriented programming.",
     *          "description": "Ruby was developed by Yukihiro \"Matz\" Matsumoto in 1995 with the intent of having an easily readable programming language. It is integrated with the Rails framework to create dynamic web-applications. Ruby's syntax is similar to that of Perl and Python.",
     *          "created_by": "Yukihiro Matsumoto",
     *          "released": "December 21, 1995",
     *          "created_at": "2016-11-28T22:03:59Z",
     *          "updated_at": "2017-10-30T18:16:32Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *      },
     *      {
     *          "name": "rails",
     *          "display_name": "Rails",
     *          "short_description": "Ruby on Rails (Rails) is a web application framework written in Ruby.",
     *          "description": "Ruby on Rails (Rails) is a web application framework written in Ruby. It is meant to help simplify the building of complex websites.",
     *          "created_by": "David Heinemeier Hansson",
     *          "released": "December 13 2005",
     *          "created_at": "2016-12-09T17:03:50Z",
     *          "updated_at": "2017-10-30T16:20:19Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *      },
     *      {
     *          "name": "python",
     *          "display_name": "Python",
     *          "short_description": "Python is a dynamically typed programming language.",
     *          "description": "Python is a dynamically typed programming language designed by Guido Van Rossum. Much like the programming language Ruby, Python was designed to be easily read by programmers. Because of its large following and many libraries, Python can be implemented and used to do anything from webpages to scientific research.",
     *          "created_by": "Guido van Rossum",
     *          "released": "February 20, 1991",
     *          "created_at": "2016-12-07T00:07:02Z",
     *          "updated_at": "2017-10-27T22:45:43Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *      },
     *      {
     *          "name": "jekyll",
     *          "display_name": "Jekyll",
     *          "short_description": "Jekyll is a simple, blog-aware static site generator.",
     *          "description": "Jekyll is a blog-aware, site generator written in Ruby. It takes raw text files, runs it through a renderer and produces a publishable static website.",
     *          "created_by": "Tom Preston-Werner",
     *          "released": "2008",
     *          "created_at": "2016-12-16T21:53:08Z",
     *          "updated_at": "2017-10-27T19:00:24Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *      },
     *      {
     *          "name": "sass",
     *          "display_name": "Sass",
     *          "short_description": "Sass is a stable extension to classic CSS.",
     *          "description": "Sass is a stylesheet language with a main implementation in Ruby. It is an extension of CSS that makes improvements to the old stylesheet format, such as being able to declare variables and using a cleaner nesting syntax.",
     *          "created_by": "Hampton Catlin, Natalie Weizenbaum, Chris Eppstein",
     *          "released": "November 28, 2006",
     *          "created_at": "2016-12-16T21:53:45Z",
     *          "updated_at": "2018-01-16T16:30:40Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *      },
     *      {
     *          "name": "homebrew",
     *          "display_name": "Homebrew",
     *          "short_description": "Homebrew is a package manager for macOS.",
     *          "description": "Homebrew is a package manager for Apple's macOS operating system. It simplifies the installation of software and is popular in the Ruby on Rails community.",
     *          "created_by": "Max Howell",
     *          "released": "2009",
     *          "created_at": "2016-12-17T20:30:44Z",
     *          "updated_at": "2018-02-06T16:14:56Z",
     *          "featured": true,
     *          "curated": true,
     *          "score": 1
     *       }
     *     ]
     * }
     * 
     * @response status=422{
     *      "status": 422,
     *      "message": "Błąd zapytania",
     *      "errors": {
     *          "message": "Validation Failed",
     *          "documentation_url": "https://docs.github.com/rest/reference/search#search-labels"
     *      }
     *  }
     * 
     */

    public function topics(Request $request)
    {
        $response = ApiGitHubServiceProvider::search('topics', $request);
        return $response;
    }


}
