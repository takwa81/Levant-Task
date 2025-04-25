<?php

return [


    'success' => 'Operation completed successfully.',
    'error' => 'An error occurred. Please try again.',
    'not_found' => 'The requested resource was not found.',
    'profile_success' => 'Profile fetched successfully.',
    'unexpected_error' => 'An unexpected error occurred. Please try again later.',

    'auth' => [
        'login_successful' => 'Login successful.',
        'login_failed' => 'Login failed. Please try again.',
        'failed' => 'These credentials do not match our records.',

        'token_required' => 'Authentication token is required .',
        'token_invalid' => 'Invalid or expired token.',

        'unauthenticated' => 'You are not authenticated.',
        'not_authorized' => 'You are not authorized to access this resource.',


    ],

    'validation' => [
        'name_required' => 'The name field is required.',
        'email_unique' => 'The email has already been taken.',
        'email_required' => 'The email field is required.',
        'email_invalid' => 'Please enter a valid email address.',
        'password_required' => 'The password field is required.',
        'password_min' => 'The password must be at least 6 characters.',
        'email_exists' => 'The selected email does not exist.',
        'error_occurred' => 'Validation error. Please check your input.',
        'error_occurred'    => 'Validation error. Please check your input.',
        'title_required'    => 'The title field is required.',
        'title_string'      => 'The title must be a string.',
        'title_max'         => 'The title may not be greater than 255 characters.',

        'content_required'  => 'The content field is required.',
        'content_string'    => 'The content must be a string.',

        'image_type'        => 'The file must be an image.',
        'image_max'         => 'The image may not be larger than 2MB.',
        'image_reuired'     => 'The Image Field is Required',

        'comment_required' => 'The comment field is required.',
        'comment_string'   => 'The comment must be a string.',
        'comment_max'      => 'The comment must not be greater than 1000 characters.',


    ],

    'posts' => [
        'list_success'   => 'Posts retrieved successfully.',
        'created'        => 'Post created successfully.',
        'updated'        => 'Post updated successfully.',
        'deleted'        => 'Post deleted successfully.',
        'unauthorized'   => 'You are not authorized to update this post.',
        'unauthorized_delete'   => 'You are not authorized to delete this post.',
    ],

    'comments' => [
        'created' => 'Comment added successfully.',
        'list_success' => 'Comments retrieved successfully.',
    ],


    'users' => [
        'created' => 'User created successfully.',
        'updated' => 'User updated successfully.',
        'list_success' => 'Users retrieved successfully.',
        'deleted' => 'User deleted successfully.',
    ],

    'errors' => [
        'route_not_found' => 'The requested route was not found.',
        'method_not_allowed' => 'The HTTP method is not allowed for this route.',
        'unauthenticated' => 'You are not authenticated.',
        'forbidden' => 'You do not have permission to access this resource.',
        'validation_failed' => 'Validation failed.',
        'model_not_found' => 'The requested resource was not found.',
        'unexpected_error' => 'An unexpected error occurred. Please try again later.',
    ],

];
