<?php

use Filament\Facades\Filament;
use Filament\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Support\Facades\Queue;
use Stichoza\GoogleTranslate\GoogleTranslate;
use TomatoPHP\FilamentTranslations\Facade\FilamentTranslations;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\Pages\ManageTranslations;
use TomatoPHP\FilamentTranslations\FilamentTranslationsServiceProvider;
use TomatoPHP\FilamentTranslationsGoogle\Jobs\ScanWithGoogleTranslate;
use TomatoPHP\FilamentTranslationsGoogle\Tests\FakeGoogleTranslate;
use TomatoPHP\FilamentTranslationsGoogle\Tests\Models\Translation;
use TomatoPHP\FilamentTranslationsGoogle\Tests\Models\User;
use TomatoPHP\FilamentTranslationsGoogle\Tests\Policies\ReadOnlyTranslationPolicy;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\artisan;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);

    $this->translator = new FakeGoogleTranslate;
    app()->instance(GoogleTranslate::class, $this->translator);
});

it('translates every translation into the target locale and keeps the other locales', function () {
    NotificationFacade::fake();

    $greeting = Translation::factory()->create(['text' => ['en' => 'Hello :name', 'fr' => 'Bonjour :name']]);
    $keyOnly = Translation::factory()->create(['key' => 'welcome', 'text' => []]);

    (new ScanWithGoogleTranslate($this->user, 'ar'))->handle();

    expect($greeting->refresh()->text)->toMatchArray([
        'en' => 'Hello :name',
        'fr' => 'Bonjour :name',
        'ar' => '[ar] Hello :name',
    ])
        ->and($keyOnly->refresh()->text['ar'])->toBe('[ar] welcome')
        ->and($this->translator->translated)->toBe(['Hello :name', 'welcome']);

    NotificationFacade::assertSentTo($this->user, DatabaseNotification::class);
});

it('uses the translator bound in the container', function () {
    NotificationFacade::fake();
    Translation::factory()->create(['text' => ['en' => 'Hello']]);

    (new ScanWithGoogleTranslate($this->user, 'fr'))->handle();

    expect($this->translator->translated)->toBe(['Hello']);
});

it('queues the Google scan for the chosen language from the translations page', function () {
    Queue::fake();

    livewire(ManageTranslations::class)
        ->callAction('google', data: ['language' => 'ar'])
        ->assertHasNoActionErrors();

    Queue::assertPushed(
        ScanWithGoogleTranslate::class,
        fn (ScanWithGoogleTranslate $job) => $job->language === 'ar' && $job->user->is($this->user),
    );
});

it('requires a language', function () {
    Queue::fake();

    livewire(ManageTranslations::class)
        ->callAction('google', data: ['language' => null])
        ->assertHasActionErrors(['language' => 'required']);

    Queue::assertNothingPushed();
});

it('hides the Google action when the policy does not allow creating translations', function () {
    config()->set('filament-translations.policy', ReadOnlyTranslationPolicy::class);
    app()->getProvider(FilamentTranslationsServiceProvider::class)->boot();

    livewire(ManageTranslations::class)->assertActionHidden('google');
});

it('shows the Google action without a policy', function () {
    livewire(ManageTranslations::class)->assertActionVisible('google');
});

it('registers the Google action once when the plugin boots on every request (Octane)', function () {
    $panel = Filament::getPanel('admin');

    foreach (range(1, 3) as $ignored) {
        $panel->getPlugin('filament-translations-google')->boot($panel);
    }

    $names = collect(FilamentTranslations::getActions(ManageTranslations::class))->map(fn ($action) => $action->getName());

    expect($names->filter(fn ($name) => $name === 'google'))->toHaveCount(1);
});

it('runs the install command', function () {
    artisan('filament-translations-google:install')->assertSuccessful();
});
