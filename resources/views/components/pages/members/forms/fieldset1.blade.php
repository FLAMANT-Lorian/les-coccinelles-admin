<fieldset class="col-span-full lg:col-span-2 items-center lg:border-none!">
    <legend class="">{{ __('pages/members.profile-picture') }}</legend>
    <div class="w-30 h-30 bg-gray rounded-full mb-2">
        @if($this->form->avatar)
            <img src="{{ $this->form->avatar->temporaryUrl() }}"
                 alt="{{ __('pages/members.avatar') }}"
                 class="w-full h-full object-cover rounded-full">
        @elseif(!is_null($this->form->member) && !is_null($this->form->member->avatar_path) && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') .  $this->form->member->avatar_path))
            <img
                src="{{ Storage::disk(config('filesystems.default'))->url(config('avatar.original_path') .  $this->form->member->avatar_path) }}"
                alt="{{ __('pages/members.avatar') }}"
                class="w-full h-full object-cover rounded-full">
        @else
            <img src="{{ Storage::disk(config('filesystems.default'))->url('img/jpg/no-avatar.jpg') }}"
                 alt="{{ __('pages/members.no-avatar') }}"
                 class="w-full h-full object-cover rounded-full">
        @endif
    </div>
    <div class="flex flex-col gap-4">
        <input wire:model="form.avatar"
               class="sr-only peer"
               type="file"
               id="profile-picture"
               name="avatar" accept="image/png, image/jpeg, image/jpg, image/webp">
        <label for="profile-picture"
               class="text-center cursor-pointer py-3 px-4 rounded-sm border border-brown bg-brown peer-focus:bg-transparent peer-focus:text-brown text-white hover:bg-transparent hover:text-brown trans-all">
            @if($this->form->avatar || (!is_null($this->form->member) && !is_null($this->form->member->avatar_path) && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') .  $this->form->member->avatar_path)))
                {{ __('pages/members.change-avatar') }}
            @else
                {{ __('pages/members.add-avatar') }}
            @endif
        </label>
        @if($this->form->avatar || (!is_null($this->form->member) && !is_null($this->form->member->avatar_path) && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') .  $this->form->member->avatar_path)))
            <button type="button"
                    class="btn-delete"
                    wire:click="$dispatch('remove-avatar')">
                {{ __('pages/members.remove-avatar') }}
            </button>
        @endif
    </div>
</fieldset>
