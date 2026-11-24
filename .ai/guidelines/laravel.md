This is a demo project for a web development basics course. 
Don't do any advanced stuff out of the box
Keep foreign keys in tables pure, no ->cascase etc stuff

## Commits

Never commit without the explicit agreement of the user. Do not commit automatically at the end of a task, and do not assume that a finished change should be committed. Always ask first and wait for a clear yes.

Use a single line commit message in this format:

```
TYPE :emoji: Description
```

- Write the type in uppercase, followed by a space, a colon, a space, the emoji, a space, and the description.
- Do not add a body, bullet points, or a "Co-authored-by" trailer.
- Write the description in sentence case, starting with a capital letter and describing the change in the present tense.
- Keep the description short and specific.

Types and emoji used in this project:

| Type | Emoji | Use for |
| --- | --- | --- |
| INIT | :seedling: | The initial commit |
| FEATURE | :sparkles: | New functionality |
| BUGFIX | :bug: | Fixing incorrect behavior |
| REFACTOR | :hammer: | Restructuring code without changing behavior |
| DESIGN | :art: | Styling and layout changes |
| CONTENT | :pencil: | Content and documentation changes |

Examples from this project:

```
FEATURE :sparkles: Add CRUD for Article
BUGFIX :bug: Fix naming mistake
REFACTOR :hammer: Switch to resourceful routes
DESIGN :art: Update the app layout
CONTENT :pencil: Add project specific rules
```

Only stage files that belong to the change being committed. Leave unrelated modified or untracked files out of the commit.

## Tests

This is a teaching project. Keep the test suite small and focused on what a visitor sees.

### Coverage

- Every public GET route gets a status-only smoke test. Name the file `AAPublicRoutesSmokeTest.php` so it runs first.
- Public pages get content tests, but only for information unique to that page.
- A reused or distinct page block (article lists, author lists, comment list) gets one dedicated test. Do not assert that block again on every page that renders it.
- The header and footer are layout, not content. Do not add separate tests for them. Their links are covered by the public route smoke tests.
- Comment visibility is public content: test the guest view, the comment author's own pending view, and the article author's moderator view. Do not add more role variants.
- The userzone is smoke-tested: status 200 for an allowed user and a redirect for a guest. Do not test CRUD behavior there.
- The existing Auth test folder is kept as is. It is the only exception to the rules below.
- Media library tests only assert that the default image is used when no media is attached. Do not test uploads, conversions or generated URLs.
- There is no separate Unit suite. Model checks that need the database live in Feature.

### Not covered

- Notifications and mail rendering.
- Validation rules, error messages and redirect targets.
- Authorization edge cases and 403 responses, except where the page is admin-only.
- CRUD side effects: create, update, delete, sync and media attachments.
- HTML escaping and XSS.
- 404 behavior for missing or empty detail pages.
- Exact copy, CSS classes, layout details and element order that is not the point of the test.
- A second variant of a behavior that is already covered.

### Writing

- One behavior per test. The test name states the behavior.
- Use factories. Set `admin()` or `nonAdmin()` explicitly. Never depend on the random admin state of `User::factory()`.
- Use unique titles and names. Do not assert generic words that also appear in the header or footer.
- Use `assertOk` for status, `assertSee` and `assertSeeInOrder` for content, and `assertDontSee` for exclusions.
- Before adding a test, check whether the existing suite already covers it. Prefer deleting or tightening an existing test over adding a new one.
