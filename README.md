# Routing
    This app has 2 main routing:

    1. Route to serve content.
    2. Route for API call.

## Route to Serve Content:
    To serve content, we have a spesific criteria for the URL form.
    
    https://{DOMAIN}/controller/method/...data/...data


## Route for API Call:
    For request that used to do API Call, it needs /api after the 
    domain, for example: https://{DOMAIN}/api

    We also have API versioning system.  We define the API version
    right after the /api, for example: https://{DOMAIN}/api/v1.

    Our API version format: v{version number}, for example: v1, v2, ....


# Application Version
    We will implement Semantic Versioning for the application version.