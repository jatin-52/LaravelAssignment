<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\ScoreBoardUser;

class ScoreBoardUserTest extends TestCase
{
    use WithFaker;

    /**
     * Test to check if user score is being added.
     *
     * @return void
     */
    public function testScoreBoardUserPointAddingAndSubtracting()
    {
        $latestUser = ScoreBoardUser::latest('created_at')->first();
        $id = $latestUser->id;
        // adding check
        $scoreBoardUser = ScoreBoardUser::where([
            'id' => $id
        ])->first();
        $old_points = $scoreBoardUser->points;
        
        $response = $this->put('/api/score-board-user/updateUserPoint', [
            'id'     => $id,
            'isPlus' => 1
        ]);
        
        $scoreBoardUser = ScoreBoardUser::where([
            'id' => $id
        ])->first();
        $pointAfterAdding = $scoreBoardUser->points;
        
        $response->assertStatus(200);
        $this->assertEquals( $old_points+1, $pointAfterAdding );

        // subtracting check
        $response2 = $this->put('/api/score-board-user/updateUserPoint', [
            'id'     => $id,
            'isPlus' => 0
        ]);
        $scoreBoardUser = ScoreBoardUser::where([
            'id' => $id
        ])->first();
        $pointAfterDeleting = $scoreBoardUser->points;
        $response2->assertStatus(200);
        $this->assertEquals( $old_points, $pointAfterDeleting );
    }

    // Helper function
    private function AddScoreValidationCheck($response) {
        $response->assertStatus(200);
        $response->assertJson(function($json) {
            $json->whereType('error.name', 'array')
                ->whereType('error.age', 'array')
                ->whereType('error.address', 'array');
        });
    }

    public function testAddScoreBoardUserValidations() {
        $response = $this->post('/api/score-board-user/store', []);
        $this->AddScoreValidationCheck($response);

        $response = $this->post('/api/score-board-user/store', [
            'name'    => '',
            'age'     => '',
            'address' => ''
        ]);
        $this->AddScoreValidationCheck($response);

        $response = $this->post('/api/score-board-user/store', [
            'name'    => '',
            'age'     => 0,
            'address' => ''
        ]);
        $this->AddScoreValidationCheck($response);
    }

    public function testAddScoreBoardUser() {
        $random_name = $this->faker->name;
        $random_address = $this->faker->address;
        $response = $this->post('/api/score-board-user/store', [
            'name'    => $random_name,
            'age'     => 20,
            'address' => $random_address
        ]);

        $response->assertStatus(200);

        $latestUser = ScoreBoardUser::latest('created_at')->first();
        // dd($latestUser->toArray());
        $this->assertEquals( $random_name, $latestUser->name );
        $this->assetEquals( $random_address, $latestUser->name );
        $response->assertJsonPath('scoreBoardUserId', $latestUser->id);
        $this->assertEquals( 0, $latestUser->points );
    }

    public function testDeleteScoreBoardUser()
    {
        $response = $this->delete('/api/score-board-user/destroy/7');
        $response->assertStatus(200);
    }

}
