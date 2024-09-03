<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NameValidationController extends Controller
{
    public function validateName(Request $request, $environment, $phoneNumber = null)
    {
        // Log a message to indicate the start of the validation process
        Log::info('Starting the name validation process.');

        // Validate the environment parameter to ensure it's either "live" or "test"
        if ($environment !== 'live' && $environment !== 'test') {
            Log::error('Invalid environment: ' . $environment);
            return response()->json(['error' => 'Invalid environment'], 400);
        }

        // Check if a phone number is provided in the URL
        if ($phoneNumber) {
            // Use the configuration for the specified environment
            $config = config("namevalidation_{$environment}");

            // Determine the phone number based on the URL parameter
            $mobile = '+' . $phoneNumber;

            // Log configuration and mobile number for debugging
            Log::info('Configuration: ' . json_encode($config));
            Log::info('Mobile number: ' . $mobile);

            // Log the API request before making it
            Log::info('API Request: ' . json_encode([
                'app_id' => $config['app_id'],
                'app_key' => $config['app_key'],
                'mobile' => $mobile,
                'network' => '', // Set 'network' to an empty string
            ]));

            // Make a request to the INTERPAY API with the determined phone number
            $response = Http::post($config['base_url'], [
                'app_id' => $config['app_id'],
                'app_key' => $config['app_key'],
                'mobile' => $mobile,
                'network' => '', // Set 'network' to an empty string
            ]);
        } else {
            // Retrieve the request data from the JSON request body
            $requestData = $request->json()->all();

            $appId = $requestData['app_id'];
            $appKey = $requestData['app_key'];
            $mobile = $requestData['mobile'];
            $network = $requestData['network']; // You can set 'network' to an empty string here

            // Use the configuration for the specified environment
            $config = config("namevalidation_{$environment}");

            // Log request data for debugging purposes
            Log::info('Request data: ' . json_encode($requestData));

            // Log the API request before making it
            Log::info('API Request: ' . json_encode([
                'app_id' => $config['app_id'],
                'app_key' => $config['app_key'],
                'mobile' => $mobile,
                'network' => '', // Set 'network' to an empty string
            ]));

            // Make a request to the INTERPAY API with the request data
            $response = Http::post($config['base_url'], [
                'app_id' => $config['app_id'],
                'app_key' => $config['app_key'],
                'mobile' => $mobile,
                'network' => '', // Set 'network' to an empty string
            ]);
        }

        // Log the HTTP status code of the response
        Log::info('API Response HTTP Status Code: ' . $response->status());

        // Log the API response body, even if it's null
        Log::info('API Response Body: ' . json_encode($response->json()));

        // Process the response
        $data = $response->json();

        if ($response->status() === 200) {
            // Check if the response is successful (HTTP status code 200 OK)
            if ($data['status_code'] === 1 && $data['valid'] === "true") {
                return response()->json([
                    'status_code' => $data['status_code'],
                    'status_message' => $data['status_message'],
                    'firstname' => $data['firstname'],
                    'surname' => $data['surname'],
                    'valid' => $data['valid'],
                ]);
            } else {
                return response()->json([
                    'status_code' => $data['status_code'],
                    'status_message' => $data['status_message'],
                    'firstname' => 'Name',
                    'surname' => 'Name',
                    'valid' => 'false',
                ]);
            }
        } else {
            // Handle the case where the HTTP status code is not 200 (e.g., handle errors)
            Log::error('API Request failed with HTTP status code: ' . $response->status());
            return response()->json(['error' => 'API Request failed'], 500); // Adjust the status code and response as needed
        }
    }
}

