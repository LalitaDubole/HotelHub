<?php
namespace Database\Seeders;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'name'            => 'Deluxe Ocean View',
                'type'            => 'Deluxe',
                'description'     => 'Stunning ocean views with king-size bed and premium amenities.',
                'price_per_night' => 4999.00,
                'capacity'        => 2,
                'status'          => 'available',
                'image'           => 'images/room1.jpg',
                'amenities'       => ['WiFi', 'AC', 'Mini Bar', 'Ocean View'],
            ],
            [
                'name'            => 'Presidential Suite',
                'type'            => 'Suite',
                'description'     => 'Luxurious suite with private balcony and butler service.',
                'price_per_night' => 12999.00,
                'capacity'        => 4,
                'status'          => 'available',
                'image'           => 'images/room2.jpg',
                'amenities'       => ['WiFi', 'AC', 'Jacuzzi', 'Butler', 'Balcony'],
            ],
            [
                'name'            => 'Standard Twin Room',
                'type'            => 'Standard',
                'description'     => 'Comfortable twin room perfect for business travelers.',
                'price_per_night' => 1999.00,
                'capacity'        => 2,
                'status'          => 'available',
                'image'           => 'images/room3.jpg',
                'amenities'       => ['WiFi', 'AC', 'TV'],
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}