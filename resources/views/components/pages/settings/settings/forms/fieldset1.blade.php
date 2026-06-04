<fieldset class="col-span-full lg:col-span-2 items-center lg:border-none!">
    <legend class="">{{ __('pages/members.profile-picture') }}</legend>
    <div class="w-30 h-30 bg-beige-medium rounded-full mb-2">
        @if($this->form->avatar)
            <img src="{{ $this->form->avatar->temporaryUrl() }}"
                 alt="{{ __('pages/members.avatar') }}"
                 class="w-full h-full object-cover rounded-full">
        @elseif($this->form->user && $this->form->user->avatar_path && Storage::disk(config('filesystems.default'))->exists(sprintf(config('avatar.variant_path'), config('avatar.sizes.256.width'), config('avatar.sizes.256.height')) . '/' . $this->form->user->avatar_path))
            <img alt="{{ __('pages/users.avatar') }}"
                 src="{{ Storage::disk(config('filesystems.default'))->url(sprintf(config('avatar.variant_path'), config('avatar.sizes.256.width'), config('avatar.sizes.256.height')) . '/' . $this->form->user->avatar_path) }}"
                 class="w-full h-full object-cover rounded-full">
        @elseif($this->form->user && $this->form->user->avatar_path && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') . '/' . $this->form->user->avatar_path))
            <div class="w-full h-full relative border border-beige-dark rounded-full">
                <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animate-spin"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1"
                     stroke-linecap="round">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                </svg>
            </div>
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
               name="avatar" accept="image/png, image/jpg, image/webp">
        <label for="profile-picture"
               class="text-center cursor-pointer py-3 px-4 rounded-sm border border-brown bg-brown peer-focus:bg-transparent peer-focus:text-brown text-white hover:bg-transparent hover:text-brown trans-all">
            @if($this->form->avatar || ($this->form->user && $this->form->user->avatar_path && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') . '/' . $this->form->user->avatar_path)))
                {{ __('pages/members.change-avatar') }}
            @else
                {{ __('pages/members.add-avatar') }}
            @endif
        </label>
        @if($this->form->avatar || ($this->form->user && $this->form->user->avatar_path && Storage::disk(config('filesystems.default'))->exists(config('avatar.original_path') . '/' . $this->form->user->avatar_path)))
            <button type="button"
                    @if($this->form->user)
                        wire:click="removeOldAvatar({{ $this->form->user->id }})"
                    @else
                        wire:click="$dispatch('remove-avatar')"
                    @endif
                    class="btn-delete">
                {{ __('pages/members.remove-avatar') }}
            </button>
        @endif
    </div>
</fieldset>
