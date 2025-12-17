<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Provider as SocialiteProvider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as OAuth2User;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

// describe('authentication required', function () {
//     it('redirects login route to correct Google URL', function() {
//         $response = $this->get('/google-auth/redirect');

//         $redirect_url = $response->getTargetUrl();
//         $parsed_query = [];
//         parse_str(parse_url($redirect_url)['query'] ?? '', $parsed_query);

//         $response->assertStatus(302);
//         expect($redirect_url)->toStartWith(
//             'https://accounts.google.com/o/oauth2/auth'
//         );
//         expect($parsed_query)->toHaveKeys([
//             'client_id',
//             'redirect_url',
//             'scope',
//             'response_type',
//             'state'
//         ]);
//     });
// });
