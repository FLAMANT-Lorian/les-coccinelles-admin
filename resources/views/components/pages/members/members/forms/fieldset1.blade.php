<fieldset class="col-span-full lg:col-span-2 items-center lg:border-none!">
    <legend class="">{{ __('pages/members.profile-picture') }}</legend>
    <div class="w-30 h-30 bg-gray rounded-full mb-2">

    </div>
    <input class="sr-only peer" type="file" id="profile-picture" name="avatar" accept="image/png, image/jpeg, image/jpg, image/webp">
    <label for="profile-picture" class="py-3 px-4 rounded-sm border border-brown bg-brown peer-focus:bg-transparent peer-focus:text-brown text-white hover:bg-transparent hover:text-brown trans-all">
        {{ __('pages/members.add-avatar') }}
    </label>
</fieldset>
