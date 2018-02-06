## EASYAPPOINTMENTS CAS AUTHENTICATION

This plugin allows you to use CAS authentication with your easyappointements platform.

### DISCLAIMER
I developed and tested this plugin with easyappointments 1.2.1, I can't guarantee it will work with an other version.

### REQUIRES
You need to install [easyappointments-authentication](https://github.com/FredericCasazza/easyappointments-authentication) plugin before

### INSTALLATION
Put files in your easyappointments directory.

### CONFIGURATION
To configure the plugin, edit the config.php file at the root of your application directory.

##### Define the authentication mode
```
// config.php
...
/**
 * The class used for authentication
 */
const AUTHENTICATION_CLASS = 'authentication/CasAuthentication/CasAuthentication';

```

##### Configure CAS
```
// config.php
..
/**
 * CAS version
 * Default = '2.0'
 */
const CAS_VERSION = '2.0';

/**
 * CAS host server
 * Default null
 */
const CAS_HOST = 'my_cas_server.domain.com';

/**
 * CAS port
 * Default = 80
 */
const CAS_PORT = 443;

/**
 * CAS context (ex: '/cas' if your cas server is requested on http://my_cas_server.domain.com/cas)
 * Default = ''
 */
const CAS_CONTEXT = '';

/**
 * CAS service redirection after login. If null redirect to previous url before CAS called
 * Default = ''
 */
const CAS_SERVICE_REDIRECT_URL = '';

/**
 * CAS certificat
 * Default = ''
 */
const CAS_CERT = '';

/**
 * CAS not validate certificate
 * Default = FALSE
 */
const CAS_NO_SERVER_VALIDATION = FALSE;

/**
 * CAS debug mode
 * Default = FALSE
 */
const CAS_DEBUG = FALSE;

/**
 * CAS verbose
 * Default = FALSE
 */
const CAS_VERBOSE = FALSE;

```