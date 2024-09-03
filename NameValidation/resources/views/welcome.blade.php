<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .api-url {
            font-size: 20px;
            font-weight: bold;
            background-color: #f5f5f5;
            padding: 10px;
            border: 1px solid #ddd;
            margin: 10px 0;
        }
        .code-block {
            background-color: #f5f5f5;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            white-space: pre-wrap;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
                max-width: 100%;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            p {
                font-size: 16px;
                margin-bottom: 5px;
            }
            .api-url {
                font-size: 18px;
                padding: 5px;
                margin: 5px 0;
            }
            .code-block {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> NAME VALIDATION API Documentation</h1>
        <p>Here's how to use the API:</p>
        <p>For the live environment, make a POST request to the following URL:</p>
        <div class="api-url">https://emergentghanadev.com/api/name-validation/live</div>
        <p>For the test environment, make a POST request to the following URL:</p>
        <div class="api-url">https://emergentghanadev.com/api/name-validation/test</div>
        <p>Make sure to include the required headers and parameters as described in the documentation.</p>
        <p>If you want to validate a name using a phone number, you can provide the phone number in the URL as a query parameter, like this:</p>
        <div class="api-url">https://emergentghanadev.com/api/name-validation/live/233123456789</div>

        <h2>Sample Request</h2>
        <div class="code-block">
            <pre>
{
    "app_id": "your_app_id",
    "app_key": "your_app_key",
    "mobile": "+1234567890",
    "network": "MTN"
}
            </pre>
        </div>

        <h2>Sample Response</h2>
        <div class="code-block">
            <pre>
{
    "status_code": 1,
    "status_message": "success",
    "firstname": "John",
    "surname": "Doe",
    "valid": "true"
}
            </pre>
        </div>
    </div>
</body>
</html>
