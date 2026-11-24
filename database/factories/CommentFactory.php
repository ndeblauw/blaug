<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Real English comments for the seeded articles.
     *
     * @var list<string>
     */
    private const COMMENTS = [
        'Thanks for writing this. The section on migrations finally made it click for me.',
        'I ran into the same problem last week. Your solution is much cleaner than mine.',
        'Good reminder that small changes are easier to review. I am going to try this on my next feature.',
        'Could you explain a little more about how the cache is cleared when an article is updated?',
        'This is exactly the kind of practical advice I was looking for.',
        'I had never thought about error messages as part of the interface. That is a great point.',
        'The part about naming things well is underrated. It saves so much time later.',
        'I tried this approach today and it worked perfectly. Thank you for sharing it.',
        'Do you have any tips for writing tests when the feature is still changing?',
        'Nice article. I would love to read a follow-up about queues and background jobs.',
        'The example with the old controller feels very familiar. Refactoring gets easier with practice.',
        'I appreciate that you kept the examples simple. It makes the ideas easier to apply.',
        'One small addition: remember to add an index if you filter on that column often.',
        'This helped me understand the request lifecycle without getting lost in the details.',
        'I disagree slightly about the prototype, but your point about learning from it is fair.',
        'Great write-up. I have already shared it with a junior developer on our team.',
        'The caching trade-off is something I keep forgetting. Thanks for the reminder.',
        'Clear explanation and a realistic example. More articles like this, please.',
        'I had to read the section on relationships twice, but now it makes sense.',
        'This is a useful checklist for reviewing my own pull requests before asking someone else.',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->randomElement(self::COMMENTS),
            'article_id' => $this->faker->numberBetween(1, 15),
            'user_id' => $this->faker->numberBetween(1, 15),
            'approved_at' => now(),
        ];
    }

    public function unapproved(): static
    {
        return $this->state(fn (array $attributes) => [
            'approved_at' => null,
        ]);
    }
}
