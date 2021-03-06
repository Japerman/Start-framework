<?php

namespace Start\Uri;

use Start\Http\Request;

class UriGenerator
{
    protected $base = null;
    protected $url = null;
    protected $https = false;
    protected $cachedHttps = false;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create URI class values.
     *
     * @return string|null
     */
    function __construct()
    {
        $this->request = resolve(Request::class);
        $this->base = BASE_FOLDER;

        $this->url = $this->request->server('HTTP_HOST') . '/' . $this->base . '/';
        if (! in_array($this->request->server('HTTPS'), [null, 'off', 'false']) ||
            $this->request->server('SERVER_PORT') == 443 || config('app.https') === true) {
            $this->cachedHttps = true;
        }

        return;
    }

    /**
     * Get base url for app.
     *
     * @param string $data
     * @param bool   $secure
     *
     * @return string
     */
    public function base($data = null, $secure = false): string
    {
        $data = (! is_null($data)) ? $this->url . $data : $this->url . '/';
        return $this->getUrl($data, $secure);
    }

    /**
     * Get admin url for app.
     *
     * @param string $data
     * @param bool   $secure
     *
     * @return string
     */
    public function admin($data = null, $secure = false): string
    {
        $data = (! is_null($data))
            ? $this->url . '/' . ADMIN_FOLDER . '/' . $data
            : $this->url . '/' . ADMIN_FOLDER . '/';
        return $this->getUrl($data, $secure);
    }

    /**
     * Get route uri value with params.
     *
     * @param string $name
     * @param array  $params
     * @param bool   $secure
     *
     * @return string
     */
    public function route($name, array $params = null, $secure = false): string
    {
        $routes = file_exists(cache_path('routes.php'))
            ? require cache_path('routes.php')
            : app('route')->getRoutes();

        $found = false;
        foreach ($routes as $key => $value) {
            if ($value['alias'] == $name) {
                $found = true;
                break;
            }
        }

        if ($found) {
            if (strstr($routes[$key]['route'], '{') || strstr($routes[$key]['route'], ':')) {
                $segment = explode('/', $routes[$key]['route']);
                $i = 0;
                foreach ($segment as $key => $value) {
                    if (strstr($value, '{') || strstr($value, ':')) {
                        $segment[$key] = $params[$i];
                        $i++;
                    }
                }
                $newUrl = implode('/', $segment);
            } else {
                $newUrl = $routes[$key]['route'];
            }

            $data = str_replace($this->base, '', $this->url) . '/' . $newUrl;
            return $this->getUrl($data, $secure);
        }

        return $this->getUrl($this->url, $secure);
    }

    /**
     * Get assets directory for app.
     *
     * @param string $data
     * @param bool   $secure
     *
     * @return string
     */
    public function assets($data = null, $secure = false): string
    {
        $data = (! is_null($data))
            ? $this->url . '/' . ASSETS_FOLDER . '/' . $data
            : $this->url . '/' . ASSETS_FOLDER . '/';
        return $this->getUrl($data, $secure);
    }

    /**
     * Redirect to another URL.
     *
     * @param string $data
     * @param int    $statusCode
     * @param bool   $secure
     *
     * @return void
     */
    public function redirect($data = null, int $statusCode = 301, $secure = false): void
    {
        if (substr($data, 0, 4) === 'http' || substr($data, 0, 5) === 'https') {
            header('Location: ' . $data, true, $statusCode);
        } else {
            $data = (! is_null($data)) ? $this->url . '/' . $data : $this->url;
            header('Location: ' . $this->getUrl($data, $secure), true, $statusCode);
        }

        die;
    }

    /**
     * Get active URI.
     *
     * @return string
     */
    public function current(): string
    {
        return $this->scheme() . $this->request->server('HTTP_HOST') . $this->request->server('REQUEST_URI');
    }

    /**
     * Get segments of URI.
     *
     * @param int $num
     *
     * @return array|string|null
     */
    public function segment($num = null)
    {
        if (is_null($this->request->server('REQUEST_URI')) || is_null($this->request->server('SCRIPT_NAME'))) {
            return null;
        }

        $uri = $this->replace(str_replace($this->base, '', $this->request->server('REQUEST_URI')));
        $segments = array_filter(explode('/', $uri), function ($segment) {
            return !empty($segment);
        });

        if (! is_null($num)) {
            return (isset($segments[$num]) ? reset(explode('?', $segments[$num])) : null);
        }

        return $segments;
    }

    /**
     * Get url.
     *
     * @param string $data
     * @param bool   $secure
     *
     * @return string
     */
    protected function getUrl($data, $secure): string
    {
        $this->https = $secure;
        return $this->scheme() . $this->replace($data);
    }

    /**
     * Get url scheme.
     *
     * @return string
     */
    protected function scheme(): string
    {
        if ($this->cachedHttps === true) {
            $this->https = true;
        }

        return "http" . ($this->https === true ? 's' : '') . "://";
    }

    /**
     * Replace.
     *
     * @param string $data
     *
     * @return string|null
     */
    private function replace($data): ?string
    {
        return str_replace(['///', '//'], '/', $data);
    }
}