<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\User;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        // Get the currently authenticated user with post relationships
        $user = User::with([
            'quests' => function ($query) {
                $query->withCount(['questLikes', 'questComments'])->with('pageViews');
            },
            'spots' => function ($query) {
                $query->withCount(['spotLikes', 'spotComments'])->with('pageViews');
            }
        ])->findOrFail(Auth::id());
        // Flag indicating this is the user's own profile
        $isOwnProfile = true;
        // Set temporary aliases for frontend blade compatibility
        $user->myQuests = $user->quests;
        $user->mySpots = $user->spots;
        return view('tourists.profiles.myprofile', compact('user', 'tab', 'isOwnProfile'));
    }
    // Show the edit profile form with the user's current data
    public function edit()
    {
        $user = Auth::user(); // Retrieve current user from database
        return view('tourists.profiles.myprofile_edit', compact('user'));
    }
    public function update(Request $request, $id = null)
    {
        \Log::info(':チェックマーク_緑: update() method called');
        try {
            $targetUserId = $id ?? Auth::id();
            if (Auth::id() !== (int) $targetUserId) {
                \Log::warning(":通行止め: Unauthorized update attempt by user ID " . Auth::id());
                abort(403, 'Unauthorized access.');
            }
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . $targetUserId,
                'introduction' => 'nullable|max:500',
                'instagram' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'x' => 'nullable|string|max:255',
                'tiktok' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'header' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = User::findOrFail($targetUserId);
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $validated['avatar'] = 'data:image/' . $avatar->extension() . ';base64,' . base64_encode(file_get_contents($avatar));
            }
            if ($request->hasFile('header')) {
                $header = $request->file('header');
                $validated['header'] = 'data:image/' . $header->extension() . ';base64,' . base64_encode(file_get_contents($header));
            }

            $user->save(); // Save everything

            \Log::info("✅ Profile updated for user ID: {$user->id}");

            return redirect()->route('profile.header', ['id' => $user->id])
                ->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            \Log::error(":x: Failed to update profile: " . $e->getMessage());
            return redirect()->route('profile.header', ['id' => Auth::id()])
                ->with('error', 'Failed to update profile.');
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
        if ($user) {
            $user->delete();
            Auth::logout();
            return redirect()->route('home')->with('status', 'Your account has been deleted.');
        }
        return redirect()->route('login')->with('error', 'User not found.');
    }
    public function showOtherProfile($id)
    {
        // Retrieve user with quests and spots, including likes count and views relationship
        $user = User::findOrFail($id);
        // Determine if this profile belongs to the authenticated user
        $isOwnProfile = Auth::check() && Auth::id() === $user->id;
        // Temporary aliases for frontend compatibility
        $user->myQuests = $user->quests;
        $user->mySpots = $user->spots;
        $quests = Quest::with('pageViews')
            ->where('user_id', Auth::id())
            ->get();
        $spots = Spot::with('pageViews')
            ->where('user_id', Auth::id())
            ->get();
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
    //         'introduction' => ':地球_アジア: Just a mock traveler exploring the world!',
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
