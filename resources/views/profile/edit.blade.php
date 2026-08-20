<x-app-layout>
    <style>
        .profile-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            box-sizing: border-box;
        }
        @media (min-width: 1024px) {
            .profile-page {
                padding-left: 296px;
                padding-top: 36px;
                padding-bottom: 36px;
                padding-right: 36px;
            }
        }
        .profile-container {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>

    <div class="profile-page">
        <div class="profile-container space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
