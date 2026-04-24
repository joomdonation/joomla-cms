# Quick Reference: HTTP Factory Usage in Joomla

## For Model Developers

### Step 1: Implement the Interface
```php
use Joomla\CMS\Http\HttpFactoryAwareInterface;
use Joomla\CMS\Http\HttpFactoryAwareTrait;
use Joomla\CMS\MVC\Model\ListModel;

class YourModel extends ListModel implements HttpFactoryAwareInterface
{
    use HttpFactoryAwareTrait;

    // Your code here
}
```

### Step 2: Use It!
```php
public function fetchData()
{
    // Get HTTP client (user agent and proxy automatically configured!)
    $http = $this->getHttpFactory()->getHttp();

    // Make request
    $response = $http->get('https://api.example.com/data');

    // Process response
    return json_decode($response->getBody());
}
```

### Need Custom Options?
```php
public function fetchData()
{
    // You can still pass custom options
    $options = new \Joomla\Registry\Registry();
    $options->set('timeout', 30);

    $http = $this->getHttpFactory()->getHttp($options);
    $response = $http->get('https://api.example.com/data');

    return $response;
}
```

---

## For Plugin Developers

### In Service Provider
```php
// plugins/system/yourplugin/services/provider.php
use Joomla\CMS\Http\HttpFactoryInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface {
    public function register(Container $container)
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $plugin = new YourPlugin(
                    $container->get(DispatcherInterface::class),
                    (array) PluginHelper::getPlugin('system', 'yourplugin'),
                    $container->get(HttpFactoryInterface::class)  // Inject here!
                );

                return $plugin;
            }
        );
    }
};
```

### In Plugin Class
```php
use Joomla\CMS\Http\HttpFactoryInterface;
use Joomla\CMS\Plugin\CMSPlugin;

class YourPlugin extends CMSPlugin
{
    private $httpFactory;

    public function __construct($subject, $config, HttpFactoryInterface $httpFactory)
    {
        parent::__construct($subject, $config);
        $this->httpFactory = $httpFactory;
    }

    public function onSomeEvent()
    {
        $http = $this->httpFactory->getHttp();
        $response = $http->get('https://api.example.com/data');
        // Use response...
    }
}
```

---

## For Anywhere Else (Libraries, Helpers, etc.)

### Get from Container
```php
use Joomla\CMS\Factory;
use Joomla\CMS\Http\HttpFactoryInterface;

class YourHelper
{
    public static function fetchData()
    {
        // Get HttpFactory from container
        $httpFactory = Factory::getContainer()->get(HttpFactoryInterface::class);

        // Use it
        $http = $httpFactory->getHttp();
        $response = $http->get('https://api.example.com/data');

        return $response;
    }
}
```

---

## What You Get Automatically

### ✅ User Agent
Automatically set to: `Joomla/X.Y.Z (https://www.joomla.org)`

### ✅ Proxy Configuration
If enabled in Global Configuration:
- Proxy host
- Proxy port
- Proxy user
- Proxy password

All automatically applied!

---

## What Was Updated

### Core Models Using New Pattern
1. ✅ `UpdateModel` (com_joomlaupdate)
2. ✅ `ApplicationModel` (com_config)
3. ✅ `LanguagesModel` (com_installer)

### Still Using Old Pattern (Update When Needed)
- Various libraries (UpdateAdapter, Update, etc.)
- Some plugins (requests, stats, yubikey)
- Other classes (Changelog, InstallerHelper, etc.)

---

## Migration Checklist

When updating your code:

- [ ] Add `use Joomla\CMS\Http\HttpFactoryAwareInterface;`
- [ ] Add `use Joomla\CMS\Http\HttpFactoryAwareTrait;`
- [ ] Implement interface: `implements HttpFactoryAwareInterface`
- [ ] Use trait: `use HttpFactoryAwareTrait;`
- [ ] Remove: `use Joomla\Http\HttpFactory;`
- [ ] Replace: `(new HttpFactory())->getHttp()` → `$this->getHttpFactory()->getHttp()`
- [ ] Remove manual user agent setup
- [ ] Test!

---

## Files Modified in This Implementation

### Infrastructure (5 files)
1. `libraries/src/Http/HttpClientFactory.php`
2. `libraries/src/Service/Provider/Http.php`
3. `libraries/src/Http/HttpFactoryAwareTrait.php`
4. `libraries/src/Http/HttpFactoryAwareInterface.php`
5. `libraries/src/MVC/Factory/MVCFactory.php` (already done)

### Models (3 files)
1. `administrator/components/com_joomlaupdate/src/Model/UpdateModel.php`
2. `administrator/components/com_config/src/Model/ApplicationModel.php`
3. `administrator/components/com_installer/src/Model/LanguagesModel.php` (already done)

---

## Need Help?

- **Documentation:** See `HTTP_FACTORY_CHANGES.md` for infrastructure details
- **Model Examples:** See `MODEL_UPDATES_SUMMARY.md` for before/after examples
- **Complete Overview:** See `MIGRATION_COMPLETE_SUMMARY.md` for full summary

---

**Happy Coding with Modern HTTP Factory Pattern!** 🚀

