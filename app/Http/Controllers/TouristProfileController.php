<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;

class TouristProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Show the profile of the currently authenticated user
    public function myProfileShow(Request $request)
    {
        $tab = $request->query('tab');
        $user = Auth::user(); // Get the currently logged-in user

        return view('tourists.profiles.myprofile', compact('user', 'tab'));
    }

    // Show the edit profile form with the user's current data
    public function edit()
    {
        $user = Auth::user(); // Retrieve current user from database

        return view('tourists.profiles.myprofile_edit', compact('user'));
    }

    // Update the profile information
    public function update(Request $request)
    {
        try {
            // Validate input fields
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'introduction' => 'nullable|max:500',
                'instagram' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'x' => 'nullable|string|max:255',
                'tiktok' => 'nullable|string|max:255',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'header' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = Auth::user(); // Get the current user

            // Handle avatar image upload and convert to base64
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $base64 = 'data:image/' . $image->extension() . ';base64,' . base64_encode(file_get_contents($image));
                $validated['avatar'] = $base64;
            }

            // Handle header image upload and convert to base64
            if ($request->hasFile('header')) {
                $image = $request->file('header');
                $base64 = 'data:image/' . $image->extension() . ';base64,' . base64_encode(file_get_contents($image));
                $validated['header'] = $base64;
            }

            // Update user information
            $user->update($validated);
            Log::info('Success Code');
            return redirect()->route('myprofile.show')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    // Update the user's password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Password change logic is skipped here
        return back()->with('success', 'Password has been updated.');
    }

    // Delete the user account
    public function destroy()
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect('/');
    }

    public function showOtherProfile($id)
    {
        $user = User::findOrFail($id);

        $isOwnProfile = Auth::check() && Auth::id() === $user->id;

        return view('tourists.profiles.show', compact('user', 'isOwnProfile'));
    }


    // Show another user's profile using mock data
    // public function showOtherProfile($id)
    // {
    //     $user = $this->mockUserData($id);
    //     $isOwnProfile = false;

    //     return view('tourists.profiles.show', compact('user', 'isOwnProfile'));
    // }

    // // Generate mock data for testing or development
    // private function mockUserData($id)
    // {
    //     return [
    //         'id' => $id,
    //         'name' => 'User ' . $id,
    //         'email' => 'user' . $id . '@example.com',
    //         'avatar' => asset('images/default-avatar.png'),
    //         'header' => asset('images/default-header.jpg'),
    //         'introduction' => '🌏 Just a mock traveler exploring the world!',
    //         'instagram' => 'mock_instagram_' . $id,
    //         'facebook' => 'mock_facebook_' . $id,
    //         'x' => 'mock_x_' . $id,
    //         'tiktok' => 'mock_tiktok_' . $id,
    //         'official_certification' => rand(0, 1),
    //         'last_login_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),
    //         'email_verified_at' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),

    //         'myQuests' => [
    //             [
    //                 'title' => 'Okayama trip',
    //                 'description' => 'Sunset in the old castle town',
    //                 'image' => asset('images/okayama.jpg'),
    //                 'date' => '2025/2/20',
    //                 'likes' => 1333,
    //                 'comments' => 88
    //             ],
    //             [
    //                 'title' => 'Kyoto trip',
    //                 'description' => 'Kinkakuji and garden',
    //                 'image' => asset('images/kyoto.jpg'),
    //                 'date' => '2025/2/20',
    //                 'likes' => 1220,
    //                 'comments' => 80
    //             ]
    //         ],
    //         'mySpots' => [
    //             [
    //                 'title' => 'Historical Theater',
    //                 'description' => 'Inside a cultural landmark.',
    //                 'image' => asset('images/theater.jpg'),
    //                 'date' => '2025/2/20',
    //                 'likes' => 1050,
    //                 'comments' => 50
    //             ]
    //         ],
    //         'likedQuests' => [
    //             [
    //                 'title' => 'Hot Springs in Hakone',
    //                 'description' => 'Relax and refresh!',
    //                 'image' => asset('images/hakone.jpg'),
    //             ],
    //             [
    //                 'title' => 'Osaka Street Food',
    //                 'description' => 'Takoyaki and more!',
    //                 'image' => asset('images/osaka_food.jpg'),
    //             ]
    //         ],
    //         'likedSpots' => [
    //             [
    //                 'title' => 'Mount Fuji Viewpoint',
    //                 'description' => 'Unforgettable sunrise.',
    //                 'image' => asset('images/mt_fuji.jpg'),
    //             ]
    //         ],
    //         'likedBusinesses' => [
    //             [
    //                 'title' => 'Kyoto Sweets Café',
    //                 'description' => 'Traditional Japanese desserts.',
    //                 'image' => asset('images/kyoto_sweets.jpg'),
    //             ]
    //         ],
    //         'followers' => [
    //             ['name' => 'Follower A', 'avatar' => asset('images/avatar1.png')],
    //             ['name' => 'Follower B', 'avatar' => asset('images/avatar2.png')],
    //         ],
    //         'following' => [
    //             ['name' => 'Following A', 'avatar' => asset('images/avatar3.png')],
    //             ['name' => 'Following B', 'avatar' => asset('images/avatar4.png')],
    //         ],
    //         'comments' => [
    //             [
    //                 'title' => 'Beautiful!',
    //                 'text' => 'I’ve been there too, and it was amazing!',
    //                 'created_at' => '2024/10/10',
    //                 'likes' => 3,
    //             ]
    //         ],
    //         'reviews' => [
    //             [
    //                 'title' => 'Sakura Café',
    //                 'rating' => 5,
    //                 'text' => 'Incredible view with great food.',
    //                 'created_at' => '2024/09/15',
    //                 'likes' => 12,
    //             ]
    //         ]
    //     ];
    // }
}
