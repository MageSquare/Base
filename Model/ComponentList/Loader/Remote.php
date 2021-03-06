<?php

namespace MageSquare\Base\Model\ComponentList\Loader;

class Remote extends AbstractLoader
{
    const XML_USE_HTTPS_PATH = 'magesquare_base/modules/use_https';
    const XML_FEED_URL_PATH  = 'magesquare_base/modules/url';

    const RESPONSE_CACHE_KEY = 'magesquare_components_remote_response';

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @var \Magento\Framework\HTTP\ZendClientFactory
     */
    protected $httpClientFactory;

    /**
     * @var \Magento\Framework\App\CacheInterface
     */
    protected $cache;

    /**
     * @param \MageSquare\Base\Helper\Component                     $componentHelper
     * @param \Magento\Framework\App\RequestInterface            $request
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Json\Helper\Data                $jsonHelper
     * @param \Magento\Framework\HTTP\ZendClientFactory          $httpClientFactory
     */
    public function __construct(
        \MageSquare\Base\Helper\Component $componentHelper,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        \Magento\Framework\App\CacheInterface $cache
    ) {
        parent::__construct($componentHelper);
        $this->request = $request;
        $this->scopeConfig = $scopeConfig;
        $this->jsonHelper = $jsonHelper;
        $this->httpClientFactory = $httpClientFactory;
        $this->cache = $cache;
    }

    public function getMapping()
    {
        return [
            'description' => 'description',
            'keywords' => 'keywords',
            'name' => 'name',
            'version' => 'latest_version',
            'type' => 'type',
            'time' => 'release_date',
            'extra.magesquare.links.store' => 'link',
            'extra.magesquare.links.docs' => 'docs_link',
            'extra.magesquare.links.download' => 'download_link',
            'extra.magesquare.links.changelog' => 'changelog_link',
            'extra.magesquare.links.marketplace' => 'marketplace_link',
            'extra.magesquare.links.identity_key' => 'identity_key_link',
            'extra.magesquare.purchase_code' => 'purchase_code',
        ];
    }

    /**
     * Retrieve component names and configs from remote satis repository
     *
     * @return \Traversable
     */
    public function getComponentsInfo()
    {
        try {
            if (!$responseBody = $this->cache->load(self::RESPONSE_CACHE_KEY)) {
                $responseBody = $this->fetch($this->getFeedUrl());
                $this->cache->save($responseBody, self::RESPONSE_CACHE_KEY, [], 86400);
            }
            $response = $this->jsonHelper->jsonDecode($responseBody);
        } catch (\Exception $e) {
            $response = [];
            // MageSquare_Subscription will be added below - used by
            // subscription activation module
        }

        if (!is_array($response)) {
            $response = [];
        }

        $modules = [];
        if (!empty($response['packages'])) {
            foreach ($response['packages'] as $packageName => $info) {
                $versions = array_keys($info);
                $latestVersion = array_reduce($versions, function ($carry, $item) {
                    if (version_compare($carry, $item) === -1) {
                        $carry = $item;
                    }
                    return $carry;
                });
                if (!empty($info[$latestVersion]['type']) &&
                    $info[$latestVersion]['type'] === 'metapackage') {

                    continue;
                }
                $modules[$packageName] = $info[$latestVersion];

                if (isset($info['dev-master']['extra']['magesquare'])) {
                    $modules[$packageName]['extra']['magesquare'] =
                        $info['dev-master']['extra']['magesquare'];
                }
            }
        }

        $modules['magesquare/subscription'] = [
            'name'          => 'magesquare/subscription',
            'type'          => 'subscription-plan',
            'description'   => 'SwissUpLabs Modules Subscription',
            'version'       => '',
            'extra' => [
                'magesquare' => [
                    'links' => [
                        'store' => 'https://magesquare.com',
                        'download' => 'https://magesquare.com/subscription/customer/products/',
                        'identity_key' => 'https://magesquare.com/license/customer/identity/'
                    ]
                ]
            ]
        ];

        return $modules;
    }

    /**
     * Make a http request and return response body
     *
     * @param  string $url
     * @return string
     */
    protected function fetch($url)
    {
        $client = $this->httpClientFactory->create();
        $client->setUri($url);
        $client->setConfig([
            'maxredirects' => 5,
            'timeout' => 30
        ]);
        $client->setParameterGet('domain', $this->request->getHttpHost());
        return $client->request()->getBody();
    }

    /**
     * Get feed url from satis repository.
     *
     * To do that we send a request to http://docs.magesquare.com/packages/packages.json,
     * which returns actual packages list url: http://docs.magesquare.com/packages/include/all${sha1}.json
     *
     * @return string
     */
    protected function getFeedUrl()
    {
        $useHttps = $this->scopeConfig->getValue(
            self::XML_USE_HTTPS_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $url = $this->scopeConfig->getValue(
            self::XML_FEED_URL_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        // http://docs.magesquare.com/packages/packages.json
        $url = ($useHttps ? 'https://' : 'http://') . $url;

        $response = $this->fetch($url . '/packages.json');
        $response = $this->jsonHelper->jsonDecode($response);
        if (!is_array($response) || !isset($response['includes'])) {
            return false;
        }

        // http://docs.magesquare.com/packages/include/all${sha1}.json
        return $url . '/' . key($response['includes']);
    }
}
