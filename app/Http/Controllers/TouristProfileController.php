<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TouristProfileController extends Controller
{
    public function myProfileShow(Request $request)
    {
        $tab = $request->query('tab');
        $id = Auth::id();


        $user = [
            'id' => $id,
            'name' => 'Tourist User ' . $id,
            'email' => 'tourist' . $id . '@example.com',
            'phone_number' => '1234567890',
            'avatar' => asset('images/default-avatar.png'),
            'header' => asset('images/default-header.jpg'),
            'password' => bcrypt('password123'),
            'role_id' => 1, // 1: Tourist, 2: Business
            'introduction' => 'I love traveling and exploring new places!',
            'website_url' => 'https://example.com',
            'instagram' => 'tourist_' . $id,
            'facebook' => 'tourist.fb.' . $id,
            'x' => 'tourist_x_' . $id,
            'tiktok' => 'tourist_tiktok_' . $id,
            'official_certification' => 0, // 0: Not Certified, 1: Certified
            'last_login_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),
            'email_verified_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),
            'myQuests' => [
                [
                    'id' => 1,
                    'title' => 'Underwater Aquarium',
                    'description' => 'Exploring ocean life indoors.',
                    'image' => asset('images/underwater.jpg'),
                    'status' => 'Public',
                ],
                [
                    'id' => 2,
                    'title' => 'Night City Walk',
                    'description' => 'Beautiful lights at night.',
                    'image' => asset('images/night_city.jpg'),
                    'status' => 'Public',
                ],
                [
                    'id' => 3,
                    'title' => 'Historical Theater',
                    'description' => 'Inside a cultural landmark.',
                    'image' => asset('images/theater.jpg'),
                    'status' => 'Private',
                ]
            ],

            'mySpots' => [
                [
                    'id' => 4,
                    'title' => 'Lakeside Morning',
                    'description' => 'Peaceful spot by the lake.',
                    'image' => asset('images/lake.jpg'),
                ],
                [
                    'id' => 5,
                    'title' => 'Bridge View',
                    'description' => 'Modern bridge crossing.',
                    'image' => asset('images/bridge.jpg'),
                ]
            ],

            'likedQuests' => [
                [
                    'title' => 'Underwater Adventure',
                    'description' => 'An unforgettable diving experience.',
                    'image' => asset('images/underwater.jpg')
                ],
                [
                    'title' => 'Historical Castle Tour',
                    'description' => 'Explore the ancient castle ruins.',
                    'image' => asset('images/castle.jpg')
                ],
                [
                    'title' => 'Hot Air Balloon Ride',
                    'description' => 'Fly above the scenic valley.',
                    'image' => asset('images/balloon.jpg')
                ],
                [
                    'title' => 'Jungle Safari',
                    'description' => 'A thrilling journey through the wild.',
                    'image' => asset('images/safari.jpg')
                ],
                [
                    'title' => 'Desert Camping',
                    'description' => 'Experience the night under the stars.',
                    'image' => asset('images/desert.jpg')
                ]
            ],
            'likedSpots' => [
                [
                    'title' => 'Cherry Blossom Park',
                    'description' => 'A beautiful park filled with cherry blossoms.',
                    'image' => asset('images/cherry_blossom.jpg')
                ],
                [
                    'title' => 'Kyoto Garden',
                    'description' => 'A peaceful Japanese-style garden.',
                    'image' => asset('images/kyoto_garden.jpg')
                ],
                [
                    'title' => 'Mountain Viewpoint',
                    'description' => 'Stunning panoramic mountain views.',
                    'image' => asset('images/mountain_view.jpg')
                ],
                [
                    'title' => 'Seaside Cliff',
                    'description' => 'Perfect spot for sunset watchers.',
                    'image' => asset('images/cliff.jpg')
                ],
                [
                    'title' => 'Lakefront Walk',
                    'description' => 'Romantic walking trail by the lake.',
                    'image' => asset('images/lake.jpg')
                ],
                [
                    'title' => 'Forest Shrine',
                    'description' => 'Hidden shrine deep in the forest.',
                    'image' => asset('images/shrine.jpg')
                ],
                [
                    'title' => 'Snowy Hill',
                    'description' => 'Fun for sledding and snowball fights.',
                    'image' => asset('images/snow_hill.jpg')
                ],
                [
                    'title' => 'Urban Street Art',
                    'description' => 'Creative murals and graffiti spots.',
                    'image' => asset('images/street_art.jpg')
                ],
                [
                    'title' => 'Rice Terrace',
                    'description' => 'Terraced fields with historical charm.',
                    'image' => asset('images/rice_terrace.jpg')
                ],
                [
                    'title' => 'Bamboo Forest',
                    'description' => 'Walk through towering green bamboo.',
                    'image' => asset('images/bamboo.jpg')
                ]
            ],
            'likedBusinesses' => [
                [
                    'title' => 'Matcha Cafe Kyoto',
                    'description' => 'Authentic green tea and sweets.',
                    'image' => asset('images/matcha_cafe.jpg')
                ],
                [
                    'title' => 'Handmade Craft Shop',
                    'description' => 'Local artisan goods and souvenirs.',
                    'image' => asset('images/craft_shop.jpg')
                ],
                [
                    'title' => 'Traditional Kimono Rental',
                    'description' => 'Experience Japan in a traditional outfit.',
                    'image' => asset('images/kimono_rental.jpg')
                ],
                [
                    'title' => 'Sushi Workshop',
                    'description' => 'Learn to make sushi with local chefs.',
                    'image' => asset('images/sushi_workshop.jpg')
                ]
            ],


            'followers' => [
                ['name' => 'Follower 1', 'avatar' => asset('images/avatar1.png')],
                ['name' => 'Follower 2', 'avatar' => asset('images/avatar2.png')],
                ['name' => 'Follower 3', 'avatar' => asset('images/avatar3.png')],
                ['name' => 'Follower 4', 'avatar' => asset('images/avatar4.png')],
                ['name' => 'Follower 5', 'avatar' => asset('images/avatar5.png')],
                ['name' => 'Follower 6', 'avatar' => asset('images/avatar6.png')],
                ['name' => 'Follower 7', 'avatar' => asset('images/avatar7.png')],
                ['name' => 'Follower 8', 'avatar' => asset('images/avatar8.png')],
                ['name' => 'Follower 9', 'avatar' => asset('images/avatar9.png')],
            ],
            'following' => [
                ['name' => 'Following 1', 'avatar' => asset('images/avatar10.png')],
                ['name' => 'Following 2', 'avatar' => asset('images/avatar11.png')],
                ['name' => 'Following 3', 'avatar' => asset('images/avatar12.png')],
                ['name' => 'Following 4', 'avatar' => asset('images/avatar13.png')],
                ['name' => 'Following 5', 'avatar' => asset('images/avatar14.png')],
                ['name' => 'Following 6', 'avatar' => asset('images/avatar15.png')],
                ['name' => 'Following 7', 'avatar' => asset('images/avatar16.png')],
            ],
            'comments' => [
                [
                    'title' => 'Sunset in Santorini',
                    'text' => 'Wow, your photos are stunning! Santorini’s sunsets are truly magical. Hope I can visit someday!',
                    'created_at' => '2024/10/24',
                    'likes' => 0
                ],
                [
                    'title' => 'Exploring Kyoto’s Hidden Temples',
                    'text' => 'This is amazing! Kyoto has so much history and beauty. Thanks for sharing these secret spots!',
                    'created_at' => '2024/10/24',
                    'likes' => 0
                ]
            ],
            'reviews' => [
                [
                    'title' => 'Hop cafe',
                    'rating' => 4,
                    'text' => 'Had a great time!',
                    'created_at' => '2024/10/24',
                    'likes' => 0
                ],
                [
                    'title' => 'Gion Festival',
                    'rating' => 3,
                    'text' => 'This is amazing! Kyoto has so much history and beauty.',
                    'created_at' => '2024/10/24',
                    'likes' => 0
                ],
                [
                    'title' => 'Hop cocktail bar',
                    'rating' => 5,
                    'text' => 'Delicious',
                    'created_at' => '2024/10/24',
                    'likes' => 0
                ]
            ],



        ];

        return view('tourists.profiles.myprofile', compact('user'));
    }

    // Show the edit profile form
    public function edit()
    {
        $user = [
            'id' => Auth::id(),
            'name' => 'bow_wow_0606',
            'email' => 'bow_wow_0606@example.com',
            'avatar' => asset('images/default-avatar.png'),
            'header' => asset('images/header-mt-fuji.jpg'),
            'introduction' => '🌏 I love traveling!!! The world is too big to stay in one place 🌈',
            'instagram' => 'bow_wow_0606',
            'x' => 'bow_wow_0606',
            'facebook' => 'bow_wow_0606',
            'tiktok' => 'bow_wow_0606'
        ];

        return view('tourists.profiles.myprofile_edit', compact('user'));
    }

    // Update the profile information
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'introduction' => 'nullable|max:500',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'x' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048',
            'header' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simulate storing images if provided
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $avatarPath;
        }

        if ($request->hasFile('header')) {
            $headerPath = $request->file('header')->store('headers', 'public');
            $validated['header'] = '/storage/' . $headerPath;
        }

        // $user = Auth::user();
        // $user->update($validated);

        // Normally this would save to DB — here we simulate success
        return redirect()->route('myprofile.show')->with('success', 'Profile updated successfully!');
    }

    // Handle password update
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Password change logic skipped (static)
        return back()->with('success', 'Password has been updated.');
    }
    public function destroy()
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect('/');
    }

    // public function showOtherProfile($id)
    // {
    //     $user = User::findOrFail($id);

    //     $isOwnProfile = Auth::check() && Auth::id() === $user->id;

    //     return view('tourists.profiles.show', compact('user', 'isOwnProfile'));
    // }

    public function showOtherProfile($id)
    {
        $user = $this->mockUserData($id);

        $isOwnProfile = false;

        return view('tourists.profiles.show', compact('user', 'isOwnProfile'));
    }

    private function mockUserData($id)
    {
        return [
            'id' => $id,
            'name' => 'User ' . $id,
            'email' => 'user' . $id . '@example.com',
            'avatar' => asset('images/default-avatar.png'),
            'header' => asset('images/default-header.jpg'),
            'introduction' => '🌏 Just a mock traveler exploring the world!',
            'instagram' => 'mock_instagram_' . $id,
            'facebook' => 'mock_facebook_' . $id,
            'x' => 'mock_x_' . $id,
            'tiktok' => 'mock_tiktok_' . $id,
            'official_certification' => rand(0, 1),
            'last_login_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),
            'email_verified_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),

            // contents

            'myQuests' => [
                [
                    'title' => 'Okayama trip',
                    'description' => 'Sunset in the old castle town',
                    'image' => asset('images/okayama.jpg'),
                    'date' => '2025/2/20',
                    'likes' => 1333,
                    'comments' => 88
                ],
                [
                    'title' => 'Kyoto trip',
                    'description' => 'Kinkakuji and garden',
                    'image' => asset('images/kyoto.jpg'),
                    'date' => '2025/2/20',
                    'likes' => 1220,
                    'comments' => 80
                ]
            ],
            'mySpots' => [
                [
                    'title' => 'Historical Theater',
                    'description' => 'Inside a cultural landmark.',
                    'image' => asset('images/theater.jpg'),
                    'date' => '2025/2/20',
                    'likes' => 1050,
                    'comments' => 50
                ]
            ],

            'likedQuests' => [
                [
                    'title' => 'Hot Springs in Hakone',
                    'description' => 'Relax and refresh!',
                    'image' => asset('images/hakone.jpg'),
                ],
                [
                    'title' => 'Osaka Street Food',
                    'description' => 'Takoyaki and more!',
                    'image' => asset('images/osaka_food.jpg'),
                ]
            ],
            'likedSpots' => [
                [
                    'title' => 'Mount Fuji Viewpoint',
                    'description' => 'Unforgettable sunrise.',
                    'image' => asset('images/mt_fuji.jpg'),
                ]
            ],
            'likedBusinesses' => [
                [
                    'title' => 'Kyoto Sweets Café',
                    'description' => 'Traditional Japanese desserts.',
                    'image' => asset('images/kyoto_sweets.jpg'),
                ]
            ],
            'followers' => [
                ['name' => 'Follower A', 'avatar' => asset('images/avatar1.png')],
                ['name' => 'Follower B', 'avatar' => asset('images/avatar2.png')],
            ],
            'following' => [
                ['name' => 'Following A', 'avatar' => asset('images/avatar3.png')],
                ['name' => 'Following B', 'avatar' => asset('images/avatar4.png')],
            ],
            'comments' => [
                [
                    'title' => 'Beautiful!',
                    'text' => 'I’ve been there too, and it was amazing!',
                    'created_at' => '2024/10/10',
                    'likes' => 3,
                ]
            ],
            'reviews' => [
                [
                    'title' => 'Sakura Café',
                    'rating' => 5,
                    'text' => 'Incredible view with great food.',
                    'created_at' => '2024/09/15',
                    'likes' => 12,
                ]
            ]
        ];
    }
}
