<?php

use App\Models\Folder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Event;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

describe('EVENTS WITH PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
    });

    it('can update an event', function () {
        $permission = Permission::create([
            'name' => 'events.edit',
            'guard_name' => 'web'
        ]);

        $this->role->givePermissionTo($permission);

        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('form.event', $event)
            ->set('form.name', 'Événement')
            ->set('form.start_date', Carbon::now())
            ->set('form.end_date', Carbon::now())
            ->set('form.address', 'Chez moi')
            ->set('form.description', 'Description')
            ->call('update')
            ->assertOk();

        assertDatabaseHas('events', [
            'name' => 'Événement',
            'address' => 'Chez moi',
            'description' => 'Description',
        ]);
    });

    it('can add a folder with files to an event', function () {
        // PART 1
        $permission = Permission::create([
            'name' => 'folders.create',
            'guard_name' => 'web'
        ]);

        $this->role->givePermissionTo($permission);

        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('foldersForm.name', 'Événement')
            ->set('foldersForm.color', '#000')
            ->call('saveFolder', $event)
            ->assertOk();

        assertDatabaseCount('folders', 1);

        expect($event->folders()->count())->toBe(1);

        // PART 2
        Storage::fake();

        $permission = Permission::create([
            'name' => 'files.add',
            'guard_name' => 'web'
        ]);

        $this->role->givePermissionTo($permission);

        $image = TemporaryUploadedFile::fake()->image('test.png');

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('folder', $event->folders()->first())
            ->set('files', [$image])
            ->assertOk();

        assertDatabaseCount('files', 1);

        expect($event->folders()->first()->files->count())->toBe(1);
    });

    it('can add a task to an event', function () {
        $permission = Permission::create([
            'name' => 'tasks.create',
            'guard_name' => 'web'
        ]);

        $this->role->givePermissionTo($permission);

        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('tasksForm.name', 'Événement')
            ->set('tasksForm.assignee', auth()->user()->id)
            ->call('saveTask', $event)
            ->assertOk();

        assertDatabaseCount('tasks', 1);

        expect($event->tasks()->count())->toBe(1);
    });

    it('can delete an event with his folders, files and tasks', function () {
        $permission = Permission::create([
            'name' => 'events.delete',
            'guard_name' => 'web'
        ]);

        $this->role->givePermissionTo($permission);

        $event = Event::factory()->create();

        $folder = Folder::factory()
            ->for($event)
            ->create();

        $file = File::create([
            'name' => 'test.pjg',
            'path' => uniqid(),
            'folder_id' => $folder->id
        ]);

        $task = Task::factory()
            ->for($event)
            ->assignedTo(auth()->user())
            ->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->call('deleteEvent', $event->id)
            ->assertRedirect();

        assertDatabaseCount('files', 0);
        assertDatabaseCount('folders', 0);
        assertDatabaseCount('tasks', 0);
        assertDatabaseCount('events', 0);
    });
});

describe('EVENTS WITHOUT PERMISSIONS', function () {
    beforeEach(function () {
        $this->role = Role::create([
            'name' => 'Test',
            'guard_name' => 'web',
            'unique' => 1
        ]);

        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
    });

    it('can’t update an event', function () {
        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('form.event', $event)
            ->set('form.name', 'Événement')
            ->set('form.start_date', Carbon::now())
            ->set('form.end_date', Carbon::now())
            ->set('form.address', 'Chez moi')
            ->set('form.description', 'Description')
            ->call('update')
            ->assertForbidden();

        assertDatabaseHas('events', [
            'name' => $event->name,
            'address' => $event->address,
            'description' => $event->description,
        ]);
    });

    it('can’t add a folder with files to an event', function () {
        // PART 1
        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('foldersForm.name', 'Événement')
            ->set('foldersForm.color', '#000')
            ->call('saveFolder', $event)
            ->assertForbidden();

        assertDatabaseCount('folders', 0);

        expect($event->folders()->count())->toBe(0);

        // PART 2
        Storage::fake();

        $image = TemporaryUploadedFile::fake()->image('test.png');

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('folder', $event->folders()->first())
            ->set('files', [$image])
            ->assertForbidden();

        assertDatabaseCount('files', 0);
    });

    it('can’t add a task to an event', function () {
        $event = Event::factory()->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->set('tasksForm.name', 'Événement')
            ->set('tasksForm.assignee', auth()->user()->id)
            ->call('saveTask', $event)
            ->assertForbidden();

        assertDatabaseCount('tasks', 0);

        expect($event->tasks()->count())->toBe(0);
    });

    it('can’t delete an event with his folders, files and tasks', function () {
        $event = Event::factory()->create();

        $folder = Folder::factory()
            ->for($event)
            ->create();

        $file = File::create([
            'name' => 'test.pjg',
            'path' => uniqid(),
            'folder_id' => $folder->id
        ]);

        $task = Task::factory()
            ->for($event)
            ->assignedTo(auth()->user())
            ->create();

        Livewire::test('pages::events.show', ['event' => $event])
            ->call('deleteEvent', $event->id)
            ->assertForbidden();

        assertDatabaseCount('files', 1);
        assertDatabaseCount('folders', 1);
        assertDatabaseCount('tasks', 1);
        assertDatabaseCount('events', 1);
    });
});
