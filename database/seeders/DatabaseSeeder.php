<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            // Paste the output from step 1.1 here as raw array
            [
                "opponent" => "Ottawa Rapid FC",
      "location" => "Centre sportif Bois-de-Boulogne",
      "game_date" => "2025-05-03",
      "kickoff_time" => "13:30",
      "created_at" => Illuminate\Support\Carbon @1742859868 {#6253
        date: 2025-03-24 23:44:28.0 UTC (+00:00),
      },
      "updated_at" => Illuminate\Support\Carbon @1743557883 {#6254
        date: 2025-04-02 01:38:03.0 UTC (+00:00),
      },
      "reservation_type" => "Home opener! Be the first to go to a Roses home game with me.",

            ],
            // etc...
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
