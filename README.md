# Pitisha ~ Laravel approval package

#### Installation

   $user = app('App\User')->find(1);

        $hotel = app('App\Models\Hotel')->create([
            'name' => 'demo guy',
            'slogan' => 'this is it',
            'email' => 'marv@d'.time().'d.com',
            'phone_no' => '0704407117',
            'street' => 'langata',
            'photo' => '/dejje',
            'slug' => 'dmeo-dmeo',
            'user_id' => $user->id,
            'activated' => true
        ]);

        $result = $review->fill(array_merge([
            'title' => 'demo',
            'review' => 'demo fuck review demo guy this it demro marvin',
            'approved' => 1,
            'hotel_id' => 1,
            'rating' => 7,
        ],[
            'reviewer_id' => $user->id,
            'reviewer_type' => get_class($user)
        ]));

        $hotel->reviews()->save($result);