<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Real English titles for the seeded articles.
     *
     * @var list<string>
     */
    private const TITLES = [
        'Building Better Forms with Plain HTML',
        'Why Small Commits Make Better Code Reviews',
        'A Practical Introduction to Laravel Migrations',
        'Understanding the Request Lifecycle in Laravel',
        'Five Habits of Readable PHP Code',
        'Getting Started with Eloquent Relationships',
        'How Caching Can Make Your Application Faster',
        'Writing Tests That You Will Actually Maintain',
        "A Beginner's Guide to Route Model Binding",
        'Making Sense of HTTP Status Codes',
        'The Quiet Power of Naming Things Well',
        'From Prototype to Production in Small Steps',
        'What I Learned From Refactoring an Old Controller',
        'Designing Database Tables That Age Well',
        'A Short Tour of Blade Components',
        'Debugging Is a Skill You Can Practice',
        'Why Your First Draft of a Feature Should Be Boring',
        'Improving Accessibility Without Rewriting Everything',
        'Understanding Sessions and Cookies in Laravel',
        'How to Review Your Own Pull Requests',
        'Keeping Frontend Builds Simple',
        'An Introduction to Queues for Background Work',
        'The Case for Boring Technology',
        'Making Time for Documentation',
        'What Makes a Good Error Message',
    ];

    /**
     * Real English paragraphs used to compose the article content.
     *
     * @var list<string>
     */
    private const PARAGRAPHS = [
        'Most applications grow one small decision at a time. A form gets an extra field, a query gains a condition, and before long the code no longer matches the idea you had in your head. Regular refactoring keeps that gap from becoming permanent.',
        'The best place to start is often the simplest one: read the code out loud and notice where you hesitate. Confusing names, hidden side effects, and long methods usually reveal themselves before any tool has to tell you.',
        'Good code is written for the person who will read it six months from now. That person may be a colleague, and it may be you. Choosing clear names and keeping functions small is a kindness to both of you.',
        'When a feature feels difficult to build, the problem is often in the shape of the data. Spend some time on the tables and relationships first. The controllers and views tend to become simpler once the model makes sense.',
        'A database migration is a description of change. It says what the schema should look like after the migration runs, not how to squeeze the data into place. Keeping migrations small makes them easier to review and safer to roll back.',
        'Tests are most valuable when they describe behaviour rather than implementation. A test that checks what a user can do will survive a refactor. A test that checks how a method is written will need to be rewritten every time the method changes.',
        'Caching is a trade between speed and freshness. Before adding a cache, decide what it means for a value to be out of date and who is allowed to see it. A clear answer to those questions prevents most caching bugs.',
        'Error messages are part of the user interface. A message should explain what happened, why it happened, and what the person can do next. When that is impossible, it should at least give them a way to get help.',
        'A pull request is easier to review when it tells a story. Keep each change focused on one idea, write a short description, and point the reviewer to the interesting parts. Reviewers are generous with their time, but they cannot guess your intentions.',
        'Accessibility is not a separate project you do at the end. It starts with sensible headings, labelled inputs, and enough contrast to read comfortably. These are small choices, and they make the page better for everyone.',
        'Queues are useful for work that does not need to finish before the response is sent. Sending an email, resizing an image, or calling another service are good candidates. Keep the job small, and make it safe to run more than once.',
        'The request lifecycle can feel like magic until you follow a single request from the route to the response. Once you know where middleware, controllers, and views fit, debugging becomes much less mysterious.',
        'Every application has a few pieces of boring technology holding it together. A plain database, a well-known framework, and a simple queue will outlast many exciting alternatives. Boring is not the same as careless.',
        'Documentation does not have to be a manual. A short note explaining why a decision was made can save hours of guessing. Write it while the reason is still fresh in your mind.',
        'When a page is slow, measure before you change anything. Reach for the query log and the profiler, not your intuition. The slowest part is often somewhere you did not expect.',
        'Forms deserve more attention than they usually get. Clear labels, useful validation messages, and a sensible tab order turn a frustrating task into a forgettable one. Forgettable is exactly what a good form should be.',
        'A prototype is allowed to be ugly. Its job is to answer a question as quickly as possible. Once the question is answered, throw the prototype away and build the real thing with the lessons you learned.',
        'HTTP status codes are a shared language between your application and its clients. Use 404 when something is missing, 422 when the input is invalid, and 500 when the failure is on your side. Consistency makes integrations easier to build.',
        'Refactoring is not rewriting. It is a series of small, safe steps that leave the behaviour unchanged. Run the tests after each step, and stop when the code is clear enough for the next person.',
        'An old controller is a useful teacher. It shows you which requirements changed, which shortcuts were taken, and which parts nobody dared to touch. Read it with curiosity instead of blame.',
        'Frontend builds should be as simple as the project allows. Add a bundler when you need one, not because every tutorial starts with one. Fewer moving parts mean fewer surprises on a Friday afternoon.',
        'The first version of a feature should be the smallest one that works. Ship it, watch how people use it, and let the real feedback shape the next version. Guessing in advance is expensive.',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(self::TITLES),
            'slug' => $this->faker->slug,
            'content' => collect($this->faker->randomElements(self::PARAGRAPHS, $this->faker->numberBetween(4, 6)))
                ->implode("\n\n"),
            'author_id' => $this->faker->numberBetween(1, 5),
            'publish_date' => $this->faker->dateTimeBetween('-4 weeks', 'now'),
        ];
    }
}
